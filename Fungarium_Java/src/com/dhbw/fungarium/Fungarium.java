package com.dhbw.fungarium;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Calendar;
import java.util.GregorianCalendar;
import java.util.Hashtable;
import java.util.Timer;
import java.util.TimerTask;
import java.util.concurrent.ArrayBlockingQueue;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;

import com.dhbw.config.GCT;
import com.dhbw.fungarium.components.Cooler;
import com.dhbw.fungarium.components.Fan;
import com.dhbw.fungarium.components.Fogger;
import com.dhbw.fungarium.components.Heater;
import com.dhbw.fungarium.components.Humidification;
import com.dhbw.fungarium.components.Light;
import com.dhbw.fungarium.components.RegVentilation;
import com.dhbw.fungarium.sensor.Dht22;
import com.dhbw.fungarium.sensor.SensorData;
import com.pi4j.io.gpio.GpioController;
import com.pi4j.io.gpio.GpioFactory;
import com.pi4j.io.gpio.GpioPinDigitalOutput;
import com.pi4j.io.gpio.PinState;
import com.pi4j.io.gpio.RaspiPin;

public class Fungarium {
	// Instantiate Logger
	final static Logger lg = LogManager.getLogger("DBlog");

	// Instantiate Components
	private Fan fan = null;
	private Fan fanlow = null;
	private Cooler cooler = null;
	private Heater heater = null;
	private Fogger fogger = null;
	private Light light = null;
	private Dht22 dht22Sensor = null;

	// Instantiate Humidfication routine
	private Humidification humidification = new Humidification(fogger, fan);

	// Instantiate flags
	private Hashtable<String, Boolean> components = new Hashtable<String, Boolean>();
	private boolean merkerVenHum = false;
	private boolean merkerLight = false;

	private GCT gct;

	public Fungarium() {
		super();
		this.gct = GCT.getInstance();
	}

