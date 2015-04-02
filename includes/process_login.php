<?php
//source: http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
//modified by Daniel Kasprowicz
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.

    if (login($email, $password, $mysqli) == true) {
        // Login success
        //echo "successfully logged in";
        header('Location: ../staff/');
    } else {
        // Login failed

        //echo "login failed";
        header('Location: ../staff/signin.php?loginfailed=1');
    }
} else {
    // The correct POST variables were not sent to this page.
    echo 'Invalid Request';
}