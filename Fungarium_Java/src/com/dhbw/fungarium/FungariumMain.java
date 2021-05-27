package com.dhbw.fungarium;

public class FungariumMain {
	
	//We have outsourced the Fungarium class to avoid that all methods of the class being static
	
	public static void main(String[] args) {
		new Fungarium().doFungarium();
	}
}