	public void doFungarium() {

		// Set Connection to Database
		gct.setConnection(connectToMysql());

		// Read presets from DB to set the correct GPIO Pin number
		try {
			read_GPIOPin_fromDB();
		} catch (Throwable t) {
			lg.error("{}", t.getMessage());
			throw t;

		}
		// Set Default to Manual table
		setManualDB();

		// Instantiate SensorDataQueue
		ArrayBlockingQueue<SensorData> sensorDataQueue = new ArrayBlockingQueue<SensorData>(100);

		// Start Sensor Thread
		dht22Sensor.setSensorDataQueue(sensorDataQueue);
		dht22Sensor.start();

		// Instantiate Timer with cycle of 3 seconds
		Timer timer = new Timer();
		TimerTask tt = new TimerTask() {
			@Override
			public void run() {				
				
				try {
					
					// Read the actual RulesData from DB
					gct.setRulesData(new RulesDataHandler().read());
					lg.debug("{}", gct.getRulesData());
					
					Statement stmt;
					stmt = gct.getConnection().createStatement();

					// Max number of Data in DB = 1000
					// Delete the older ones
					ResultSet rs = stmt.executeQuery("Select max(ID) from protokoll");
					rs.next();
					if (rs.getInt(1)>500) {
						stmt.executeUpdate("delete from protokoll where ID < (select max(ID) from protokoll)-1000");
						// String sql = "set @autoid :=0;\n"+"update protokoll set ID = @autoid :=(@autoid+1);\n"+"alter table protokoll AUTO_INCREMENT = 1;";
						// Update the ID
						stmt.executeUpdate("set @autoid :=0");
						stmt.executeUpdate("update protokoll set ID = @autoid :=(@autoid+1)");
						stmt.executeUpdate("alter table protokoll AUTO_INCREMENT = 1");
						
					}
					rs.close();
					// Reading value of autoManu from Database
					ResultSet rs1 = stmt.executeQuery("Select Wert From manuell where Bezeichnung ='autoManu'");
					rs1.next();

					// Check if manual or automatic
					if (rs1.getInt("Wert") == 1) {
						checkManual(stmt);
						gct.setAutoManu(true);
						merkerLight = false;
						merkerVenHum = false;

					} else {
						// Turn off Channels in Case switching from Manu to Auto
						if (gct.isAutoManu())
							turnoff_Channels_forAuto();
						// The query of merkerLight is necessary because the light can also be used as heating 
						if (!merkerLight && light!=null)
							light.checkLight(); // Check Light
						gct.setAutoManu(false);
					}
					rs1.close();
					stmt.close();
				} catch (SQLException e) {
					lg.error("{}", e.getMessage());
				}
			}
		};
		timer.schedule(tt, 0, 1000 * 3); // Reading Cycle

		// Instantiate Timer that activates humdification in Emergency
		Timer humInEmergency = new Timer();
		TimerTask hum = new TimerTask() {
			@Override
			public void run() {
				if (!humidification.isAlive() && fogger != null) {
					humidification = new Humidification(fogger, fanlow);
					if(fan.pin.isLow() && !gct.isFanconf())
						fan.off();
					humidification.start();
				}
			}
		};

		// Instantiate RegVentilation Thread which starts the Fan at an Interval specified
		// by the User
		if (fan != null) {
			RegVentilation regVentilation= new RegVentilation(fan);
			fan.setDht22Sensor(dht22Sensor);
			fan.setVentilation(regVentilation);
			regVentilation.start();
		}

		// Instantiate Timer which restarts the DHT22 every 24h
		Timer sensorRestartTimer = new Timer();
		TimerTask oneDay = new TimerTask() {
			@Override
			public void run() {
				dht22Sensor.sensorRestart();
			}
		};
		sensorRestartTimer.schedule(oneDay, getDateDiff(), 1000 * 60 * 60 * 24);
		// getDateDiff calculates the Time to 24 O'clock

		SensorData sd = null;
		int emer = 0;

		while (true) {

			try {
				// Waiting for Data from Sensor
				sd = sensorDataQueue.take();
			} catch (InterruptedException e) {
				lg.error("Failure while waiting for new Sensordata");
			}

			if (!plausibilitycheck(sd)) { // Checking if the Sensor Data are correct
				lg.error("SensorData are not correct: {}", sd);

				if (emer < 3) {
					emer++;
					// Set Sensorstatus false because of upcoming Sensorrestart
					dht22Sensor.setSensorStatus(false);
					dht22Sensor.sensorRestart(); // Sensor restart
				}

				else {
					// Set Emergency Config
					if (!gct.isEmergency()) {
						gct.setEmergency(true);

						// Turn off heater and cooler if they are on
						turnChannels_off();

						// Instantiate Humidification Timer with an Interval off 15 Minutes
						humInEmergency.schedule(hum, 0, (gct.getRulesData().getHumTime() + 1000 * 60 * 15));
						
						// Wake up the sensor so that it is going into emergency operation
						synchronized (dht22Sensor) {
							dht22Sensor.notify();
						}
					}

				}
			} else {
				lg.info("Sensordaten: {}", sd);
				gct.setEmergency(false);

				// write Sensordata to DB
				writeToDb(sd);

				//	Check Temperature and Humidity in auto operation
				if (!gct.isAutoManu()) {
					checkTemperature(sd);
					checkHumidity(sd);
				}
				
				// In Case switching from emergency to normal operation
				if (emer > 0) {
					synchronized (dht22Sensor) {
						dht22Sensor.notify();
					}
					humInEmergency.cancel();
					emer = 0;
				}
			}
		}

	}

	// Check if the recorded SensorData are correct
	private boolean plausibilitycheck(SensorData sd) {
		if (sd.getHumidity() < 20 || sd.getHumidity() > 100 || sd.getTemperature() < 10 || sd.getTemperature() > 50)
			return false;
		else
			return true;
	}

	private void checkTemperature(SensorData sd) {

		// Check for cooling
		if (sd.getTemperature() > gct.getRulesData().getTempMax()) {
			if (components.get("Cooler"))
				cooler.on();
			else if (components.get("Fan") && fan.pin.isHigh()) {
				lg.info("Switch on Fan because the temperature is too high");
				fan.on();
			}
		} // check for heating
		else if (sd.getTemperature() < gct.getRulesData().getTempMin()) {
			if (components.get("Heater"))
				heater.on();
			
			// if light as a heater is active
			else if (gct.isLightasHeater() && !merkerLight) {
				merkerLight = true;
				lg.info("Turn on Light as a Heater if it's not on already");
				light.on();
			}
		}	// Check if heating can be switched off again
			// Threshold: min.Temp + (max.Temp -min.temp)*25%
		if (sd.getTemperature() > (gct.getRulesData().getTempMin()
				+ (gct.getRulesData().getTempMax() - gct.getRulesData().getTempMin()) * 0.25)) {
			if (components.get("Heater"))
				heater.off();
			
			// if light as a heater is active
			else if (gct.isLightasHeater() && merkerLight) {
				lg.info("Check Light because the temperature is back in the intended range");
				light.checkLight();
				merkerLight = false;
			}
		} 	// Check if cooling can be switched off again
			// Threshold: max.Temp -(max.Temp-min.Temp)*25%
		if (sd.getTemperature() < (gct.getRulesData().getTempMax()
				- (gct.getRulesData().getTempMax() - gct.getRulesData().getTempMin()) * 0.25)) {
			if (components.get("Cooler"))
				cooler.off();
			else if (components.get("Fan") && !gct.isVentilationstatus() && !humidification.isAlive()
					&& fan.pin.isLow()) {
				lg.info("Switch off Fan because the temperature is back in the intended range");
				fan.off();
			}
		}

	}

