<?php
//author: Daniel Kasprowicz

include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

sec_session_start();
if(!login_check($mysqli)){
    header('Location: signin.php');
    exit;
}
//if(login_check($mysqli) == true):
    // Add your protected page content here!
    //echo "logged in <a href=\"../includes/logout.php\">";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Appointment Manager</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <script src="../js/jquery.min.js"></script>



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!--
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            -->

            <span class="navbar-brand">Staff appointment management page for Helen Purchase</span>

        </div>

        <p class="navbar-text navbar-right">
            <a class="signout" href="../includes/logout.php">Sign out</a>
        </p>


    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-3">

            <ul class="sidebar-nav">

                <li>
                    <a class="selected" href="#">Appointments</a>
                </li>
                <li>
                    <a href="configure.php">Configure</a>
                </li>
                <li>
                    <a href="contact.php">Contact information</a>
                </li>
            </ul>


        </div>

        <div class="col-md-6">
            <h4>Available appointment times for Helen Purchase</h4>
            <div id="timeslots">

                <table class='table'><tr><th style="width: 30px"></th><th style="width: 100px;">Date</th><th>Start</th><th>End</th><th>Duration</th><th>Purpose</th><th>Student</th></tr></table>
                <table class="table slots"></table>
                <form name="form_staff">
                <table class="table insert">

                        <tr><td style="width: 30px"><button  name="submit" class='btn btn-xs' type="submit"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button></td>
                        <td style="width: 100px;"><input type="text" class="form-control" name="date"/></td>
                        <td><input type="text" class="form-control" name="start"/></td><td ><input type="text" class="form-control" name="end"/></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>

                </table>
                </form>

            </div>

            <div class="response"></div>

        </div>
        <div class="col-md-3">
            <?php include ("../calendar.php"); ?>

        </div>
    </div>
</div>

<script src = "../js/script.js"></script> <!--common to both staff and student pages-->
<script src="../js/staff.js"></script> <!--specific only to staff's page -->


</body>

</html>