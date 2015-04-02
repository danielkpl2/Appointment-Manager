<?php
//author: Daniel Kasprowicz
//require "../functions.php";
include_once '../includes/db_connect.php';


if(isset($_POST["date"], $_POST["start"], $_POST["end"])){
	$date = $_POST["date"];
	$start = $_POST["start"];
	$end = $_POST["end"];
	$staffid = 2;
	$null = NULL;

	$stmt = $mysqli->prepare("INSERT INTO timeslot(starttime, endtime, date, staffid, studentid, purpose, comment ) VALUES(?,?,?,?,?,?,?)");
	$stmt->bind_param("sssisss", $start, $end, $date, $staffid, $null, $null, $null);
	$stmt->execute();
	$mysqli->close();
}
	
?>
