<?php
//source: http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
include_once 'psl-config.php';   // As functions.php is not included
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);