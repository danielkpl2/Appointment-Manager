<?php

require "../functions.php";
$conn = db_connect();

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $sql = "DELETE FROM timeslot WHERE timeslot.id = $id";

    $result = execute_query($conn, $sql);
}