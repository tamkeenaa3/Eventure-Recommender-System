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

<style> 
.th{
    text-align:center;
}
</style>
</head>
<body>

<div class="row" >
<div class="col s10" style=" text-align:center; padding:50px; margin-top:10px;">
<h2 style='color:crimson'> Customer Requests </h2>
<?php
echo "<h5 style='color:black'>  Date: " . date("Y-m-d") . "</h5>";
?>
</div>


</div>

<div class="row" style="margin:20px; ">


<div class="col s4" style="border:1px solid grey; margin:5px;">
<?php
include("db.php");

$id = $_SESSION['adminID'];
$admin_hall = $_SESSION["adminhallID"];
$st = $conn->query("Select * from hall_details where hallID = $admin_hall");
if ($st->num_rows>0){
    $data = $st->fetch_assoc();
    $hallName = $data["hallName"];
    $hallName = ucwords(strtolower($hallName));
echo "<center><h4> Banquet: ".$hallName."</h4><br></center>";
}
 $abc = $conn->query("Select * from requestdata where hallID = $admin_hall && status = 0");

echo '

<div class= "table-responsive" style = "background-color:light-blue; margin:20px;"> 
<table class= "table " id="mytable"> 
<tr> 
<th> Request ID</th>
<th> User ID </th>
<th> Visit Date </th>
<th> P1 </th>
<th> P2</th>
<th> P3</th>
<th> Approved Date   </th>
<th></th>
</tr>';
if ($abc->num_rows>0){
 while ($res = $abc-> fetch_assoc()){
   $reqid =  $res["reqID"];
  $userID = $res["userID"];
echo '<tr class="trhideclass">
<form method="GET" action = "#">
<td  id = "reqID">'.$reqid.'</td>
<td  id = "userID">'.$userID.'</td>
<td  id = "visitDate"> '.$res["visitDate"]. '</td> 
<td  id = "images"> '.$res["eventDate1"]. '</td> 
<td  id = "images"> '.$res["eventDate2"]. '</td> 
<td  id = "images"> '.$res["eventDate3"]. '</td> 
<td  id = "images">
 <a href ="adminRequests.php?ap_id='.$reqid.'" class="btn btn-primary" name="approve" type="submit"> Approve </a> <br>
 <a href ="adminRequests.php?de_id='.$reqid.'" class="btn btn-default" name="decline" type="submit" > Ignore </a></td> 
 </form></tr>';
 
}
 
 
 if (isset($_GET['ap_id']) ? $_GET['ap_id'] : ''){
 
    $ap_id =  isset($_GET['ap_id']) ? $_GET['ap_id'] : '';
    $sql1 = $conn->prepare("UPDATE requestdata SET status = 1 WHERE reqID = ?");
    $sql1->bind_param("s", $ap_id);
    $sql1->execute();
   
    echo "<label style='color:green;'> Approved Req# " .$ap_id. "</label>" ;
  
 }
if (isset($_GET['de_id']) ? $_GET['de_id'] : ''){

    $de_id =  isset($_GET['de_id']) ? $_GET['de_id'] : '';
    $sql2 = $conn->prepare("UPDATE requestdata SET status = 2 where reqID = ?");
    $sql2->bind_param("s", $de_id);
    $sql2->execute();
    echo "<label style='color:red;'>declined Req# " .$de_id."</label>" ;
}
}
else {
    echo '<tr>
	<td colspan = "4"> Data not found. </td>
	 </tr>';
}
echo'</table>
</div>';

?>


</div>

<div class="col s4"style="border:1px solid grey; margin:5px;" >
<center><h4>Status</h4></center>

<?php 
$i = 1;
$sql3 = $conn->prepare("SELECT * from requestdata where status = ?");
$sql3->bind_param("s",$i );
$sql3->execute();

$result = $sql3->get_result();
    while ($data = $result->fetch_assoc()){
    $reqID = $data["reqID"];
   $userID = $data["userID"];
   $visit= $data["visitDate"];
  
   $event1 = $data["eventDate1"];
   $event2 = $data["eventDate2"];
   $event3 = $data["eventDate3"];
   echo "<div class='alert alert-success'>";
   echo "Request ID # [".$reqID."] User ID # " .$userID. " for Event Date is approved.";
   echo "</div><br>";
    }
?>

<?php
$x = 2;
$sql4 = $conn->prepare("SELECT * from requestdata where status = ?");
$sql4->bind_param("s",$x );
$sql4->execute();

$result = $sql4->get_result();
    while ($data = $result->fetch_assoc()){
    $reqID = $data["reqID"];
   $userID = $data["userID"];
   $visit= $data["visitDate"];
  
   $event1 = $data["eventDate1"];
   $event2 = $data["eventDate2"];
   $event3 = $data["eventDate3"];
   echo "<div class='alert alert-info'>";
   echo "Request ID # [".$reqID."] User ID # " .$userID. " for Event Date is declined.";
   echo "</div><br>";
    }
?>
<?php
$x = 0;
$sql5 = $conn->prepare("SELECT * from requestdata where status = ?");
$sql5->bind_param("s",$x );
$sql5->execute();

$result = $sql5->get_result();
    while ($data = $result->fetch_assoc()){
    $reqID = $data["reqID"];
   $userID = $data["userID"];
   $visit= $data["visitDate"];
   $event1 = $data["eventDate1"];
   $event2 = $data["eventDate2"];
   $event3 = $data["eventDate3"];
   echo "<div class='alert alert-warning'>";
   echo "Request ID # [".$reqID."] User ID # " .$userID. " for Event Date is pending.";
   echo "</div><br>";
    }
?>
<br>
</div>
</div>




</div>
	

<script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->       
    <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
    <script src="js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
    <script src="slick/slick.min.js"></script>                  <!-- https://kenwheeler.github.io/slick/ -->
	<script src="js/jquery.scrollTo.min.js"></script>   
	<script type="text/javascript" src="js/materialize.min.js"></script>    

    <script>


$(document).ready(function(){

// updating the view with notifications using ajax

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
</body>
</html>