<?php
//author: Daniel Kasprowicz
//Started with this: http://php.about.com/od/finishedphp1/ss/php_calendar.htm

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

date_default_timezone_set("Europe/London");
$date = "";
$btn = "";
if(isset($_POST["date"]) && isset($_POST["button"])){
	
	$tempdate = $_POST["date"]; //"date" will be e.g. January 2014
	$btn = $_POST["button"];

	if($btn == "prev"){
		$date = strtotime($tempdate . " -1 Months");
	}
	 else if($btn == "next"){
	 	$date = strtotime($tempdate . " +1 Months");
	 }
	
	
}else $date = time();


if (login_check($mysqli) == true) {
	$manage = ""; //staff queries return booked and unbooked timeslots
} else {
	$manage = "AND studentid is null"; //student queries return unbooked timeslots
}


$ymd = date('Y-m-d');
$time = date('H:i:s');

$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);

$first_day = mktime(0, 0, 0, $month, 1, $year);
$monthTitle = date('F', $date);

$day_of_week = date('N', $first_day) - 1; //day of week - 1; 0 = Mon...6 = Sun

$days_in_month = cal_days_in_month(0, $month, $year);

$prev_month_date = strtotime("$year-$month -1 Months");
$next_month_date = strtotime("$year-$month +1 Months");

$prev_month = date("m", $prev_month_date);
$prev_month_year = date('Y', $prev_month_date);

$next_month = date("m", $next_month_date);
$next_month_year = date('Y', $next_month_date);

$prev_day_of_week = date('N', mktime(0,0,0, $prev_month, 1, $prev_month_year)) - 1; //day of week of first day of previous month

$days_in_prev_month = cal_days_in_month(0, $prev_month, $prev_month_year); //the number of days of previous month


if(!(isset($_POST["date"]) && isset($_POST["button"]))){ //first call, print buttons and day headings
	echo "<div id='table_wrapper'>";
	echo "<div id='table_header'><table class='table'><tr><th id = 'prevbtn' class='table-title'>";
	echo "<button id = 'prev' class='btn btn-xs'><span class='glyphicon glyphicon-arrow-left' aria-hidden='true'></span></button></th>";
	echo "<th id = 'date_wrapper' class='table-title' colspan=6><span id ='date' value='$year-$month'>$monthTitle $year</span></th>";
	echo "<th id = 'nextbtn' class='table-title'>";
	echo "<button id = 'next' class='btn btn-xs'><span class='glyphicon glyphicon-arrow-right' aria-hidden='true'></span></button></th></tr>";
	echo "<tr><th>Wk</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th><th>Su</th></tr></table></div>";
	echo "<div id='table_content'><table class='table calendar'>";

}

$sql = "SELECT DISTINCT DAY(date) as day FROM timeslot WHERE MONTH(date) = \"$prev_month\" AND YEAR(date) = \"$prev_month_year\" AND date >= \"$ymd\" $manage;";
$result = $mysqli -> query($sql);

$prev_month_available = array();

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$prev_month_available[] = $row["day"]; //add days when there are appointments available to the array
	}
}



$sql = "SELECT DISTINCT DAY(date) as day FROM timeslot WHERE MONTH(date) = \"$month\" AND YEAR(date) = \"$year\" AND date >= \"$ymd\" $manage;";
$result = $mysqli -> query($sql);

$available = array();

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$available[] = $row["day"]; //add days when there are appointments available to the array
	}
}


$sql = "SELECT DISTINCT DAY(date) as day FROM timeslot WHERE MONTH(date) = \"$next_month\" AND YEAR(date) = \"$next_month_year\" AND date >= \"$ymd\" $manage;";
$result = $mysqli -> query($sql);

$next_month_available = array();

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$next_month_available[] = $row["day"]; //add days when there are appointments available to the array
	}
}

$day_count = 1;

$prev_days_to_print = $days_in_prev_month;
$curr_days_to_print = $days_in_month;
$next_days_to_print = 42 - ($day_of_week + $curr_days_to_print); //42 - $day_of_week + $days_in_month

$curr_day_start = 1;

$JQuery_to_execute_after = "";

$slide = 6;

