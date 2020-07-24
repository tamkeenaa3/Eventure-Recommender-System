<?php
include "db.php";
session_start();

if (isset($_POST["submit"])){
	$email = $_POST["email"];
	$password = $_POST["password"];
    //$password = password_hash($password, PASSWORD_BCRYPT);
	$role = $_POST["role"];
	 $stmt = $conn->prepare("SELECT * from users where email = ? AND role = ? ");
	 $stmt->bind_param("ss", $email,  $role);
     $stmt->execute();

     $result = $stmt->get_result();

     if ($result->num_rows > 0){
		 $row = $result -> fetch_assoc();
		  
		  $dbpass = $row['password'];
		
		  if ($_POST['role'] == 'User'){
			  if (password_verify($password, $dbpass)){
				$_SESSION['email'] = $email;
				$_SESSION["userID"] = $row['userID'];
				$_SESSION["username"] = $row['username'];
		       header("location:userProfile2.php");
		 
		    }}else {
				echo "<div class='alert alert-warning alert-dismissible fade show'style='width:1300px; height:60px; margin-left:100px;'>
		<strong>Warning!</strong> Please enter valid email or password.
		<button type='button' class='close' data-dismiss='alert'>&times;</button>
	</div>";
			}
		 if ($_POST['role'] == 'Manager'){

			if(password_verify($password, $dbpass)){
				$_SESSION['adminemail'] = $email;
				$_SESSION["adminID"] = $row['userID'];
			header("location:adminProfile.php?hallID='$hallID'"); 
		
		 }}
		
	 }else{
		echo "<div class='alert alert-warning alert-dismissible fade show'style='width:1300px; height:60px; margin-left:100px;'>
		<strong>Warning!</strong> Please enter valid email or password.
		<button type='button' class='close' data-dismiss='alert'>&times;</button>
	</div>";
	 }
	}
else {
	
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
<!--===============================================================================================--
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!--===============================================================================================-->
</head>
<body>


	<div class="limiter">


		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" autocomplete="off" action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">
					<span class="login100-form-title p-b-26">
						Login 
					</span>
					<span class="login100-form-title p-b-48">
						<img src = "images/favicon.png" style="width: 40px; height:40px; ">
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100 required" type="email" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

				

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100 required" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
  <div class = "form-group">
   <label> Select your role </label>
   <select class="form-control" name = "role"> 
   	<option name = "User"> User </option>
   	<option name = "Manager"> Manager </option>
   </select>
</div>

					<div class="text-center p-t-1" style="margin-bottom:50px;">
						
						<a href = "https://localhost:8080/signup.php" style ="color:green;">
							Don’t have an account? Register now.
						</a>

					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type= 'submit' name = 'submit' >
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
