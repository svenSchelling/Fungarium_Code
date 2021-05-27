<?php
	// get Humidity and Temperature Data of the DHT out of DB and save as json 
	// The saved data in the json is needed to draw LineChart and Datatable 'Luftfeuchtigkeit' and 'Temperatur'
	
	header('Content-Type: application/json');

	// Database Login
	include_once "databaseLogin.php";

	//execute query
	$result = $db->query("SELECT * FROM dht ORDER BY id");
	$data = array();

	foreach ($result as $row) {
		$zwData = $row;
		$time = $row["Zugriff"];
		$hourTime = substr($time, 11, -3); // format time data (HH:MM)
		$day = substr($time, 8, -9); // format time data (dd)
		$month = substr($time, 5, -12); // format time data (mm)
		$year = substr($time, 2, 2); // format time data (YY)
		$timeNew = $day . '.' . $month . '.' . $year . ' ' . $hourTime;
		$zwData["Zugriff"] = $timeNew;
		$zwData["ZugriffDefault"] = $time;
		$data[] = $zwData;
		
	}
		//execute query
	$result = $db->query("SELECT * FROM einstellungen ORDER BY id");

	foreach ($result as $row) {
		if ($row["Bezeichnung"] == 'Mindesttemperatur') {
			for ($i=0;$i<sizeof($data);$i=$i+1){
			$data[$i]['Mindesttemperatur'] = $row['Wert'];
			}
		}
		if ($row["Bezeichnung"] == 'Höchsttemperatur') {
			for ($i=0;$i<sizeof($data);$i=$i+1){
			$data[$i]['Hoechsttemperatur'] = $row['Wert'];
			}
		}
		if ($row["Bezeichnung"] == 'Mindestfeuchtigkeit') {
			for ($i=0;$i<sizeof($data);$i=$i+1){
			$data[$i]['Mindestfeuchtigkeit'] = $row['Wert'];
			}
		}
		if ($row["Bezeichnung"] == 'MindesttemperaturNacht') {
			for ($i=0;$i<sizeof($data);$i=$i+1){
			$data[$i]['MindesttemperaturNacht'] = $row['Wert'];
			}
		}
		if ($row["Bezeichnung"] == 'HöchsttemperaturNacht') {
			for ($i=0;$i<sizeof($data);$i=$i+1){
			$data[$i]['HoechsttemperaturNacht'] = $row['Wert'];
			}
		}
	}

	echo json_encode($data);
?>
