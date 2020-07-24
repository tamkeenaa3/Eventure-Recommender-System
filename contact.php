<?php
   require "db.php";
   session_start();

  if (isset($_POST["submit-btn"])){
  
     $stmt = $conn->prepare("INSERT INTO user_contactform ( manager_email, subject, message) VALUES (?, ?, ?)");
     $stmt->bind_param("sss", $_POST["to"], $_POST["subject"] , $_POST["mesg"]);
  $stmt->execute();
    
     $conn->commit();
     $result = $stmt->get_result();


  }

   ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Contact Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="font/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/contact-style1.css">
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">
				<form action="#" method = "POST" >
					<h3>Contact Us</h3>
					<p>Let us know your further queries.</p>

					<label class="form-group">

						<input type="email" name="to" class="form-control" required="required" autocomplete="off">
						<span>To</span>
						<span class="border"></span>
					</label>
					<label class="form-group">
						<input type="text" name="subject" class="form-control" maxlength="25" required="required" autocomplete="off">
						<span for="">Subject</span>
						<span class="border"></span>
					</label>
					<label class="form-group" >
						<textarea name="mesg" class="form-control" maxlength="100" required autocomplete="off"></textarea>
						<span for="">Your Message</span>
						<span class="border"></span>
					</label>
					<button name= "submit-btn" type="submit" onclick="myFunction()">Submit 
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
				
				<button onclick="window.location.href = 'http://localhost:8080/userProfile.php';"> Back </button>
		
			</div>
		</div>
<script>
function myFunction() {
  alert("Successfully submitted.");
}

</script>
	</body>
</html>