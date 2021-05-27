<?php
	// get 'Protokoll' data out of DB and save as json 
	// The saved data in the json is needed to draw Datatable 'Protokoll'

	header('Content-Type: application/json');
	
	// Database Login
	include_once "databaseLogin.php";

	// execute query
	$result = $db->query("SELECT * FROM protokoll ORDER BY id");
	$data = array();

	foreach ($result as $row) {
		$zwData = $row;
		$time = $row["Zugriff"];
		$hourTime = substr($time, 11, -3); // format time data (HH:MM)
		$day = substr($time, 8, -9); // format time data (dd)
		$month = substr($time, 5, -12); // format time data (mm)
		$year = substr($time, 2, 2); // format time data (YY)
		$time = $day . '.' . $month . '.' . $year . ' ' . $hourTime;
		$zwData["2"] = $time;
		$zwData["Zugriff"] = $time;
		$data[] = $zwData;
	}

	echo json_encode($data);
?>
