<?php
require "../functions.php";

//if incorrect timezone is set in php.ini change the line date.timezone to "Europe/London" or use the command below
//date_default_timezone_set("Europe/London"); //has to be run every time if timezone in php.ini is different

if(!isset($_POST["date"])) exit;
else{
	$date = $_POST["date"];

	$d = explode(" ",$date); //month + year

	$month = date('m',strtotime($d[0]));
	$year = $d[1];

	$ymd = date('Y-m-d',time());
	$time = date('H:i:s');
	$dates = array();

	$first_date= "";
	$last_day = "";


	if(isset($_POST["day"])){
		$day = $_POST["day"];
		$first_day = $last_day = "$year-$month-" . sprintf("%02d", $day); //adds leading zero

	}else if(isset($_POST["week"])){
		$week = $_POST["week"];
		$first_day = date('Y-m-d', strtotime($year."W".$week.'1'));
		$last_day = date('Y-m-d', strtotime($year."W".$week.'7'));


	}else exit;


	$conn = db_connect();

	$sql = "SELECT * FROM timeslot WHERE studentid IS NULL AND (date BETWEEN '$first_day' AND '$last_day') AND date >='$ymd' AND NOT (date = '$ymd' AND starttime < '$time') ORDER BY date ASC, starttime ASC";
	//echo $sql;

	$result = execute_query($conn, $sql);

	if ($result->num_rows > 0) {
		echo "<table class='table'><tr><th>Date</th><th>Start Time</th><th>End Time</th><th>Duration</th></tr>";
		while($row = $result->fetch_assoc()) {
			$duration = date("i",strtotime($row["endtime"]) - strtotime($row["starttime"]));
			echo "<tr class='timeslots'><td class='id hide'>$row[id]</td><td class='date'>$row[date]</td><td class='starttime'>$row[starttime]</td><td class='endtime'>$row[endtime]</td><td>$duration min</td></tr>";
		}
		echo "</table>";
	}
	else {
		if (isset($_POST["day"])) echo "<p>No appointments available on $day-$month-$year. Select a day from the calendar to the right -></p>";
		else if(isset($_POST["week"])) echo "<p>No appointments available between $first_day and $last_day. Select a day from the calendar to the right -></p>";
	}
	close_connection($conn);


}

	
?>