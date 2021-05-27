package com.dhbw.fungarium.components;

import java.sql.SQLException;
import java.sql.Statement;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;

import com.dhbw.config.GCT;

public class Humidification extends Thread {
	private final static Logger lg = LogManager.getLogger("DBlog");
	private Fogger fogger;
	private Fan fanlow;
	private GCT gct;

	public Humidification(Fogger fogger, Fan fanlow) {
		super();
		this.fogger = fogger;
		this.fanlow = fanlow;
		this.gct = GCT.getInstance();
	}
	
	public void run() {
		
		gct.setHumidificationstatus(true);
		
		if(!gct.isAutoManu())
			updatemanualDB(1);
		lg.info("Start Humidification routine");
		try {
			fanlow.on(); // Fan on
			fogger.on();
			Thread.sleep(gct.getRulesData().getHumTime() * 1000*60); // Ventilation Time in Minutes
			fogger.off();
			
			// If fan and fanlow are not equal turn off fanlow
			// if fan and fanlow are equal turn off fanlow in case ventilation is not alive
			if (!gct.isVentilationstatus() || !gct.isFanconf())
				fanlow.off();
			gct.setHumidificationstatus(false);
			lg.info("Ends Humidification routine");
			
			
		} catch (InterruptedException e) {
			//This is necessary because of manual operation
			fogger.off();
			fanlow.off();
			gct.setHumidificationstatus(false);
			lg.info("Ends Humidification routine");
			updatemanualDB(0);
			Thread.currentThread().interrupt();
		}
		updatemanualDB(0);
	}

	private void updatemanualDB(int i) {

		try {
			Statement stmt = gct.getConnection().createStatement();
			stmt.executeUpdate("UPDATE manuell SET Wert = " + i + " WHERE Bezeichnung = 'befeuchtungsroutine'");
			stmt.close();
		} catch (SQLException e) {
			lg.error("{}", e.getMessage());
		}
	}
}
