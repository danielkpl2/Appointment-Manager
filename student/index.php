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
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		

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

				<p class="navbar-text navbar-right">
					Sign in
				</p>

			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-md-3">
					
					<ul class="sidebar-nav">
						
						<li>
							<a class="selected" href="">Available appointments</a>
						</li>
						<li>
							<a href="myappointments.php">My appointments</a>
						</li>
						<li>
							<a href="#">Contact information</a>
						</li>
					</ul>
					

				</div>
					
					<div class="col-md-6">
					<h4>Available appointment times for Helen Purchase</h4>
						<div id="timeslots">
							List of timeslots goes here
						</div>
						<div id="form">
							
							<form class="form-horizontal" name="form">
							<!--<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>-->

								<div class="form-group radio">
									<label class="radio-inline"><input type="radio" name="has_account" id="no" value="0" checked>New user</label>
									<label class="radio-inline"><input type="radio" name="has_account" id="yes" value="1">Existing user</label>
								</div>
								
								
								
								
								<!-- Text input-->
								<div class="form-group show">
								  <label class="col-md-4 control-label" for="name">Name</label>  
								  <div class="col-md-6">
									<input id="name" name="name" placeholder="" class="form-control input-md" required type="text">
									 
								  </div>
								</div>

								<!-- Text input-->
								<div class="form-group show">
								  <label class="col-md-4 control-label" for="email">Email address</label>  
								  <div class="col-md-6">
									<input id="email" name="email" placeholder="" class="form-control input-md" required type="text">
									 
								  </div>
								</div>

								<!-- Text input-->
								<div class="form-group show">
								  <label class="col-md-4 control-label" for="GUID">GUID</label>  
								  <div class="col-md-6">
									<input id="guid" name="guid" placeholder="" class="form-control input-md" type="text">
									 
								  </div>
								</div>

								<div class="form-group hide">
								  <label class="col-md-4 control-label" for="GUID/email">GUID/Email</label>  
								  <div class="col-md-6">
									<input id="guid/email" name="guid/email" placeholder="" class="form-control input-md" type="text">
									 
								  </div>
								</div>
								
								
								<!-- Password input-->
								<div class="form-group">
								  <label class="col-md-4 control-label" for="password">Password</label>
								  <div class="col-md-6">
									 <input id="password" name="password" placeholder="" class="form-control input-md" required type="password">
									 
								  </div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label" for="purpose">Purpose</label>
									<div class="col-md-6">
										<select id="purpose" name="purpose" class="form-control">
											<option value="1">General</option>
											<option value="2">Advisor</option>
											<option value="3">Studies</option>
										</select>
								  </div>
								</div>

								
								<!-- Textarea -->
								<div class="form-group">
								  <label class="col-md-4 control-label" for="note">Note</label>
								  <div class="col-md-6">                     
									 <textarea class="form-control" id="note" name="note"></textarea>
								  </div>
								</div>

								<!-- Button -->
								<div class="form-group">
								  <label class="col-md-4 control-label" for="submit"></label>
								  <div class="col-md-6">
									 <button id="submit" name="submit" class="btn btn-default" type="submit">Submit</button>
								  </div>
								</div>

							</form>

						</div>
						<div class="response"></div>
					</div>
					<div class="col-md-3">
						<?php
						require "../calendar.php";
						?>

					</div>

				</div>
			</div>
		</div>
		
		<script>
			//Firefox retains the state of forms after page refresh, including radio buttons. Without form reset, if the existing user radio button is checked and the page is refreshed, the form after refresh will show the fields for new user (with "existing user" still checked). Form refresh fixes this.
			document.form.reset();
			//move the buttons into the table header, looks neater
			$("#prev").detach().appendTo("#prevbtn");
			$("#next").detach().appendTo("#nextbtn");
			$("div#form").hide();
			
			$("input[name='has_account']").change(function(){
				//show the appropriate fields for new and existing users
				$(".form-group:has(input[name='name']), .form-group:has(input[name='email']), .form-group:has(input[name='guid/email']), .form-group:has(input[name='guid'])").toggleClass("show");
				$(".form-group:has(input[name='name']), .form-group:has(input[name='email']), .form-group:has(input[name='guid/email']), .form-group:has(input[name='guid'])").toggleClass("hide");
				
				//toggle which fields are required
				//http://stackoverflow.com/questions/6617475/how-to-toggle-attribute-in-jquery
				$(".form-horizontal").find("input[name='name'], input[name='email'], input[name='guid/email']").prop("required", function(idx, oldProp){
					return !oldProp;
				});
			});

			$(function() {	//button event handlers
					$("#table_wrapper").on('click', "#prev", function() {
						$.ajax({
							type : "POST",
							url : "../calendar.php",
							dataType : "html",
							data : {
								date : $("#date_wrapper").find("#date").text(),
								button : "prev"
							},

							success : function(result) {//update table
								//move the buttons outside the table before it's contents get replaced
								$("#next").detach().prependTo("#table_wrapper");
								$("#prev").detach().prependTo("#table_wrapper");
								
								$("#table").html(result);
								
								$(".calendar").on('click','.data',function(){	//on click toggle background of selected day
									$(".clicked").toggleClass("clicked");		//restore default background
									$(this).toggleClass("clicked");		//paint selected day's background
									$("div#form").hide();
									$.ajax({
										type: "POST",
										url: "../timeslots.php",
										dataType: "html",
										data: {
											day: $(this).text(),
											date: $("#date_wrapper").find("#date").text()
										},
										success: function(result){
											$("#timeslots").html(result);
										}
									});
								});

								//moves buttons back into the table header
								$("#prev").detach().appendTo("#prevbtn");
								$("#next").detach().appendTo("#nextbtn");

							}

					});
				});

					$("#table_wrapper").on('click', "#next", function() {
						$.ajax({
							type : "POST",
							url : '../calendar.php',
							dataType : "html",
							data : {
								date : $("#date_wrapper").find("#date").text(),
								button : "next"
							},

							success : function(result) {//update table
								//move the buttons outside the table before it's contents get replaced
								$("#next").detach().prependTo("#table_wrapper");
								$("#prev").detach().prependTo("#table_wrapper");
								
								$("#table").html(result);
								
								$(".table").on('click','.data',function(){	//on click toggle background of selected day
									$(".clicked").toggleClass("clicked");		//restore default background
									$(this).toggleClass("clicked");		//paint selected day's background
									$("div#form").hide();
									$.ajax({
										type: "POST",
										url: "../timeslots.php",
										dataType: "html",
										data: {
											day: $(this).text(),
											date: $("#date_wrapper").find("#date").text()
										},
										success: function(result){
											$("#timeslots").html(result);
										}
									});
									
									//ajax call with the selected day
								});
								
								//moves buttons back into the table header
								$("#prev").detach().appendTo("#prevbtn");
								$("#next").detach().appendTo("#nextbtn");
								
		
								
							}
							
						});
					});
			});

			$("#timeslots").on('click','.timeslots',function(){
				$("#timeslots").find(".clicked").toggleClass("clicked");
				$(this).toggleClass("clicked");
				$("div#form").show();
			});
			
			$(".calendar").on('click','.data',function(){	//on click toggle background of selected day
				$("#table").find(".clicked").toggleClass("clicked");		//restore default background
				$(this).toggleClass("clicked");		//paint selected day's background
				$("div#form").hide();
				$.ajax({
					type: "POST",
					url: "../timeslots.php",
					dataType: "html",
					data: {
						day: $(this).text(),
						date: $("#date_wrapper").find("#date").text()
					},
					success: function(result){
						$("#timeslots").html(result);
					}
				});
				
				
				

			});
			
			
			$("#today").on('onLoad',function(){
				$(this).toggleClass("clicked");		//paint selected day's background
				$("div#form").hide();
				$.ajax({
					type: "POST",
					url: "../timeslots.php",
					dataType: "html",
					data: {
						day: $(this).text(),
						date: $("#date_wrapper").find("#date").text()
					},
					success: function(result){
						$("#timeslots").html(result);
					}
				});
			});
			
			$("#today").trigger("onLoad"); //when the page ends loading today's day is selected automatically
			
			$( "form" ).on( "submit", function( event ) {
				event.preventDefault();
				console.log( $( this ).serialize() );
				var d = $(this).serialize();
				
				
				$.ajax({
					type: "post",
					url: "processform.php",
					dataType: "html",
					data: d + "&id=" + $("#timeslots").find(".clicked").find(".id").text(),
					success: function(result){
						$("div.response").html(result);
					}
				});
				
			});
			
			
		</script>

	</body>

</html>
