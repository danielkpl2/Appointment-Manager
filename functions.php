<?php
  function db_connect() {
	$servername ="localhost";
	$username ="root";
	$password ="";
	$dbname ="TeamX14";

    $dbh = new mysqli($servername, $username, $password, $dbname);
    if ($dbh->connect_error)
       {    die("Error in connection: " . $dbh->connect_error); }
    else {return $dbh; } //returns a working connection 
  }

  // executes a query ($sql) against the database connection ($dbc) and returns the result set
  function execute_query($dbc, $sql)  {
         $result = $dbc->query($sql);
         if (!$result)  { 
               printf("Errormessage: %s\n", $dbc->error);	}
         else {return $result;}
  }

  //frees up memory used for the database connection and closes the connection
  function close_connection($dbc)
  {
	  $dbc->close();
  }
  
  function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}

?>
