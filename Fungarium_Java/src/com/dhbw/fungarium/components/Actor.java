package com.dhbw.fungarium.components;

import java.sql.SQLException;
import java.sql.Statement;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;
import org.apache.logging.log4j.message.StringMapMessage;

import com.dhbw.config.GCT;
import com.pi4j.io.gpio.GpioPinDigitalOutput;

public class Actor {
	protected Logger lg;
	protected Logger lgmap =LogManager.getLogger("DBmap");
	protected Logger lgdb =LogManager.getLogger("DBlog");
	public GpioPinDigitalOutput pin;
	protected GCT gct;
	protected String bezeichnung;
	public Actor(GpioPinDigitalOutput pin,String bezeichnung, Logger lg) {
		super();
		if (lg == null)
			this.lg = LogManager.getLogger(Actor.class);
		else
			this.lg = lg;
		this.pin = pin;
		this.gct = GCT.getInstance();
		this.bezeichnung=bezeichnung;
	}

	public void on() {
		//Set GPIO Pinstate Low
		
			try {
				if(this.pin.isHigh()) {
					this.pin.low(); 
					lg.info("Switch on Actor {}",this.bezeichnung);
					updateprotokollDB(this.bezeichnung,"on",1);
					updatemanualDB(this.bezeichnung, 1);
				}
			} catch (Throwable t) {
				if (!gct.isTestEnv()) // Ignore Exception in case running outside PI
					lgdb.error("Error while switching on actor {}. Reason: {}", this.bezeichnung, t.getMessage());
			}
		
	}

	public void off() {
		//Set GPIO Pinstate High
		try {
			if(this.pin.isLow()) {
				this.pin.high();
				lg.info("Switch off Actor {}",this.bezeichnung);
				updateprotokollDB(this.bezeichnung,"off",0);
				updatemanualDB(this.bezeichnung, 0);

			}
		} catch (Throwable t) {
			if (!gct.isTestEnv())
			lgdb.error("Error while switching off actor {}. Reason: {}", this.bezeichnung, t.getMessage());
		}		
	}
	
	private void updateprotokollDB(String bauteil,String action,int i) {
		StringMapMessage map = new StringMapMessage();
		map.put("Bauteil", bezeichnung);
		map.put("An", String.valueOf(i));
		map.put("Eintrag", "Switch "+ action+" Actor " +bauteil);
		lgmap.info(map);		
	}

	//Updates the manaul DB
	private void updatemanualDB(String bezeichnung,int i) {
		try {
			Statement stmt = gct.getConnection().createStatement();
			stmt.executeUpdate("UPDATE manuell SET Wert = "+ i +" WHERE Bezeichnung = '"+ bezeichnung +"'");
			stmt.close();
		} catch (SQLException e) {
			lgdb.error("{}", e.getMessage());
		}
	}
}
