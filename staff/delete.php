<?php
//author: Daniel Kasprowicz

include_once '../includes/db_connect.php';


if(isset($_POST["id"])){
    $id = $_POST["id"];
    $sql = "DELETE FROM timeslot WHERE timeslot.id = $id";

    $result = $mysqli->query($sql);
    $mysqli->close();
}