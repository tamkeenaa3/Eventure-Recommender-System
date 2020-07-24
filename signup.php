<?php
   include "db.php";
   session_start();
   ini_set("display_errors", 1);
   ini_set("track_errors", 1);
   ini_set("html_errors", 1);
   error_reporting(E_ALL);

  if (isset($_POST["submit"])){
	   $role = $_POST["role"]; 
	   $password = $_POST['password'];
	   $password = password_hash($password, PASSWORD_BCRYPT);
	   $password = $conn->real_escape_string($password);
	   $username =  $_POST["username"];
	   $username = $conn->real_escape_string($username);
		$phone= $_POST["phone"];
		$phone = $conn->real_escape_string($phone);
		$email = $_POST["email"];
		$email =$conn->real_escape_string($email);
		 
     //$sql= "INSERT INTO 'users' ('userID','username', 'password', 'phone', 'email', 'reg_date', 'role') VALUES ('', $username, $password, $phone, $email, '', $role)";
	 $stmt =  $conn->prepare("INSERT INTO USERS (username, password, phone, email, role) VALUES ( ?, ?, ?, ?, ?)")
	 or trigger_error($conn->error, E_USER_ERROR);
	 if($stmt !== FALSE) {
	 $stmt->bind_param("sssss",  $username, $password, $phone, $email, $role) or trigger_error($stmt->error, E_USER_ERROR);
	 
     $stmt->execute();

	 $result = $stmt->get_result();
	 if($result->affected_rows !== 0) {
		if (strcmp($role, "User") == 0){
			header("location:userProfile2.php");
			$_SESSION["username"] = $_POST["username"];
			$_SESSION["email"] = $_POST["email"];
			$_SESSION["userID"] = $row['userID'];
		}
	
		else {
			echo "Account doesn't exist.";
		}

		$_SESSION['mesg']= "You have registered your account successfully";
		unset($_SESSION['mesg']);
	}}}
	else{
		echo "";
	}
	
 

   ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sign Up</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="FYP/Signup/fonts/linearicons/style.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="FYP/Signup/css/style.css">
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">
				<img src="images/image-1.png" alt="" class="image-1">
				<form class="form validate-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" autocomplete="off">
					<h3>New Account?</h3>
					<div class="form-holder">
						<span class="lnr lnr-user"></span>
						<input type="text" data-validate="Enter username" class="form-control" placeholder="Username" name ="username" required="required">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-phone-handset"></span>
						<input type="tel" data-validate="Enter phone number" class="form-control" name ="phone" placeholder="Phone Number (like: 3xx-xxxxxxx)" required="required" 
						pattern="3[0-9]{2}(?!1234567)(?!1111111)(?!7654321)[0-9]{7}"  maxlength="10">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="email" class="form-control" data-validate="Enter email like john@mail.com" name ="email" placeholder="Email" required="required">
					</div>
                       <br>
				


					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						
			<input type="password" class="form-control" id="password" name = "password"  placeholder="Password" required="required">
			
					</div>
					
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" id="cpassword" name = "confirm_password" placeholder="Confirm Password" required="required" >
					</div>
					
			<input type="checkbox" onclick="myFunction()"><small>Show both passwords</small>

<br><br><br>
			<center>		<a href = "https://localhost:8080/Login.php" style = "color:blue;"> Already have an account? Login.</a> </center>
					<button type = "submit" name = "submit" >
						<span>Register</span>
					</button>

					<div class="text-center p-t-3"style = "margin-top:35px; text-align:center; " >
						<a href = "https://localhost:8080/FYP/IndexPage/index.php">
							Take me back to Homepage.
						</a>

					</div>
				</form>


				<img src="images/image-2.png" alt="" class="image-2">

			</div>
			
		</div>
		
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/main.js">
			 function validatePassword() {
        var validator = $("#Form").validate({
            rules: {
                password: "required",
                confirmpassword: {
                    equalTo: "#password"
                }
            },
            messages: {
                password: " Enter Password",
                confirmpassword: " Enter Confirm Password Same as Password"
            }
        });
        if (validator.form()) {
            alert('Success');
        }
    }

	
		</script>

<script>
function myFunction() {
  var x = document.getElementById("password");
  
  var y= document.getElementById("cpassword");
  if (x.type === "password") {
    x.type = "text";

  } else {
    x.type = "password";
  }
  if (y.type === "password") {
    y.type = "text";

  } else {
    y.type = "password";
  }
}</script>
	</body>
</html>