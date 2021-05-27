package com.dhbw.fungarium.components;

import java.util.Timer;
import java.util.TimerTask;

import org.apache.logging.log4j.LogManager;

import com.dhbw.fungarium.sensor.Dht22;
import com.pi4j.io.gpio.GpioPinDigitalOutput;

public class Fan extends Actor {

	public Fan(GpioPinDigitalOutput pin, String bezeichnung) {
		super(pin, bezeichnung, LogManager.getLogger(Fan.class));
	}

	private Dht22 dht22Sensor;
	private RegVentilation ventilation;

	public void setVentilation(RegVentilation ventilation) {
		this.ventilation = ventilation;
	}

	public void setDht22Sensor(Dht22 dht22Sensor) {
		this.dht22Sensor = dht22Sensor;
	}

	public void FanIn() {
		gct.setVentilationstatus(true);
		// Starts the Fan for an interval specified by the user
		lgdb.info("Starts Ventilation routine");
		this.on();
	
		Timer Timer = new Timer();
		TimerTask FanIn = new TimerTask() {
			public void run() {

				// Turn off Fan if Humidification is not alive or if Fanlow is not equal to fan
				if (!gct.isHumidificationstatus() || !gct.isFanconf())
					turn_Channel_off();
				lgdb.info("Ends Ventilation routine");
				gct.setVentilationstatus(false);

				synchronized (ventilation) {
					ventilation.notify();
				}

				// Initiate measurement
				dht22Sensor.doMeter();
				Timer.cancel();
			}
		};
		Timer.schedule(FanIn, gct.getRulesData().getVentilationTime() * 1000 * 60);
	}

	// This method is necessary because the fan is not visible within the timer task
	protected void turn_Channel_off() {
		this.off();
	}

	

}
