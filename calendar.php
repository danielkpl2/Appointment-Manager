<?php

include "functions.php";
//http://php.about.com/od/finishedphp1/ss/php_calendar.htm

date_default_timezone_set("Europe/London");
$date = "";
if(isset($_POST["date"]) && isset($_POST["button"])){
	
	$tempdate = $_POST["date"]; //"date" will be e.g. January 2014
	$btn = $_POST["button"];
	//echo $tempdate . $btn;
	
	
	if($btn == "prev"){
		$date = strtotime($tempdate . " -1 Months");
		//echo date('d-m-Y', $date);
		
		
		//$date = getprevmonth(tempdate);
	}
	 else if($btn == "next"){
	 	$date = strtotime($tempdate . " +1 Months");
		//echo date('d-m-Y', $date);
	 //date = getnextmonth(tempdate);
	 }
	
	
}else $date = time();

//echo "<script>alert($date);</script>";

//$date = time();

$today = time();

$day = date('d', $date);
$month = date('m', $date);
$monthname = date("F", $date);

$year = date('Y', $date);

//echo "$monthname $year";

$first_day = mktime(0, 0, 0, $month, 1, $year);
$title = date('F', $first_day);

$day_of_week = date('D', $first_day);

switch($day_of_week) {
	case "Mon" :
		$blank = 0;
		break;
	case "Tue" :
		$blank = 1;
		break;
	case "Wed" :
		$blank = 2;
		break;
	case "Thu" :
		$blank = 3;
		break;
	case "Fri" :
		$blank = 4;
		break;
	case "Sat" :
		$blank = 5;
		break;
	case "Sun" :
		$blank = 6;
		break;
}

$days_in_month = cal_days_in_month(0, $month, $year);

if(!(isset($_POST["date"]) && isset($_POST["button"]))){
	echo "<div id='table_wrapper'>";
	//create buttons before the table then jquery will insert them into the heading of the table.
	echo "<button id = 'prev' class='btn btn-xs'><span class='glyphicon glyphicon-arrow-left' aria-hidden='true'></span></button>";
	echo "<button id = 'next' class='btn btn-xs'><span class='glyphicon glyphicon-arrow-right table-title' aria-hidden='true'></span></button><div id='table'>";
	

}else{
	
	
}
	echo "<table class='table calendar'><tr><th id = 'prevbtn' class='table-title'></th>";
	echo "<th id = 'date_wrapper' class='table-title' colspan=5><span id ='date'>$title $year</span></th>";
	echo "<th id = 'nextbtn' class='table-title'></th></tr>";
	echo "<tr><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th><th>Su</th></tr>";


$day_count = 1;

echo "<tr>";
while ($blank > 0) {
	echo "<td></td>";
	--$blank;
	++$day_count;
}

$conn = db_connect();
//returns a list of days to hilight.
//echo $month;

$sql = "SELECT DISTINCT DAY(date) as day FROM timeslot WHERE MONTH(date) = \"$month\" AND studentid is null"; 
$result = execute_query($conn, $sql);

$available = array();

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	$available[] = $row["day"]; //add days when there are appointments available to the array
	}

}

$day_num = 1;

while ($day_num <= $days_in_month) {
	if($day_num == date('d',$today) && $month == date('m',$today) && $year == date('Y',$today) && in_array($day_num, $available)){
		echo "<td id='today' class='data available'>$day_num</td>";
	
	} else if($day_num == date('d',$today) && $month == date('m',$today) && $year == date('Y',$today)){
		echo "<td id='today' class='data'>$day_num</td>";
	} else if(in_array($day_num, $available)){
		echo "<td class='data available'>$day_num</td>";
	}
	else echo "<td class='data'>$day_num</td>";
	++$day_num;
	++$day_count;
	if ($day_count > 7) {
		echo "</tr><tr>";
		$day_count = 1;
	}

}

while ($day_count <= 7) {
	echo "<td></td>";
	++$day_count;
}
echo "</tr></table>";

if(!(isset($_POST["date"]) && isset($_POST["button"]))){
	echo "</div></div>";
}
close_connection($conn);
?>