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


}

echo date("F", $date) . " " . date("Y", $date);

?>