	// Check if the Humidity is too low
	private void checkHumidity(SensorData sd) {

		if (sd.getHumidity() < gct.getRulesData().getHumMin()) {
			
			// Check if the last operation was Ventilation or humidification
			if (!gct.isVentilationstatus() && !merkerVenHum && !humidification.isAlive() && components.get("Fan")) {
				lg.info("Going to start Ventilation Routine because of low Humidity");
				fan.FanIn(); // start ventilation routine
				
				// The disposal is necessary because if there is no fogger available merkerVenHum does not have to be set
				if (fogger != null)
					merkerVenHum = true;
			} 
			// Check if the last operation was Ventilation or humidification
			else if (!humidification.isAlive() && fogger != null && merkerVenHum && (!gct.isVentilationstatus()||gct.getRulesData().getVentilationIn()==0)) {
				lg.info("Going to start Humidification Routine because of low Humidity");
				humidification = new Humidification(fogger, fanlow);
				
				// Check if fan is high
				if(fan.pin.isLow() && !gct.isFanconf())
					fan.off();
				humidification.start();
				merkerVenHum = false;
			}
			
			// Necessary in the case of permanent ventilation
			else if(gct.getRulesData().getVentilationIn()==0) {
				merkerVenHum=true;
			}
			
		// this is necessary if after a Ventilation the Humidity is in the specified range
		} else if (!gct.isVentilationstatus())
			merkerVenHum = false;
	}


	// Calculate the Diff. between 24 o'clock end the current time
	private long getDateDiff() {
		Calendar cat = new GregorianCalendar();
		cat.set(Calendar.HOUR_OF_DAY, 24);
		cat.set(Calendar.MINUTE, 0);
		cat.set(Calendar.SECOND, 0);
		return (cat.getTimeInMillis() - new GregorianCalendar().getTimeInMillis());
	}

	// This method turns of channels before switching to Auto
	protected void turnoff_Channels_forAuto() {
		lg.info("Turn Channels off befor switching to Auto Modus");
		if (components.get("Cooler"))
			cooler.off();
		if (components.get("Heater"))
			heater.off();
		if (components.get("Fogger"))
			fogger.off();
		if (components.get("Fan"))
			fan.off();
		if (components.get("Fanlow"))
			fanlow.off();
		if(humidification.isAlive())
			humidification.interrupt();
	}

	// Turn off Channels in Emergency
	private void turnChannels_off() {
		if (!gct.isEmergency()) {
			if (components.get("Cooler"))
				cooler.off();
			if (components.get("Heater"))
				heater.off();
		}
	}

	// Create Connection to MySQL Database
	public Connection connectToMysql() {
		try {
			
			Class.forName("com.mysql.cj.jdbc.Driver").newInstance();
			// create connection String 
			String connectionCommand = "jdbc:mysql://localhost/" + System.getProperty("nameDB")
					+ "?serverTimezone=Europe/Berlin";
			// Set connection in GCT
			gct.setDbConnection(true);
			return DriverManager.getConnection(connectionCommand, System.getProperty("userDB"),
					System.getProperty("passwordDB"));
		} catch (Exception ex) {
			lg.error("Connection to Database failed! The Program ends at this point! Please check if the apache Server is running already");
			lg.error("{}", ex.getMessage());
			System.exit(0);
			return null;
		}
	}

