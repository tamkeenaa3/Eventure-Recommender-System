<?php 
session_start();
$adminID = $_SESSION["adminID"];
$adminname = $_SESSION["adminname"];
include "top-nav-adm.php";
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
  <div class="jumbotron">
 <h2> <center>Payments Recieved</center></h2>
  <br>
  <strong> Instructions: </strong> 
  <bold>1. Collect Payment </bold><br>
  <small>* if (Down payment is receieved, Reserve the slot (temporarily) until Full payment is recieved. )<br>
  * Incase of Clash, reserve another requested date. </small>
  <div class="row" style="float:right; margin-right:5px; margin-left:2px;">
  <form method="post">
  
  <button class="btn" style="background:DodgerBlue; margin-right:9px;" name="viewData">View data </button>
  
  </form>
  </div>
    </div>
    
  <style>
  .btn{
    background-color:DodgerBlue;
  }
  </style>
  
<?php 

if (!isset($_POST["viewData"]) && isset($_SESSION["adminID"])){
  
$adminID = $_SESSION["adminID"];
$hallID = $_SESSION["adminhallID"];
$i = 0;
$query1 = $conn->prepare("select invoiceID,	userID, username, tokenPrice, method,  completePayment, transactionDate,event_dt, approved
from payment_details where hallID = ?");
$query1->bind_param("s", $hallID);
$query1->execute();
$res1 = $query1->get_result();
echo "
<div class='data' style=' width: 1400px; height: 400px;overflow: scroll; padding-left:20px; margin:20px;'>
<div class= 'table-responsive overflow-auto style='padding:10px; align:center; '> 
<table class= 'table table-striped'> 

";

if ($res1->num_rows>0){
  echo "<tr > 
  <th> Invoice ID </th>
  <th> User ID </th>
  <th> Username</th>
  <th> Token Payment </th>
  <th> Complete Payment</th>
  <th> Event Date</th>
  <th> Date & Time </th>
  <th>Payment Method</th>
  
  <th></th>
  </tr>";
 while($row=$res1->fetch_assoc()){
 $invoice = $row["invoiceID"];
 $userID = $row["userID"];
 $username = $row["username"];
 $token = $row["tokenPrice"];
 $complete = $row["completePayment"];
 $date = $row["transactionDate"];
 $method = $row["method"];
 $event = $row["event_dt"];
 $approved = $row["approved"];
 if ($approved == 0){
 if ($complete==0){
    echo '<tr>
    <form method="GET" action = "#">
    <td>'.$invoice.'</td>
    <td> '.$userID .'</td>
    <td>'.$username.'</td>
    <td>'.$token.'</td>
    <td><span class="badge badge-warning">Pending</span></td>
    <td>'.$event.'</td>
    <td>'.date("d.m.Y H:i:s", strtotime($date)).'</td>
    <td style="background-color:azure;">'.$method.'</td>
    <td> <a href="adminPay.php?ap_id='.$invoice.'" name="ap_id" class="btn" style="background:DodgerBlue;"> Reserve the slot</a> </td>
  </tr>
       </form>
      ';
  }else{

    echo '<tr style="color:green;">
    <form method="GET" action = "#">
    <td>'.$invoice.'</td>
    <td> '.$userID .'</td>
    <td>'.$username.'</td>
    <td>'.$token.'</td>
    <td>'.$complete.'</td>
    <td>'.$event.'</td>
    <td>'.date("d.m.Y H:i:s", strtotime($date)).'</td>
    <td style="background-color:azure;">'.$method.'</td>
    <td> <a href="adminPay.php?ap_id='.$invoice.'" name="approve" class="btn">Approve</a> </td>
  </tr>
       </form>
      ';
 }
 }else { echo "<tr>
  <td colspan = '8'>No records found.</td>
  </tr>
  ";}

 if (isset($_GET['ap_id']) ? $_GET['ap_id'] : ''){
    $ap_id =  isset($_GET['ap_id']) ? $_GET['ap_id'] : '';
    $ap_id = $conn->real_escape_string($ap_id);
    $hallname = $_SESSION["adminhallname"];
    $sql1 = $conn->prepare("INSERT INTO hall_booking(user_id,hallID,hallName, username, requested_date, adminID) VALUES (?,?,?,?,?, ?)");
    $sql1->bind_param("ssssss", $userID, $hallID,$hallname, $username, $event,$adminID );
    $sql1->execute();
   }
}


}
  else{
  echo "<tr>
  <td colspan = '8'>No records found.</td>
  </tr>
  ";
    } 

}
else{
echo "<div class='alert alert-danger container' id='a1' role='alert' >
<strong> Warning! </strong> Kindly Login to your Admin Account to get access to this page.
<button type='button' id = 'b1' class='close' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button></div>";

}
?>
    </div>

   </table>
   </div>
   </div>
   <div class="jumbotron">
    <center> <h2>Confirmed Hall Bookings</h2> </center>
    </div>
   <div class="row" style=" width: 1400px; height: 400px;overflow: scroll; padding-left:20px; margin-top:5px; margin-left:50px; ">
   <?php 
   if (isset($_SESSION["adminID"])){
    $adminID = $_SESSION["adminID"];
    $hallID = $_SESSION["adminhallID"];
    $query1 = $conn->prepare("select * from hall_booking where $hallID = ?");
    $query1->bind_param("s", $hallID);
    $query1->execute();
    $res1 = $query1->get_result();
    echo "
    <div class= 'table-responsive overflow-auto' style='padding:10px; align:center; '> 
    <table class= 'table table-striped'> 
    <tr > 
    <th> Booking ID </th>
    <th> User ID </th>
    <th> Username </th>
    <th> Event Date </th>
    </tr>
    ";
   }
   if ($res1->num_rows>0){
    while($row=$res1->fetch_assoc()){
      echo '<tr>
      <form method="GET" action = "#">
      <td>'.$row["bk_id"].'</td>
      <td> '.$row["user_id"].'</td>
      <td>'.$row["username"].'</td>
      <td>'.$row["requested_date"].'</td>
    </tr>
         </form>
        ';
    }
    }

   ?>  
   <table>
   </div>
  </div>
  </body>

  <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->       
    <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
    <script src="js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
    <script src="slick/slick.min.js"></script>                  <!-- https://kenwheeler.github.io/slick/ -->
	<script src="js/jquery.scrollTo.min.js"></script>   
	<script type="text/javascript" src="js/materialize.min.js"></script>    

  <script>
 $(document).ready(function() {
    $("#b1").click(function(){
        $("#a1").hide();
    });

    $('#eventdt').datepicker({
    format: "dd/mm/yyyy",
    minDate: 0

  });


  function load_unseen_notification(view = '')

{

 $.ajax({

  url:"fetch.php",
  method:"POST",
  data:{view:view},
  dataType:"json",
  success:function(data)

  {

   $('.dropdown-menu').html(data.notification);

   if(data.unseen_notification > 0)
   {
    $('.count').html(data.unseen_notification);
   }

  }

 });

}

load_unseen_notification();


// load new notifications

$(document).on('click', '.dropdown-toggle', function(){

 $('.count').html('');

 load_unseen_notification('yes');

});

setInterval(function(){

 load_unseen_notification();;

}, 5000);



});


  </script>

  </html>