<?php
require "../functions.php";

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


	$conn = db_connect();
/*
	$purpose = array(
		"1" => "General",
		"2" => "Advisor",
		"3" => "Studies"
	);
*/
	$test_note = "As usual, arguments in square brackets are optional, whereas arguments in curly braces are compulsory.".
		"The argument in the curly braces is the name of the image. Write it without the extension. This way the LaTeX compiler".
		" will look for any supported image format in that directory and will take the best one (EPS if the output is DVI; JPEG, ".
		"PNG or PDF if the output is PDF). Images can be saved in multiple formats for different purposes. For example, a directory".
		" can have \"diagram.pdf\" for high-resolution printing, while \"diagram.png\" can be used for previewing on the monitor. You".
		" can specify which image file is to be used by pdflatex through the preamble command:";


	$sql = "SELECT timeslot.id, date, starttime, endtime, forename, surname, comment, for_name FROM purpose, timeslot LEFT JOIN student ON timeslot.studentid = student.id" .
 " WHERE ((timeslot.purpose is NULL AND (timeslot.purpose is null AND purpose.for_id is null)) OR timeslot.purpose = purpose.for_id) AND (date BETWEEN '$first_day' AND '$last_day') AND date >='$ymd' AND NOT (date = '$ymd' AND starttime < '$time') ORDER BY date ASC, starttime ASC";
	//echo $sql;

	$result = execute_query($conn, $sql);

	if ($result->num_rows > 0) {
		//echo "<table class='table'><tr><th>Date</th><th>Start</th><th>End</th><th>Duration</th><th>Student</th><th>Purpose</th><th>Note</th></tr>";
		while($row = $result->fetch_assoc()) {
			$duration = date("i",strtotime($row["endtime"]) - strtotime($row["starttime"]));
			$id = $row['id'];
			echo "<tr class='timeslots'><td class='id hide'>$row[id]</td><td style='width: 30px'><a href='#' onclick=\"del($id);\" class='btn btn-xs delete' role='button'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td><td class='date'>$row[date]</td><td class='starttime'>$row[starttime]</td><td class='endtime'>$row[endtime]</td><td>$duration min</td>";
			//echo "<td>$row[for_name]</td><td>$row[forename] $row[surname]</td><td>$row[comment]</td></tr>";
			echo "<td>$row[for_name]</td><td>$row[forename] $row[surname]</td></tr>";
			if($row["comment"] != null){
				echo "<tr class='note hide'><td colspan='2' class='note-title'>Note: </td><td colspan='5' class='note-content'>$row[comment]</td></tr>";
			}

		}
		//echo "</table>";
	}
	else {
		//if (isset($_POST["day"])) echo "<p>No appointments available on $day-$month-$year. Select a day from the calendar to the right -></p>";
		//else if(isset($_POST["week"])) echo "<p>No appointments available between $first_day and $last_day. Select a day from the calendar to the right -></p>";
	}
	close_connection($conn);


}


?>