if($btn == "prev"){
	if($day_of_week + $days_in_month < 35){
		//don't print next month days
		$next_days_to_print = 0;
		//skip last 2 rows
		$curr_days_to_print = 28 - $day_of_week;
		$rows_to_remove = 4;

	}else if($day_of_week + $days_in_month >= 35){
		//don't print next month days
		$next_days_to_print = 0;
		//skip last row
		$curr_days_to_print = 35 - $day_of_week;
		$rows_to_remove = 5;

	}
	$slide = 37 * $rows_to_remove . "px";

	$JQuery_to_execute_after = "| $(\".calendar\").css({top:\"-$slide\"}); $(\".calendar\").animate({top : \"0px\"},500, function() { $(\"#table_content tr:gt(5)\").remove();});";

}else if($btn == "next"){
	if($prev_day_of_week + $days_in_prev_month < 35){
		//don't print prev month days
		$prev_days_to_print = 0;
		//skip first 2 rows
		$curr_day_start = 7 - $day_of_week + 7 + 1;
		$rows_to_remove = 4;


	}else if($prev_day_of_week + $days_in_prev_month >= 35){
		//don't print prev month days
		$prev_days_to_print = 0;
		//skip first row
		$curr_day_start = 7 - $day_of_week + 1;
		$rows_to_remove = 5;
	}

	$slide = 37 * $rows_to_remove . "px";

	$JQuery_to_execute_after = "| $(\".calendar\").animate({top: \"-$slide\"},500, function() { $(\"#table_content tr:lt($rows_to_remove)\").remove(); $(\".calendar\").css({top: \"0px\"});});";

}
$weekNum = date('W', strtotime("$year-$month-$curr_day_start"));
echo "<tr><th class='weekNum'>" . $weekNum . "</th>";
$weekNum = date('W', strtotime("$year-$month-$curr_day_start +1 week")); //increment week

//previous month days
for($i = $days_in_prev_month - $day_of_week + 1; $i <= $prev_days_to_print; $i++){ //for March, prev month is Feb, 28 - 6 + 1 = 23

	if($day_count > 7){
		echo "<tr><th class='weekNum'>" . $weekNum . "</th>";
		$weekNum = date('W', strtotime("$year-$month-$i +1 week")); // increment week

		$day_count = 1;
	}

	if($i == date('d') && $prev_month == date('m') && $prev_month_year == date('Y') && in_array($i, $prev_month_available)){ //if today and available
		echo "<td id='today' class='prev_data available'>$i</td>";

	} else if($i == date('d') && $prev_month == date('m') && $prev_month_year == date('Y')){ // if today
		echo "<td id='today' class='prev_data'>$i</td>";
	} else if(in_array($i, $prev_month_available)){ //if available
		echo "<td class='prev_data available'>$i</td>";
	}
	else echo "<td class='prev_data'>$i</td>";

	$day_count++;

	if ($day_count > 7) {
		echo "</tr>";
	}
}
//current month days
for($i = $curr_day_start; $i <= $curr_days_to_print; $i++){

	if($day_count > 7){
		echo "<tr><th class='weekNum'>" . $weekNum . "</th>";
		$weekNum = date('W', strtotime("$year-$month-$i +1 week")); // increment week

		$day_count = 1;
	}


	if($i == date('d') && $month == date('m') && $year == date('Y') && in_array($i, $available)){ //if today and available
		echo "<td id='today' class='data available'>$i</td>";

	} else if($i == date('d') && $month == date('m') && $year == date('Y')){ // if today
		echo "<td id='today' class='data'>$i</td>";
	} else if(in_array($i, $available)){ //if available
		echo "<td class='data available'>$i</td>";
	}
	else echo "<td class='data'>$i</td>";

	$day_count++;

	if ($day_count > 7) {
		echo "</tr>";
	}

}


//next month days
for($i = 1; $i <= $next_days_to_print; $i++){

	if($day_count > 7){
		echo "<tr><th class='weekNum'>" . $weekNum . "</th>";
		$weekNum = date('W', strtotime("$year-$month-$i +1 week")); // increment week

		$day_count = 1;
	}

	if($i == date('d') && $next_month == date('m') && $next_month_year == date('Y') && in_array($i, $next_month_available)){ //if today and available
		echo "<td id='today' class='next_data available'>$i</td>";

	} else if($i == date('d') && $next_month == date('m') && $next_month_year == date('Y')){ // if today
		echo "<td id='today' class='next_data'>$i</td>";

	} else if(in_array($i, $next_month_available)){ //if available

		echo "<td class='next_data available'>$i</td>";
	}
	else echo "<td class='next_data'>$i</td>";

	$day_count++;

	if ($day_count > 7) {
		echo "</tr>";
	}
}


if(!(isset($_POST["date"]) && isset($_POST["button"]))){
	echo "</table></div></div>";
}
echo $JQuery_to_execute_after;
$mysqli->close();
?>