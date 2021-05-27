<?php
	// get 'Protokoll' data out of DB and save as json 
	// The saved data in the json is needed to draw Datatable 'Protokoll'
	
	header('Content-Type: application/json');

	// Database Login
	include_once "databaseLogin.php";

	// execute query
	$result = $db->query("SELECT * FROM protokoll ORDER BY id");
	$data = array();
	$i = 1;
	$k = 1;
	foreach ($result as $row) {
		$bauteil = $row["Bauteil"];
		if ($bauteil == 'lueftung') {
			if ($i != 1) {
				$zustand = $rowVorher["An"];
				$rowakt = $row;
				$rowakt["An"] = $zustand;
				$data[] = $rowakt;
			}
			$data[] = $row;
			$i = $i + 1;
			$rowVorher = $row;
		}
		if ($bauteil == 'lueftungNiedertourig') {
			if ($i != 1) {
				$rowakt = $row;
				$rowakt["An"] = $zustand;
				$data[] = $rowakt;
			}			
			if ($row["An"] == "1") {
					$row["An"] = "0.5";
			}
			$data[] = $row;
			$i = $i + 1;
			$rowVorher = $row;
		}
		
	}
	date_default_timezone_set("Europe/Berlin");
	$timestamp = time();
	$aktuelleUhrzeit = date("H:i", $timestamp);
	$aktuelleUhrzeit = date("Y-m-d H:i:s", $timestamp);
	$rowVorher["Zugriff"] = $aktuelleUhrzeit;
	$data[] = $rowVorher;

	echo json_encode($data);
?>
