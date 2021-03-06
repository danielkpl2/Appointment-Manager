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
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<span class="navbar-brand">Student appointment booking page for Helen Purchase</span>

				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-md-3">
					
					<ul class="sidebar-nav">
						
						<li>
							<a href="../student/">Available appointments</a>
						</li>
						<li>
							<a href="#" class="selected">My appointments</a>
						</li>
						<li>
							<a href="contact.php">Contact information</a>
						</li>
					</ul>

				</div>
					
				<div class="col-md-6">
					<h4>My booked appointments</h4>
					<div id="timeslots">List of timeslots goes here</div>

				</div>

				<div class="col-md-3">

				</div>

			</div>
		</div>
		
		<script src="../js/script.js"></script>

	</body>

</html>