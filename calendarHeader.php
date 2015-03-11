<?php

date_default_timezone_set("Europe/London");
$date = "";
if(isset($_POST["date"]) && isset($_POST["button"])){

    $tempdate = $_POST["date"]; //"date" will be e.g. January 2014
    $btn = $_POST["button"];

    if($btn == "prev"){
        $date = strtotime($tempdate . " -1 Months");
    }
    else if($btn == "next"){
        $date = strtotime($tempdate . " +1 Months");

    }
    $monthTitle = date('F', $date);
    $month = date('m', $date);
    $year = date('Y', $date);

}

//echo date("F", $date) . " " . date("Y", $date);

echo "<span id ='date' value='$year-$month'>$monthTitle $year</span>";

?>