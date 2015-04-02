<?php
//author: Daniel Kasprowicz
include_once '../includes/db_connect.php';


if($_POST["has_account"]=="0"){
	if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])){
		$name = $_POST["name"];
		$n = explode(" ", $name);
		$fname = $n[0];
		if(count($n)==1) $sname = ""; else $sname = $n[1];
		if(isset($_POST["email"]) && $_POST["email"] != '') $email = $_POST["email"]; else $email=NULL;
		$password = $_POST["password"];
		if(isset($_POST["guid"]) && $_POST["guid"] != '') $guid = $_POST["guid"]; else $guid=NULL;

		/*if either email or guid is null it has to be inserted without quotes but HAS TO be enclosed within quotes if they're not null. Prepared statements solve this problem.
		http://php.net/mysqli.prepare */
		$stmt = $mysqli->prepare("INSERT INTO student(guid, forename, surname, email, password) VALUES(?,?,?,?,?)");

		$stmt->bind_param("sssss", $guid, $fname, $sname, $email, $password); //the first argument is the data type for the 5 arguments, s is for string
		$stmt->execute();
		//echo "<p>User account successfully created.</p>";

		//get the autoincrement id after last insertion into student table
		$studentid = $mysqli->insert_id;

	}
}else if($_POST["has_account"]=="1"){
	//If has account, figure out the studentid from guid or email

	$guidemail = $_POST["guid/email"];
	$password = $_POST["password"];
	//figure out whether guid or email was specified
	$sql = "SELECT id FROM student WHERE guid = '$guidemail'";
	$result = $mysqli->query($sql);
	if($result->num_rows==0){ // not guid (or doesn't exist) - check for email
		$sql = "SELECT id FROM student WHERE email = '$guidemail'";
		$result = $mysqli->query($sql);
		if($result->num_rows==0){ // no such user

			//echo "<p>User not found.</p>";
			echo "<script>alert(\"User not found.\");</script>";
			$mysqli->close();
			exit; //stop executing the script here

		} else { //$guidemail is email
			$row = $result->fetch_assoc();
			$studentid = $row["id"];
			$sql = "SELECT id FROM student WHERE password = '$password' AND email = '$guidemail'";
			$result = $mysqli->query($sql);
			if($result->num_rows==0){
				//echo "<p>Wrong password.</p>";
				echo "<script>alert(\"Wrong password\");</script>";
				$mysqli->close();
				exit;
			}
		}
	} else { //$guidemail is guid

		$row = $result->fetch_assoc();
		$studentid = $row["id"];
		$sql = "SELECT id FROM student WHERE password = '$password' AND guid = '$guidemail'";
		$result = $mysqli->query($sql);
		if($result->num_rows==0){
			//echo "<p>Wrong password.</p>";
			echo "<script>alert(\"Wrong password\");</script>";
			$mysqli->close();
			exit;
		}
	}
}

$purpose = $_POST["purpose"];
$note = $_POST["note"];
$id = $_POST["id"];


$sql = "UPDATE timeslot SET studentid = '$studentid', purpose = '$purpose', comment = '$note' WHERE timeslot.id = '$id'";
$mysqli->query($sql);
//echo "<p>User succesfully booked for the selected timeslot.</p>";
echo "<script>alert(\"Successfully booked for the selected timeslot\");</script>";
$mysqli->close();
?>
