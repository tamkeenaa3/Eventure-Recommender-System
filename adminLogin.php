<?php
include "db.php";
session_start();

if (isset($_POST["submit"])){
	   $email = $_POST["email"];
       $password = $_POST["password"];
	 $stmt = $conn->prepare("SELECT * from admin where email = ? ");
	 $stmt->bind_param("s", $email);
     $stmt->execute();

     $result = $stmt->get_result();

     if ($result->num_rows > 0){
		 $row = $result -> fetch_assoc();
		   header("location:adminProfile.php");
		  $_SESSION['adminemail'] = $email;
		  $_SESSION["adminID"] = $row['adminID'];
		  $_SESSION["adminname"] = $row['name'];
		  $_SESSION["adminhallID"] = $row["hallID"]; 
		  $_SESSION["adminhallname"] = $row["hallname"];
		    
		}
		
	 }



?>

<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
</head>
<body>


	<div class="limiter">


		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form"  action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">
					<span class="login100-form-title p-b-26">
						Admin Login 
					</span>
					<span class="login100-form-title p-b-48">
						<img src = "images/favicon.png" style="width: 40px; height:40px; ">
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100 " type="text" name="email" autocomplete="off">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

				

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100 " type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
 
					<div class="text-center p-t-1" style="margin-bottom:50px;">
						
							<small>Contact product owner to get membership.</label></small>
					

					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type= 'submit' name = 'submit'>
								Login
							</button>
						</div>
					</div>

					


				</form>


					<div class="text-center p-t-50">
						<a href = "https://localhost:8080/FYP/IndexPage/index.php">
							Take me back to Homepage.
						</a>

   

				</div>
			</div>
  
    

		</div>


	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
