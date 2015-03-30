<?php
require "../functions.php";
$conn = db_connect();

if(isset($_POST["date"], $_POST["start"], $_POST["end"])){
	$date = $_POST["date"];
	$start = $_POST["start"];
	$end = $_POST["end"];
	$staffid = 2;
	$null = NULL;

	$stmt = $conn->prepare("INSERT INTO timeslot(starttime, endtime, date, staffid, studentid, purpose, comment ) VALUES(?,?,?,?,?,?,?)");
	$stmt->bind_param("sssisss", $start, $end, $date, $staffid, $null, $null, $null);
	$stmt->execute();

	//echo "<p>Successfully added timeslot $date $start $end</p>";
}

/*
$stmt = $conn->prepare("INSERT INTO student(guid, forename, surname, email, password) VALUES(?,?,?,?,?)");

$stmt->bind_param("sssss", $guid, $fname, $sname, $email, $password); //the first argument is the data type for the 5 arguments, s is for string
$stmt->execute();

*/
	
?>
