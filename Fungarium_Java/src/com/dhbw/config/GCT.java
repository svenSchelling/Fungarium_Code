package com.dhbw.config;

import java.sql.Connection;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;


//Singletton-Pattern
public class GCT {
	
	private GCT() {
		super();
		this.testEnv = false;
		this.rulesData = new RulesData();
		this.temp=25;
		this.hum=60;
	}

	final static Logger lg = LogManager.getLogger("DBlog");
	
	private static GCT instance;
	
	private boolean testEnv;
	
	//Only for test
	private int temp;
	private int hum;

	//Config Parameter
	private boolean LightasHeater;
	private boolean dayOrNight;
	
	
	//state parameters
	private boolean emergency;
	private boolean autoManu;
	private boolean dbConnection;
	private boolean ventilationstatus;
	private boolean humidificationstatus;
	private boolean fanconf;
	private boolean permanentVentilation;
	

	// Rules data
	private RulesData rulesData;

	// DB Connection
	private Connection connection;

	// Access to GCT object
	public static GCT getInstance() {
		
		if (instance == null)
			instance = new GCT();
		if(System.getProperty("TEST_ENV") != null)
			instance.setTestEnv(true);
		return instance;
	}
	
	//Getter Setter methods 

	public RulesData getRulesData() {
		return rulesData;
	}

	public void setRulesData(RulesData rulesData) {
		this.rulesData = rulesData;
	}

	public boolean isEmergency() {
		return emergency;
	}

	public void setEmergency(boolean emergency) {
		if(emergency&&!this.emergency) {
			lg.info("Switch into Emergency!!Please Check the DHT22");
		}
		else if(!emergency && this.emergency) {
			lg.info("Switch to Normal Operation! The DHT22 already works");
		}
		this.emergency = emergency;
	}

	public Connection getConnection() {
		return connection;
	}

	public void setConnection(Connection connection) {
		this.connection = connection;
	}

	public int getTemp() {
		return temp;
	}

	public void setTemp(int temp) {
		this.temp = temp;
	}

	public int getHum() {
		return hum;
	}

	public void setHum(int hum) {
		this.hum = hum;
	}

	public boolean isTestEnv() {
		return testEnv;
	}

	public void setTestEnv(boolean testEnv) {
		this.testEnv = testEnv;
	}
	
	public boolean isAutoManu() {
		return autoManu;
	}

	public void setAutoManu(boolean autoManu) {
		if(autoManu&&!this.autoManu) {
			lg.info("Switch to Manual");
		}
		else if(!autoManu&&this.autoManu) {
			lg.info("Swich to Auto");
		}
		this.autoManu = autoManu;
	}

	public boolean isDbConnection() {
		return dbConnection;
	}

	public void setDbConnection(boolean dbConnection) {
		this.dbConnection = dbConnection;
	}

	public boolean isLightasHeater() {
		return LightasHeater;
	}

	public void setLightasHeater(boolean lightasHeater) {
		LightasHeater = lightasHeater;
	}

	public boolean isVentilationstatus() {
		return ventilationstatus;
	}

	public void setVentilationstatus(boolean ventilationstatus) {
		this.ventilationstatus = ventilationstatus;
	}

	public boolean isDayOrNight() {
		return dayOrNight;
	}

	public void setDayOrNight(boolean dayOrNight) {
		this.dayOrNight = dayOrNight;
	}

	public boolean isHumidificationstatus() {
		return humidificationstatus;
	}

	public void setHumidificationstatus(boolean humidificationstatus) {
		this.humidificationstatus = humidificationstatus;
	}
	public boolean isPermanentVentilation() {
		return permanentVentilation;
	}

	public void setPermanentVentilation(boolean permanentVentilation) {
		this.permanentVentilation = permanentVentilation;
	}

	public boolean isFanconf() {
		return fanconf;
	}

	public void setFanconf(boolean fanconf) {
		this.fanconf = fanconf;
	}

}
