package com.dhbw.fungarium.sensor;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Hashtable;
import java.util.Timer;
import java.util.TimerTask;
import java.util.concurrent.ArrayBlockingQueue;
import java.util.concurrent.BlockingQueue;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;

import com.dhbw.config.GCT;
import com.pi4j.io.gpio.GpioPinDigitalOutput;

public class Dht22 extends Thread {
	private final static Logger lg = LogManager.getLogger("DBlog");

	// Constructors DHT22
	public Dht22(GpioPinDigitalOutput pin, String sensorLocation) {

		this(pin, sensorLocation, null, 2); // Instantiate witch default Cycle = 2 minutes
		this.gct = GCT.getInstance();
	}

	public Dht22(GpioPinDigitalOutput pin, String sensorLocation, BlockingQueue<SensorData> sensorDataQueue,
			int meterPeriod) {
		super();
		this.meterPeriod = meterPeriod;
		this.dht22Pin = pin;
		this.sensorDataQueue = sensorDataQueue;
		this.sensorLocation = sensorLocation;
		this.gct = GCT.getInstance();
		this.temp_hum_old.put("temperature", (float) 20);
		this.temp_hum_old.put("humidity", (float) 60);
	}

	// Attributes DHT22
	private String sensorLocation;
	private BlockingQueue<SensorData> sensorDataQueue;
	private int meterPeriod; // in seconds
	private GpioPinDigitalOutput dht22Pin;
	private GCT gct;
	private boolean sensorStatus = true;
	private Hashtable<String, Float> temp_hum_old = new Hashtable<String, Float>();
	private int i;

	@Override
	public void run() {
		while (true) {
			try {
				// Wait 2 seconds. This is required to start the program because the current
				// RulesData should be read from the database first
				Thread.sleep(2000);
				
				// Wait 2 Minutes in normal operation, than do meter
				if (!this.gct.isEmergency()) {
					doMeter();
					synchronized (this) {
						this.wait((this.meterPeriod * 1000 * 60) - 2000);
					}
					
				// Wait  60 Minutes, than Sensor Restart
				} else if (this.gct.isEmergency()) {
					lg.info("Please Check Sensor");
					
					sensorStatus = false;
					sensorRestart();
					synchronized (this) {
						this.wait((this.meterPeriod * 1000 * 60 * 60) - 2000);
					}

				}
			} catch (InterruptedException e) {
				lg.error("{}", e.getMessage());
			}
		}
	}

	// Getters and Setters
	public int getMeterPeriod() {
		return meterPeriod;
	}

	public void setMeterPeriod(int meterPeriod) {
		this.meterPeriod = meterPeriod;
	}

	public void setSensorStatus(boolean sensorStatus) {
		this.sensorStatus = sensorStatus;
	}

	public void setSensorDataQueue(ArrayBlockingQueue<SensorData> sensorDataQueue) {
		this.sensorDataQueue = sensorDataQueue;
	}

	public boolean isSensorStatus() {
		return sensorStatus;
	}

	public void doMeter() {

		// Check if the dht22 restarts
		if (this.sensorStatus) {
			// Reading Data from DHT22
			try {
				Hashtable<String, Float> temp_hum = new Hashtable<String, Float>();
				temp_hum = readSensorData();
				SensorData sd = new SensorData(this.sensorLocation, temp_hum.get("humidity"),
						temp_hum.get("temperature"));
				this.sensorDataQueue.add(sd);
				temp_hum_old = temp_hum;
				i = 0;

			} catch (Throwable t) {
				lg.error("Complications while reading Sensordata");
				lg.error("Take the old SensorData");
				SensorData sd = new SensorData(this.sensorLocation, temp_hum_old.get("humidity"),
						temp_hum_old.get("temperature"));
				this.sensorDataQueue.add(sd);
				if (i > 3) {
					lg.error("Something went wrong while reading Data from Sensor! Please check DHT22");
				}
				i++;
			}
		}
	}

	// Read the actual Temperature and Humidity from DHT22
	private Hashtable<String, Float> readSensorData() {

		// creating a HashTable Dictionary
		Hashtable<String, Float> temp_hum = new Hashtable<String, Float>();

		// command to execute and get dht data
		String[] commands = { "python3", "/home/pi/Fungarium/lib/mydht.py" }; // mydht.py is the pythonScript
		Runtime rt = Runtime.getRuntime();

		Process proc;
		try {
			proc = rt.exec(commands);
			BufferedReader stdInput = new BufferedReader(new InputStreamReader(proc.getInputStream()));
			BufferedReader stdError = new BufferedReader(new InputStreamReader(proc.getErrorStream()));

			// Read the output from the command
			String s = null;
			while ((s = stdInput.readLine()) != null) {
				String[] vals = s.split(" ");
				Float t = Float.parseFloat((String) vals[0].trim());
				Float h = Float.parseFloat((String) vals[1].trim());
				temp_hum.put("temperature", t);
				temp_hum.put("humidity", h);
			}
			// Read any errors from the attempted command
			while ((s = stdError.readLine()) != null) {
				System.out.println(s);
			}
		} catch (IOException e) {
			lg.error("{}", e.getMessage());
		}

		return temp_hum;
	}

	public void sensorRestart() {
		updatemanualDB(1);
		lg.info("Sensor restarts");
		dht22Pin.low();
		// Check if Sensor Restart in Emergency or not
		if (!this.gct.isEmergency()) {
			Timer timer = new Timer();
			timer.schedule(new TimerTask() {
				@Override
				public void run() {
					dht22Pin.high();
					lg.info("End off Sensor Restart");
					waitForNewMeasurment();
					timer.cancel();
				}
			}, 1000 * 30);// Wait 30 seconds before turn on again

		} else { // Sensor restart in Emergency
			Timer timer = new Timer();
			lg.info("Sensor Restarts in Emergency");
			timer.schedule(new TimerTask() {
				@Override
				public void run() {
					dht22Pin.high();
					lg.info("End off Sensor Restart");
					waitForNewMeasurment();
					timer.cancel();
				}

			}, 1000 * 60 * 5);// Wait 5 Minutes before turn on again
		}
	}

	// Waits for a new Measurment
	protected void waitForNewMeasurment() {
		Timer timer = new Timer();
		timer.schedule(new TimerTask() {
			@Override
			public void run() {
				sensorStatus = true;
				updatemanualDB(0);
				doMeter();
				timer.cancel();
			}

		}, 1000 * 30); // Wait 30 Seconds before next Measurement
	}

	// Update Manuel DB --> Sensorneustart
	private void updatemanualDB(int i) {

		try {
			Statement stmt = gct.getConnection().createStatement();
			stmt.executeUpdate("UPDATE manuell SET Wert = " + i + " WHERE Bezeichnung = 'sensorneustart'");
			stmt.close();
		} catch (SQLException e) {
			lg.error("{}", e.getMessage());
		}
	}

}
