package com.dhbw.fungarium.components;

import org.apache.logging.log4j.LogManager;

import com.pi4j.io.gpio.GpioPinDigitalOutput;


public class Heater extends Actor{
	
	public Heater(GpioPinDigitalOutput pin, String bezeichnung) {
		super(pin,bezeichnung,LogManager.getLogger(Heater.class));
	}
	
}