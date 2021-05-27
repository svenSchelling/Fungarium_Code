package com.dhbw.config;

import java.util.Calendar;
import java.util.GregorianCalendar;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;


//Data that the user can set via the control page
public class RulesData {

	private final static Logger lg = LogManager.getLogger("Dblog");
	
	public RulesData() {						// Constructor with default values
		this.tempMax = 27;						
		this.tempMin = 15;						
		this.humMin = 60;
		this.humTime = 15;
		this.ventilationIn=60;
		lightOnDate= new GregorianCalendar();
		lightOffDate =new GregorianCalendar();
		this.lightOnDate.set(Calendar.HOUR_OF_DAY, 8);
		this.lightOnDate.set(Calendar.MINUTE,30 );
		this.lightOffDate.set(Calendar.HOUR_OF_DAY, 21);
		this.lightOffDate.set(Calendar.MINUTE,30 );
		this.ventilationTime = 10;
	}

	public int tempMax; // in °C
	public int tempMin; // in °C
	public int humMin; // in %
	public int humTime; // in minutes
	public int ventilationTime; // in minutes
	private int ventilationIn;
	public Calendar lightOnDate;
	public Calendar lightOffDate;
	private boolean lightRangeInverse;
	

	// Getters and Setters 
	public int getTempMax() {
		return tempMax;
	}

	public void setTempMax(int tempMax) {
		// Check if the specified temMax is in range 
		if (tempMax <= 35 && tempMax >= 15 && (tempMax - this.tempMin) >= 5) 
			this.tempMax = tempMax;
		else if ((tempMax - this.tempMin) < 5)
			this.tempMax = this.tempMin + 5;
		
		// Error Message if the specified temMax is out off Range
		else lg.error("The entered maximum temperature is not in the specified range!");
	}

	public int getTempMin() {
		return tempMin;
	}

	public void setTempMin(int tempMin) {
		// Check if the specified temMin is in range 
		if (tempMin <= 25 && tempMin >= 0 && (this.tempMax - tempMin) >= 5)
			this.tempMin = tempMin;
		// Check if the specified temMin is in range 
		else lg.error("The entered minimal temperature is not in the specified range!");
	}

	public int getHumMin() {
		return humMin;
	}

	public void setHumMin(int humMin) {
		if (humMin <= 100 && humMin >= 50)
			this.humMin = humMin;
		else 
			lg.error("The entered Minimum humidity is not in the specified range!");
	}
	
	
	public void setLightOnDate(int hour, int minute) {
		//Check if LightStart and Lightend are equal
		if (!(hour == this.lightOffDate.get(Calendar.HOUR_OF_DAY) && minute == this.lightOffDate.get(Calendar.MINUTE))) {
			this.lightOnDate=new GregorianCalendar();
			this.lightOnDate.set(Calendar.HOUR_OF_DAY, hour);
			this.lightOnDate.set(Calendar.MINUTE,minute);
			this.lightOnDate.set(Calendar.SECOND,0);
		}
		else lg.error("The entered light start is the same as the light end");
		_checkLightRange();
	}

	public void setLightOffDate(int hour, int minute) {
		//Check if LightStart and Lightend are equal
		if (!(hour == this.lightOnDate.get(Calendar.HOUR_OF_DAY) && minute == this.lightOnDate.get(Calendar.MINUTE))) {
			this.lightOffDate=new GregorianCalendar();
			this.lightOffDate.set(Calendar.HOUR_OF_DAY, hour);
			this.lightOffDate.set(Calendar.MINUTE,minute);
			this.lightOffDate.set(Calendar.SECOND,0);
		}
		else 
			lg.error("The entered light start is the same as the light end");
		
		_checkLightRange();
	}
	
	public Calendar getLightOnDate()
	{
		return lightOnDate;
	}
	
	public Calendar getLightOffDate()
	{
		// Check if lightRangeInverse is true
		// It delivers the opportunity to switch the light on for example from 22:00 to 4:00
		if (lightRangeInverse)
			this.lightOffDate.add(Calendar.DAY_OF_YEAR, 1);
		return lightOffDate;
	} 
	
	public int getVentilationTime() {
		return ventilationTime;
	}

	public void setVentilationTime(int ventilationTime) {
		if (ventilationTime <= 30 && ventilationTime >= 5)
			this.ventilationTime = ventilationTime;
		else lg.error("The entered ventilation time is not in the specified range");
	}

	public int getHumTime() {
		return humTime;
	}

	public void setHumTime(int humTime) {
		if (humTime <= 30 && humTime >= 5)
			this.humTime = humTime;
		else lg.error("The entered humidification time is not in the specified range");
	}

	public boolean isLightRangeInverse() {
		return lightRangeInverse;
	}

	public int getVentilationIn() {
		return ventilationIn;
	}

	public void setVentilationIn(int ventilationIn) {
		this.ventilationIn = ventilationIn;
	}
	
	@Override
	public String toString() {
		return "[" + tempMax + "°C, " + tempMin + "°C, " + humMin + "%, " + humTime
				+ "min, light on: " + this.lightOnDate.get(Calendar.HOUR_OF_DAY) + ":" + this.lightOnDate.get(Calendar.MINUTE) + ", light off: " + this.lightOffDate.get(Calendar.HOUR_OF_DAY) + ":" 
				+ this.lightOffDate.get(Calendar.MINUTE) + " Uhr, " + ventilationTime + "min]";
	}
	
	//Check if TimeEnd is smaller than TimeStart
	private void _checkLightRange()
	{
		if (this.lightOffDate.get(Calendar.HOUR_OF_DAY) < this.lightOnDate.get(Calendar.HOUR_OF_DAY))
		{
			lightRangeInverse = true;
		}			
	}

	
}
