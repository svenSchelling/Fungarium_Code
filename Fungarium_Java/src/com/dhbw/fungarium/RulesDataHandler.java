package com.dhbw.fungarium;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;


import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;

import com.dhbw.config.GCT;
import com.dhbw.config.RulesData;

public class RulesDataHandler {
	
	private final static Logger lg = LogManager.getLogger("DBlog");
	
	private GCT gct;	

	public RulesDataHandler() {
		super();
		this.gct = GCT.getInstance();
	}

	public RulesData read() {
			return _readRulesFromDb();
	}

	// Liest die RulesData aus einem properties file

	private RulesData _readRulesFromDb() {
		lg.debug("Reading rules from database");
	
		if (gct.isDayOrNight()) 
			return day_Config();
		else 
			return night_Config();
		
		
		
	}

	// read day config id light is on
	private RulesData day_Config() {
		RulesData rulesData=gct.getRulesData();
		try {
			Statement stmt = gct.getConnection().createStatement();
			ResultSet rs= stmt.executeQuery("Select Wert,Bezeichnung From einstellungen");
			while(rs.next()) {
				switch(rs.getString("Bezeichnung")) {
					case "Lichtstart":
						String[] lightOnTime = (rs.getString("Wert").split(":"));
						rulesData.setLightOnDate(Integer.parseInt(lightOnTime[0]), Integer.parseInt(lightOnTime[1]));
						break;
					case "Lichtende":
						String[] lightOffTime = (rs.getString("Wert").split(":"));
						rulesData.setLightOffDate(Integer.parseInt(lightOffTime[0]), Integer.parseInt(lightOffTime[1]));
						break;
					case "Mindesttemperatur":
						rulesData.setTempMin(Integer.parseInt((String) rs.getString("Wert")));
						break;
					case "Höchsttemperatur":
						rulesData.setTempMax(Integer.parseInt((String) rs.getString("Wert")));
						break;
					case "Mindestfeuchtigkeit":
						rulesData.setHumMin(Integer.parseInt((String) rs.getString("Wert")));
						break;
					case "Befeuchtungsdauer":
						rulesData.setHumTime(Integer.parseInt((String) rs.getString("Wert")));
						break;
					case "Lüftungsdauer":
						rulesData.setVentilationTime(Integer.parseInt((String) rs.getString("Wert")));
						break;
					case "Lüftungsintervall":
						rulesData.setVentilationIn(Integer.parseInt((String)rs.getString("Wert")));	
						break;
				}
			}
			rs.close();
			stmt.close();

		} catch (SQLException e) {
			lg.error("{}",e.getMessage());
		}
		return rulesData;
	}
	
	// read night config if light is off
	private RulesData night_Config() {
		RulesData rulesData=gct.getRulesData();
		
		try {
			Statement stmt = gct.getConnection().createStatement();
			ResultSet rs= stmt.executeQuery("Select Wert,Bezeichnung From einstellungen");
			while(rs.next()) {
				switch(rs.getString("Bezeichnung")) {
					case "Lichtstart":
						String[] lightOnTime = (rs.getString("Wert").split(":"));
						rulesData.setLightOnDate(Integer.parseInt(lightOnTime[0]), Integer.parseInt(lightOnTime[1]));
						break;
					case "Lichtende":
						String[] lightOffTime = (rs.getString("Wert").split(":"));
						rulesData.setLightOffDate(Integer.parseInt(lightOffTime[0]), Integer.parseInt(lightOffTime[1]));
						break;
					case "MindesttemperaturNacht":
						rulesData.setTempMin(Integer.parseInt((String) rs.getString("Wert")));
						break;
					case "HöchsttemperaturNacht":
						rulesData.setTempMax(Integer.parseInt((String) rs.getString("Wert")));
						break;
					case "Mindestfeuchtigkeit":
						rulesData.setHumMin(Integer.parseInt((String) rs.getString("Wert")));
						break;
					case "Befeuchtungsdauer":
						rulesData.setHumTime(Integer.parseInt((String) rs.getString("Wert")));
						break;
					case "Lüftungsdauer":
						rulesData.setVentilationTime(Integer.parseInt((String) rs.getString("Wert")));
						break;
					case "Lüftungsintervall":
						rulesData.setVentilationIn(Integer.parseInt((String)rs.getString("Wert")));	
				}
			}
			rs.close();
			stmt.close();
			
			
		} catch (SQLException e) {
			lg.error("{}",e.getMessage());
		}
		return rulesData;
	}
}
