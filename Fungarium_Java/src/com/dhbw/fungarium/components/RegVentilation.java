package com.dhbw.fungarium.components;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;

import com.dhbw.config.GCT;


public class RegVentilation extends Thread {

	private final static Logger lg = LogManager.getLogger("DBlog");
	
	private Fan fan;
	private GCT gct;

	public RegVentilation(Fan fan) {
		super();
		this.fan = fan;
		this.gct = GCT.getInstance();
	}

	public void run() {
		while (true) {
			try {
				if (fan.pin.isHigh() && !gct.isHumidificationstatus()) {
					
					// Start Ventilation
					fan.FanIn();
					
					// Waits until the ventilation has ended 
					synchronized (this) {
						wait();
					}
				}
				Thread.sleep((gct.getRulesData().getVentilationIn()) * 1000 * 60);
			} catch (InterruptedException e) {
				lg.info("{}", e.getMessage());
			}
		}
	}

}
