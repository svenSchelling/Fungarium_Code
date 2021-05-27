package com.dhbw.fungarium.sensor;


public class SensorData {
	public SensorData(String sensorLocation, float hum, float temp) {
		super();
		this.sensorLocation = sensorLocation;
		this.humidity = hum;
		this.temperature = temp;
	}
	private String sensorLocation;
	private float humidity;
	private float temperature;
	
	public float getHumidity() {
		return humidity;
	}
	public void setHumidity(int humidity) {
		this.humidity = humidity;
	}
	public float getTemperature() {
		return temperature;
	}
	public void setTemperature(int temperature) {
		this.temperature = temperature;
	}
	
	public String getSensorLocation() {
		return sensorLocation;
	}
	
	@Override
	public String toString() {
		return "[" +	sensorLocation + ", " + humidity +"% , " +  temperature + "°C]";
		//return new Date(this.timestamp) + "-" + "SensorLocation:" + this.sensorLocation + ", Temperature:" + this.temperature + " Humidity:" + this.humidity;
	}
}