	// Write SensorData to DB
	private void writeToDb(SensorData sd) {
		Statement stmt;
		try {
			stmt = gct.getConnection().createStatement();

			// Write current temperature and humidity in table dht
			stmt.executeUpdate("Insert into dht (Temperatur,Luftfeuchtigkeit) Values(" + sd.getTemperature() + ","
					+ sd.getHumidity() + ")");
			
			// Max number of Data in DB = 1000
			// Delete the older ones
			ResultSet rs = stmt.executeQuery("Select max(ID) from dht");
			rs.next();
			if (rs.getInt(1)>1000) {
				stmt.executeUpdate("delete from dht where ID < (select max(ID) from dht)-1000");
				// String sql = "set @autoid :=0;\n"+"update protokoll set ID = @autoid :=(@autoid+1);\n"+"alter table protokoll AUTO_INCREMENT = 1;";
				// Update the ID
				stmt.executeUpdate("set @autoid :=0");
				stmt.executeUpdate("update dht set ID = @autoid :=(@autoid+1)");
				stmt.executeUpdate("alter table dht AUTO_INCREMENT = 1");
			}
			stmt.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}

	}

	// Read Action of the components from DB in manual operation
	private void checkManual(Statement stmt) {
		try {
			ResultSet rs = stmt.executeQuery("Select Wert,Bezeichnung From manuell");
			while (rs.next()) {
				switch (rs.getString("Bezeichnung")) {
				case "licht":
					if (rs.getInt("Wert") == 1 && components.get("Light"))
						light.on();
					else if (components.get("Light"))
						light.off();
					break;
				case "heizung":
					if (rs.getInt("Wert") == 1 && components.get("Heater"))
						heater.on();
					else if (components.get("Heater"))
						heater.off();
					break;
				case "kuehlung":
					if (rs.getInt("Wert") == 1 && components.get("Cooler"))
						cooler.on();
					else if (components.get("Cooler"))
						cooler.off();
					break;
				case "fogger":
					if (rs.getInt("Wert") == 1 && components.get("Fogger"))
						fogger.on();
					else if (components.get("Fogger") && !humidification.isAlive())
						fogger.off();
					break;
				case "lueftung":
					if (rs.getInt("Wert") == 1 && components.get("Fan")) {
						// Check if fanlow is on
						if(fanlow.pin.isLow() && !gct.isFanconf())
							fanlow.off();
						fan.on();
					}
					
					else if (components.get("Fan")&&(!humidification.isAlive() || gct.isFanconf()))
						fan.off();
					break;
				case "lueftungNiedertourig":
					if (rs.getInt("Wert") == 1 && components.get("Fanlow")) {
						// Check if fan is on
						if(fan.pin.isLow() && !gct.isFanconf())
							fan.off();
						fanlow.on();
					}
					else if (components.get("Fanlow") && !humidification.isAlive())
						fanlow.off();
					break;
				case "sensorneustart":
					if (rs.getInt("Wert") == 1 && dht22Sensor.isSensorStatus()) {
						dht22Sensor.setSensorStatus(false);
						dht22Sensor.sensorRestart();
					}
					break;
				case "befeuchtungsroutine":
					if (rs.getInt("Wert") == 1) {
						if (!humidification.isAlive() && fogger != null && fanlow != null) {
							humidification = new Humidification(fogger, fanlow);
							if(fan.pin.isLow() && !gct.isFanconf())
								fan.off();
							humidification.start();
						}
					} else if (humidification.isAlive())
						humidification.interrupt();
					break;
				}
			}
			rs.close();
			stmt.close();
		} catch (SQLException e) {
			lg.error("Failure while reading manuell Set from DB");
			e.printStackTrace();
		}
	}

	// Updates Manual DB
	// Set Actions to false
	private void setManualDB() {
		try {
			Statement stmt = gct.getConnection().createStatement();
			stmt.executeUpdate("UPDATE manuell SET Wert = 0");
		} catch (SQLException e) {
			lg.error("{}", e.getMessage());
		}
	}

