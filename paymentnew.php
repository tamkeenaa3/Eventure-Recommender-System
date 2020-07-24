<?php 
  include "db.php";
  session_start();
  if (isset($_SESSION["userID"])){
  $userID = $_SESSION["userID"];}
  if (isset($_SESSION["username"])){
  $username = $_SESSION["username"];}
  $hallID = $conn->real_escape_string($_GET["value"]);
  require "top-nav.php"; 
require 'pdfcrowd.php';


  
$sqla = $conn->prepare("Select * from hall_details where hallID = ?");
$sqla->bind_param("s", $hallID);
$sqla->execute();

$rowa= $sqla->get_result();
  while ($resa = $rowa -> fetch_assoc()){
    $budget = $resa["budget"];
    $hallname = $resa["hallName"];
  }
   
  if(isset($_SESSION["userID"])){
    
    if (isset($_POST["cc-submit"])){
        $fname = $_POST["ccfname"];
        $ccn = $_POST["ccn"];
        $ccmm = $_POST["ccmm"];
        $ccyy =  $_POST["ccyy"];
        $cc_cvv = $_POST["cc-cvv"];
       
        $method = "Credit Card";
        $i=0;
        $date = $_POST["date"];
        $query=$conn->prepare("INSERT INTO payment_details(`userID`, `username`, `hallID`,`hallname`, `accountNo`, `password`, `tokenPrice`, `method`, `completePayment`, `event_dt`)
        VALUES (?,?,?,?,?,?,?,?,?,?)");
        $query->bind_param("ssssssssss", $userID, $username, $hallID, $hallname, $ccn, $i, $budget, $method,$i, $date );
        if ($query->execute()){
          echo "<div class='container alert alert-info' role='alert'>
          Dear Customer, <br> Amount Pkr. ".$budget." has been deducted from your account for this transaction.
          
          </div>";

          echo "<div class='container alert alert-success' role='alert'>
          <strong>Booking Successful!</strong>
          Your booking for this hall on date ".$date." has been confirmed. 
         
        
          </div>";
        }
    }
    if (isset($_POST["dc-submit"])){
        $fname = $_POST["dcfname"];
        $dcn = $_POST["dcn"];
        $dcmm = $_POST["dcmm"];
        $dcyy =  $_POST["dcyy"];
        $dc_cvv = $_POST["dc-cvv"];
        $method = "Debit Card";
        $i=0;
        $date = $_POST["date"];
        $query=$conn->prepare("INSERT INTO payment_details(`userID`, `username`, `hallID`,`hallname`, `accountNo`, `password`, `tokenPrice`, `method`, `completePayment`, `event_dt`)
        VALUES (?,?,?,?,?,?,?,?,?, ?)");
       
       $query->bind_param("ssssssssss", $userID, $username, $hallID,$hallname, $dcn, $i, $budget, $method,$i, $date );
       if ($query->execute()){
        echo "<div class='container alert alert-info' role='alert'>
        Dear Customer, <br> Amount Pkr. ".$budget." has been deducted from your account for this transaction.
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
	
        </div>";

        echo "<div class='container alert alert-success' role='alert'>
        <strong>Booking Successful!</strong>
        Your booking for this hall on date ".$date." has been confirmed. 
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
	
        </div>";
      

      }
    }
    if (isset($_POST["ep-submit"])){
      $method = "Easy Paisa";
      $i=0;
      $date = $_POST["date"];
         $ep_phone = $_POST["ep-phone"];
         $ep_amount = $_POST["ep-amount"];
         $ep_amount = $conn->real_escape_string();
         $query=$conn->prepare("INSERT INTO payment_details(`userID`, `username`, `hallID`,`hallname`, `accountNo`, `password`, `tokenPrice`, `method`, `completePayment`, `event_dt`)
        VALUES (?,?,?,?,?,?,?,?,?, ?)");
       
        $query->bind_param("ssssssssss", $userID, $username, $hallID,$hallname, $ep-phone, $i, $amount, $method,$i, $date );
        if ($query->execute()){
          echo "<div class='container alert alert-info' role='alert'>
          Dear Customer, <br> Amount Pkr. ".$ep_amount." has been sent.
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
	
          </div>";

          echo "<div class=' container alert alert-success' role='alert'>
          <strong>Booking Successful!</strong>
          Your booking for this hall on date ".$date." has been confirmed. 
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
	
          </div>";
        }
    }

  }else{
      echo "<div class='alert alert-warning' role='alert'>
      <strong>Warning!</strong> Kindly login to access this page.
      </div>";
  }
  
  
  ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<style type="text/css">
		div.myDIV{
			display : none;
		}
	</style>
	<title>
		Payment form
    </title>
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
 
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="css/payform.css">
	
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body background="images/hall.jpg" onload="constructor();" >

  </center>
	<div id="hello" class="jumbotron text-center">
    <center><h2>Booking Payment</h2></center><br>
    <h4><strong>Select a payment method:</strong></h4>
		<center><button style="margin:30px; "type="button" class="btn  btn-primary button1 "
			onclick="myFunction()">ONLINE PAYMENT</button>
			<button style="margin:30px;" type="button" class="btn  btn-primary button1" onclick="alert('Waiting To Recieve Your Payment')">MANUAL PAYMENT</button>
		</center>
	<center><form id="apple">
    <label class="radio-inline" >
      <input class="tablink" type="radio" name="optradio" style="padding-right:20px;" onclick="openPayment(event, 'CREDIT CARD')"><b>CREDIT CARD</b>
    </label> &nbsp&nbsp&nbsp
    <label class="radio-inline" >
      <input class="tablink" type="radio" name="optradio" style="padding-right:20px;" onclick="openPayment(event, 'DEBIT CARD')"><b>DEBIT CARD</b>
    </label> &nbsp&nbsp&nbsp
    <label class="radio-inline" >
      <input class="tablink" type="radio" name="optradio" style="padding-right:20px;" onclick="openPayment(event, 'EASY PAISA')"><b>EASY PAISA</b>
    </label> </center>
  </form>
	</div>
	
   

<div id="CREDIT CARD" class="tabcontent card" style="background-color: white; margin-left:400px; margin-right:400px; padding:20px;"  >
  
 

 <center><b><h3>Enter Credit Card Information</b>
  </h3><br><br>
  <form class="w3-container" method="POST" id="myform-cc">
  <b>Select Event Date: </b><br>
 <input class="w3-input w3-border w3-animate-input" data-validate="Enter date for event" type="date" autocomplete="off" name="date" style="width:50%" required><br>

<b>Full name on Card: </b><br>
 <input class="w3-input w3-border w3-animate-input" data-validate="Enter card holder's name." name="ccfname" type="text" autocomplete="off" name="fname" style="width:50%" required><br>

 <b>Card Number: </b><br>
 <input placeholder="0000-0000-0000-0000" name ="ccn" data-validate="Enter Credit Card digits" class="w3-input w3-border w3-animate-input" autocomplete="off" type="text"  style="width:50%"  maxlength="19" required><br>
 
  <label for="quantity"><b>Expiration: </b></label><br>
  <input placeholder="MM" name="ccmm" type="number" id="quantity" name="quantity" min="1" max="12" required>
  <input placeholder="YY" name="ccyy" type="number" id="quantity" name="quantity" min="1980" max="2040" required><br>
<br>
 <b>CVV Number: </b><br>
 <input placeholder="xxx"name="cc-cvv" class="w3-input w3-border w3-animate-input" data-validate="Enter 3 digits on back of card" type="password" style="width:20%" required maxlength="4"><br>

  <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" class="form-control" required><label for="vehicle1"> By checking this box, I agree to the Terms & Conditions & Privacy Policy.</label>
<br>
<button type="submit" name="cc-submit" value="Submit" class="btn btn-success">Submit</button><br>
  </form>
    
  <script>
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
$( "#myform-cc" ).validate({
  rules: {
    field: {
      required: true,
      creditcard: true
    }
  }
});
</script>
    
</div>

<div id="DEBIT CARD" class="tabcontent" style="background-color: white; margin-left:400px; margin-right:400px; padding:20px;"  >
    <form  id="apple" method="POST" class="w3-container"  id="myform-cc">
  <center><b><h3>Enter Debit Card Information</b>
  </h3>
  <br><br>

  <b>Select Event Date: </b><br>
 <input class="w3-input w3-border w3-animate-input"  type="date" autocomplete="off" name="date" style="width:50%" required><br>

<b>Full name on Card: </b><br>
 <input class="w3-input w3-border w3-animate-input" data-validate="Enter card holder's name" name="dcfname" type="text" style="width:50%" autocomplete="off" required><br>

 <b>Card Number: </b><br>
 <input placeholder="0000-0000-0000-0000" name= "dcn"  data-validate="Enter debit card digits" class="w3-input w3-border w3-animate-input" autocomplete="off" type="text" style="width:50%" required maxlength="19"><br>
 
 
  <label for="quantity"><b>Expiration: </b></label><br>
  <input placeholder="MM" type="number" name= "dcmm" id="quantity" name="quantity" min="1" max="12" required>
  <input placeholder="YY" type="number" name= "dcyy" id="quantity" name="quantity" min="1980" max="2050" required><br>
<br>
 <b>CVV Number: </b><br>
 <input placeholder="xxx" name= "dc-cvv" class="w3-input w3-border w3-animate-input" data-validate="Enter 3 digits at the back of card" type="password" style="width:20%" required maxlength="4"><br>


  <br><br>
  <input type="checkbox"  id="vehicle1" name="vehicle1" value="Bike" required>
  <label for="vehicle1"> By checking this box, I agree to the Terms & Conditions & Privacy Policy.</label><br>


</center>
<button type="submit"name= "dc-submit" value="Submit" class="btn btn-success">Submit</button><br>
  </form>
    
</div>
<div id="EASY PAISA" class="tabcontent" style="background-color: white; margin-left:400px; margin-right:400px; padding:20px;"  >
<center><b><h3>Enter Easy Paisa Information</b>
  </h3>
  <br><br>

  
  <form method="POST" class="w3-container">
    
  <b>Select Event Date: </b><br>
 <input class="w3-input w3-border w3-animate-input" type="date" autocomplete="off" name="date" style="width:50%" required><br>

 <b>Enter mobile number account: </b><br>
 <input placeholder="Mobile number account"  data-validate="Enter phone number" name= "ep-phone" class="w3-input w3-border w3-animate-input" type="text" style="width:50%" required><br>

 <b>Enter Amount </b><br>
 <input placeholder="Amount.." data-validate="Enter amount." name= "ep-amount" class="w3-input w3-border w3-animate-input" type="number" id="amount" min=20 max=50000 step=50 name="amount" style="width:50%" required ><br>

</center>
    
 <button input type="submit" name= "ep-submit" value="Submit" class="btn btn-success">Submit</button><br>
  </form>
    
</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

function myFunction() {
  var x = document.getElementById("apple");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
  function constructor(){
     tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
   tabcontent[i].style.display = "none";
  }
 myFunction();
  }
</script>
<script>
function openPayment(evt, cityName) {
  var i, tabcontent, tablinks;
 tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
   tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}


</script>


	

</body>
</html>