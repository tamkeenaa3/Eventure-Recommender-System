<?php 
  include "db.php";
  session_start();
  $hallID = $_SESSION["adminhallID"];
  $adminID = $_SESSION["adminID"];
$adminname = $_SESSION["adminname"];
include "top-nav-adm.php";
  $i = 2;
$j = 2;

if (isset($_SESSION["adminID"])){

  if (isset($_POST["insert"])){
    $dt = "";
    $method = "On Visit";
    $q = $conn->prepare("insert into general(firstName,lastName,phone, payment, eventDate, token, caterer,guests,complete, hallID, datetime) VALUES(?,?,?,?,?,?,?,?,?,?, ?)");
    $q->bind_param("sssssssssss", $_POST["fname"], $_POST["lname"], $_POST["phone"], $method, $_POST["eventdt"], $_POST["token"], $_POST["caterer"], $_POST["guests"], $_POST["complete"],$hallID,$dt );
    $q->execute();
}

}else {
    echo "<div class='alert alert-danger' role='alert'>
    Couldn't insert data. Kindly login to access this page.
    </div>";
}

?>

<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
  <title>Admin Profile Settings</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

	<body>

<div class = "wrap" style="margin:10px;" >
<div class="jumbotron">
<h2><center>
Payment Details of Customers</center>
</h2>
</div>
<style>
.th{
    text-align:center;
    border: 1px solid black;
   width: 250px;
}

</style>
<div class="wrapper" >
<div class= "table-responsive overflow-auto table-striped"> 
<table class="table"> 

<tr> 
<th> First name</th>
<th> Last name</th>
<th> Phone </th>
<th> Caterer</th>
<th> Guests</th>
<th> Token Payment </th>
<th> Complete Payment</th>
<th> Event Date</th>
<th></th>
</tr>
<tr > 
<form method="POST">
<td>  <input type="text" class="form-control" name="fname"></td>
<td>  <input type="text" class="form-control" name="lname"></td>
<td>  <input type="phone" autocomplete="off" class="form-control" maxlength=10 name="phone" placeholder="exclude 0"></td>
<td>  
<div class="form-group " style="padding:3px;">
<select name="caterer" placeholder="Select.." class="form-control">
<option value="Private"> Private</option>
<option value="Default"> Default</option>
</select>
</div>
</td>
<td>  <input type="number" class="form-control" min= 100 max= 900 step=100 name="guests"></td>
<td>  <input type="number" class="form-control" step="5000" min= 25000 max= 60000 name="token"></td>
<td>  <input type="number" class="form-control" step= 10000 min=0 max="200000" name="complete"></td>
<td style="width:20;">  <input type="date" class="form-control" name="eventdt" id="eventdt"></td>

<td><button type = "submit" class="btn" name="insert" style="padding:10px;"> Insert </button></td>
</form>
</tr>

</div>
</div>
</body>

<script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->       
    <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
    <script src="js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
    <script src="slick/slick.min.js"></script>                  <!-- http://kenwheeler.github.io/slick/ -->
	<script src="js/jquery.scrollTo.min.js"></script>   
	<script type="text/javascript" src="js/materialize.min.js"></script>    

</html>