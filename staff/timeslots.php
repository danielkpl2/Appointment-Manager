<?php
//author: Daniel Kasprowicz
include_once '../includes/db_connect.php';

//if incorrect timezone is set in php.ini change the line date.timezone to "Europe/London" or use the command below
//date_default_timezone_set("Europe/London"); //has to be run every time if timezone in php.ini is different

if(!isset($_POST["date"])) exit;
else{
	$date = $_POST["date"];

	$d = explode(" ",$date); //month + year

	//appending -01 corrects php's strange handling of date conversion on the 31st of the month
	//http://stackoverflow.com/questions/9058523/php-date-and-strtotime-return-wrong-months-on-31st
	$month = date('m',strtotime($d[0] . '-01'));
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


	//http://stackoverflow.com/questions/14260860/multiple-left-joins-on-multiple-tables-in-one-query

	$sql = "SELECT ts.id, ts.date, ts.starttime, ts.endtime, ts.comment, s.forename, s.surname, p.for_name
 FROM
 timeslot as ts LEFT JOIN student as s ON ts.studentid = s.id,
 timeslot as tp LEFT JOIN purpose as p ON tp.purpose = p.for_id
 WHERE (ts.id = tp.id)
 AND (ts.date BETWEEN '$first_day' AND '$last_day')
 AND ts.date >='$ymd' AND NOT (ts.date = '$ymd' AND ts.starttime < '$time') ORDER BY ts.date ASC, ts.starttime ASC";

	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$duration = date("i",strtotime($row["endtime"]) - strtotime($row["starttime"]));
			$id = $row['id'];
			if($row["forename"] != null && $row["surname"] != null){
				echo "<tr class='timeslots booked'>";
			}else echo "<tr class='timeslots unbooked'>";

			echo "<td class='id hide'>$row[id]</td><td style='width: 30px'><button id=\"$id\" class=\"btn btn-xs delete\" role=\"button\"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td><td class='date' style='width: 100px;'>$row[date]</td><td class='starttime'>$row[starttime]</td><td class='endtime'>$row[endtime]</td><td>$duration min</td>";
			echo "<td>$row[for_name]</td><td>$row[forename] $row[surname]</td></tr>";
			if($row["comment"] != null){
				echo "<tr class='note hide'><td colspan='2' class='note-title'>Note: </td><td colspan='5' class='note-content'>$row[comment]</td></tr>";
			}
		}
	}
	else {
		//if (isset($_POST["day"])) echo "<p>No appointments available on $day-$month-$year. Select a day from the calendar to the right -></p>";
		//else if(isset($_POST["week"])) echo "<p>No appointments available between $first_day and $last_day. Select a day from the calendar to the right -></p>";
	}
	$mysqli->close();
}
?>