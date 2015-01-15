<?php
	require "functions.php";
	if(isset($_POST["day"]) && isset($_POST["date"])){
		$day = $_POST["day"];
		$date = $_POST["date"];
		
		$d = explode(" ",$date); //month + year
		
		$month = date('m',strtotime($d[0]));
		$year = $d[1];
		
		$conn = db_connect();
		$sql="SELECT * FROM timeslot WHERE studentid IS NULL AND date='$year-$month-$day' ORDER BY date ASC, starttime ASC;";
		$result = execute_query($conn, $sql);
		
		if ($result->num_rows > 0) {
			echo "<table class='table'><tr><th>Date</th><th>Start Time</th><th>End Time</th><th>Duration</th></tr>";
			while($row = $result->fetch_assoc()) {
				$duration = date("i",strtotime($row["endtime"]) - strtotime($row["starttime"]));
				echo "<tr class='timeslots'><td class='id hide'>$row[id]</td><td class='date'>$row[date]</td><td class='starttime'>$row[starttime]</td><td class='endtime'>$row[endtime]</td><td>$duration min</td></tr>";
			}
			echo "</table>";
		}
		close_connection($conn);
	}
	
?>