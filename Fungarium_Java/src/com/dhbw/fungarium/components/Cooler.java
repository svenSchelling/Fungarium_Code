package com.dhbw.fungarium.components;

import org.apache.logging.log4j.LogManager;

import com.pi4j.io.gpio.GpioPinDigitalOutput;

public class Cooler extends Actor{
	
	public Cooler(GpioPinDigitalOutput pin,String bezeichnung) {
		super(pin,bezeichnung, LogManager.getLogger(Cooler.class));
	}
}