	// Read GPIO Pin number from preset DB
	private void read_GPIOPin_fromDB() {
		try {
			Statement stmt = gct.getConnection().createStatement();
			ResultSet rs = stmt.executeQuery("Select Wert,Bezeichnung,Pin From voreinstellungen");
			
			// First check if the component is present
			// If yes set the component with the right GPIO pin
			while (rs.next()) {
				switch (rs.getString("Bezeichnung")) {
				case "licht":
					if (Integer.parseInt((String) rs.getString("Wert")) == 1) {
						components.put("Light", true);
						light = new Light(check_pin((Integer.parseInt((String) rs.getString("Pin")))), "licht");
					}else
						components.put("Light", false);
					break;
				case "heizung":
					if (Integer.parseInt((String) rs.getString("Wert")) == 1) {
						components.put("Heater", true);
						heater = new Heater(check_pin((Integer.parseInt((String) rs.getString("Pin")))), "heizung");
					}else
						components.put("Heater", false);
					break;
				case "kuehlung":
					if (Integer.parseInt((String) rs.getString("Wert")) == 1) {
						components.put("Cooler", true);
						cooler = new Cooler(check_pin((Integer.parseInt((String) rs.getString("Pin")))), "kuehlung");
					}else
						components.put("Cooler", false);
					break;
				case "fogger":
					if (Integer.parseInt((String) rs.getString("Wert")) == 1) {
						components.put("Fogger", true);
						fogger = new Fogger(check_pin((Integer.parseInt((String) rs.getString("Pin")))), "fogger");
					}else
						components.put("Fogger", false);
					break;
				case "lueftung":
					if (Integer.parseInt((String) rs.getString("Wert")) == 1) {
						components.put("Fan", true);
						fan = new Fan(check_pin((Integer.parseInt((String) rs.getString("Pin")))), "lueftung");
					}else
						components.put("Fan", false);
					break;
				case "lueftungNiedertourig":
					if (Integer.parseInt((String) rs.getString("Wert")) == 1) {
						components.put("Fanlow", true);
						fanlow = new Fan(check_pin((Integer.parseInt((String) rs.getString("Pin")))),
							"lueftungniedertourig");
					}else
						components.put("Fanlow", false);
					break;
				case "sensor":
					if (Integer.parseInt((String) rs.getString("Wert")) == 1) {
						dht22Sensor = new Dht22(check_pin((Integer.parseInt((String) rs.getString("Pin")))), "Fungarium");
						break;
					}else {
						lg.error("The program cannot be started without a sensor! The program ends");
						System.exit(0);
					}
				}
			}
			
			// Check if Light as a Heater is true
			rs = stmt.executeQuery("Select Wert From voreinstellungen where Bezeichnung = 'LichtAlsHeizung'");
			rs.next();
			if (Integer.parseInt((String) rs.getString("Wert")) == 1) {
				gct.setLightasHeater(true);
				lg.info("Light as a Heater is activ");
			}
			
			// check if fanlow is present
			// if not fanlow =fan
			if (fanlow == null && fan != null) {
				fanlow = fan;
				gct.setFanconf(true);
				lg.info("No Fanlow was found!! Fanlow is equal to fan");
			}

			rs.close();
			stmt.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}

	// This method returns the right GPIO Output pin
	private GpioPinDigitalOutput check_pin(int i) {
		final GpioController gpio = GpioFactory.getInstance();
		GpioPinDigitalOutput pin = null;
		switch (i) {
		case 1:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_01, PinState.HIGH);
			break;
		case 2:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_02, PinState.HIGH);
			break;
		case 3:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_03, PinState.HIGH);
			break;
		case 4:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_04, PinState.HIGH);
			break;
		case 5:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_05, PinState.HIGH);
			break;
		case 6:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_06, PinState.HIGH);
			break;
		case 7:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_07, PinState.HIGH);
			break;
		case 8:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_08, PinState.HIGH);
			break;
		case 9:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_09, PinState.HIGH);
			break;
		case 10:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_10, PinState.HIGH);
			break;
		case 11:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_11, PinState.HIGH);
			break;
		case 12:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_12, PinState.HIGH);
			break;
		case 13:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_13, PinState.HIGH);
			break;
		case 14:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_14, PinState.HIGH);
			break;
		case 15:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_15, PinState.HIGH);
			break;
		case 16:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_16, PinState.HIGH);
			break;
		case 17:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_17, PinState.HIGH);
			break;
		case 18:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_18, PinState.HIGH);
			break;
		case 19:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_19, PinState.HIGH);
			break;
		case 20:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_20, PinState.HIGH);
			break;
		case 21:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_21, PinState.HIGH);
			break;
		case 22:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_22, PinState.HIGH);
			break;
		case 23:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_23, PinState.HIGH);
			break;
		case 24:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_24, PinState.HIGH);
			break;
		case 25:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_25, PinState.HIGH);
			break;
		case 26:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_26, PinState.HIGH);
			break;
		case 27:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_27, PinState.HIGH);
			break;
		case 28:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_28, PinState.HIGH);
			break;
		case 29:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_29, PinState.HIGH);
			break;
		case 30:
			pin = gpio.provisionDigitalOutputPin(RaspiPin.GPIO_30, PinState.HIGH);
			break;
		default:
			return null;
		}
		
		// If the program ends the PinState is going to be high
		pin.setShutdownOptions(true, PinState.HIGH);
		return pin;
	}
}
