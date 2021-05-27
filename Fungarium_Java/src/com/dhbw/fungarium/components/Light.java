package com.dhbw.fungarium.components;

import java.util.Calendar;
import java.util.GregorianCalendar;

import org.apache.logging.log4j.LogManager;

import com.pi4j.io.gpio.GpioPinDigitalOutput;

public class Light extends Actor{

	public Light(GpioPinDigitalOutput pin,String bezeichnung) {
		super(pin,bezeichnung, LogManager.getLogger(Light.class));
	}

	public void checkLight() {
		// Check if light has to be switched on/off based on the rules.
		Calendar currentDate = new GregorianCalendar();
		Calendar lightOnDate = gct.getRulesData().getLightOnDate();
		Calendar lightOffDate = gct.getRulesData().getLightOffDate();
	
		if (currentDate.after(lightOnDate) && currentDate.before(lightOffDate)) {
				this.on(); // Light on
				gct.setDayOrNight(true);
		}
		else {
				this.off(); //Light on
				gct.setDayOrNight(false);
		}
	}

	
}

