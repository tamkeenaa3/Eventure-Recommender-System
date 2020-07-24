<?php 
 include "db.php";
 session_start();
 if (isset($_SESSION["userID"]) && isset($_SESSION["username"])){
$userID = $_SESSION["userID"];
$username = $_SESSION["username"];}
 require "top-nav.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Banquet Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"> 

    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.7.0/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>                   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.checked{
  color:orange;
}
.input-field label {
     color: #000;
   }
   /* label focus color */
   .input-field input[type=text]:focus + label {
     color: #000;
   }
   /* label underline focus color */
   .input-field input[type=text]:focus {
     border-bottom: 1px solid #000;
     box-shadow: 0 1px 0 0 #000;
   }
   /* valid color */
   .input-field input[type=text].valid {
     border-bottom: 1px solid #000;
     box-shadow: 0 1px 0 0 #000;
   }
   /* invalid color */
   .input-field input[type=text].invalid {
     border-bottom: 1px solid #000;
     box-shadow: 0 1px 0 0 #000;
   }
   /* icon prefix focus color */
   .input-field .prefix.active {
     color: #000;
   }
  </style>

</head>
<body style="background:white;">
<div class="col s10" style="background-color:#f5f5f5; text-align:center; padding:60px; margin-top:10px;">
<h2> Banquet Details </h2>
</div>
 <!-- Slideshow container -->
<div class="slideshow-container" style="padding-left:150px; ">
<br>
<?php 
include "db.php";
require "date.php";

if (isset($_SESSION["userID"]) && isset($_SESSION["username"])){
$userID = $_SESSION["userID"];
$username = $_SESSION["username"];}
$ID = $_GET["value"];
$ID = urldecode($ID);
$ID = $conn->real_escape_string($ID);
$_SESSION["hallID"] = $ID;
$sql = $conn->prepare("SELECT * from images where hallID = ?");
$sql->bind_param("s", $ID);
$sql->execute();
$row= $sql->get_result();
  while ($res = $row -> fetch_assoc()){
    $image = $res["image"];
echo "<div class='mySlides '>
  <img src=".$image." style='width:70%; height:60%; margin-left:80px;'>
</div>
";} 
?>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
<span class="dot" onclick="currentSlide(1)"></span>
<span class="dot" onclick="currentSlide(2)"></span>
<span class="dot" onclick="currentSlide(3)"></span>
</div>
<br><br>
<?php
 include "db.php";
$sqla = $conn->prepare("Select * from hall_details where hallID = ?");
$sqla->bind_param("s", $ID);
$sqla->execute();

$rowa= $sqla->get_result();
  while ($resa = $rowa -> fetch_assoc()){
    $name = $resa["hallName"];
    $location = $resa["location"];
    $guests = $resa["numOfGuests"];
    $budget = $resa["budget"];
    $themes = $resa["themes"];
    $type = $resa["typeOfEvent"];
  }

 ?>
<div class="container">
<?php echo "<h2 style='color:crimson;'> ".$name."</h2><br>";?>

<div class="container" style="margin-bottom:20px;  ">
<a href = "#" >Ratings and Comments</a>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span>
</div>

<a href=""></a>
</div>


<?php echo "<div class='container' >
<h4 style='margin-left:8px; '> <strong> Rs. ".$budget."</strong>
<small>(Down Payment) </small></h4>
</div>";?>

<div class="jumbotron" style="background-color:white; ">

  <style>
  label{
  color:blue;
  }
  h5, body{
    font-size:15px;
    color:black;
    font-weight:100;
  }


</style>
<div class="container" style="border:#f9fbe7; margin-top:10px; border:2px solid grey; margin-bottom:10px;">
<h4><strong>Description<strong></h4><br>

<h5>This Banquet is located at <?php echo $location; ?> </h5> <br>
<h5> Capacity for Guests: </h5> <?php echo $guests; ?> <br><br>
<h5> Type of Events: </h5> Engagement, Mehendi, Wedding, Reception, Birthday, Farewell <br><br>
<form method="POST" action="#">
<h5> Select 3 dates for event: </h5>

  <label> Priority 1 : </label>
  <input type="date"  name="reserve-date1"> <br>
  <label> Priority 2 : </label>
  <input type="date"  name="reserve-date2"> <br>
  <label> Priority 3 : </label>
  <input type="date"  name="reserve-date3"> <br>

  <br><br>
<h5> Set up a visiting on date: </h5> 
  <input type="date"  name="visit"><br>
<div class="wrap" style="margin-bottom:10px; margin-top:10px; margin-left:60px; margin-right:60px;">
<button name="request" class="btn btn-default form-control" style="height:50px;"> Request </button>
</div>
</form>
<div class="wrap" style="margin-bottom:10px;margin-left:60px; margin-right:60px;">
<a href = "paymentnew.php?value=<?php $hallID = $_GET["value"]; echo $hallID; ?>" class="btn btn-success form-control" style="height:50px;""> Book </a>
</div>
<?php 
include "db.php";

if (isset($_POST["request"])){
$visit = $_POST["visit"];
$event1 = $_POST["reserve-date1"];
$event2 = $_POST["reserve-date2"];
$event3 = $_POST["reserve-date3"];
$hall = $_SESSION["hallID"];

$sqly = $conn->prepare("INSERT INTO requestdata (userID, hallID, hallName, visitDate, eventDate1, eventDate2, eventDate3)  VALUES (?,?,?,?,?,?,?)");
$sqly->bind_param("sssssss", $userID, $hall,$name, $visit, $event1, $event2, $event3);
if ($sqly->execute()){
echo "<br><div class='alert alert-success '> Request Sent to the Banquet Manager! <button type='button' class='close' data-dismiss='alert'>&times;</button>
</div>";
}else{
  echo "<br><div class='alert alert-danger '> Oops! Request couldn't be sent to the Banquet Manager! <button type='button' class='close' data-dismiss='alert'>&times;</button>
	</div>";
}

}
?>
</div>
<div class="container" >

<div class="container" style="float:center;">
        <div class="comment-wrapper">
            <div class="panel panel-success">
                <div class="panel-heading" style="color:black;">
                  <center> <h4><strong> Comment Section </strong></h4> </center>
            
                </div>
                <div class="panel-body" style=" height: 410px;overflow: scroll; padding:10px;">
                
                <form method="post">
                    <textarea class="form-control" placeholder="write a comment..." rows="3" name="comment"></textarea>
                    <br>
                    <button type="submit" class="btn btn-primary pull-right" style="padding:10px;" name = "post">Post Comment</button>
                    </form>
                    <?php 
                
                    if (isset($_POST["post"])){
                      $comment = $_POST["comment"];
                      $hallID = $ID;
                      $timestamp = date("Y-m-d H:i:s");
                       $query1 = $conn->prepare("INSERT INTO comments(userID, hallID, comment, username, `timestamp`) VALUES(?,?,?,?,?)");
                       $query1->bind_param("sssss", $userID, $hallID, $comment, $username, $timestamp);
                       $query3 = $conn->prepare("select * from user_img where userID = ?");
                       $query3->bind_param("s", $userID);
                       $query3->execute();
                       $res3 = $query3->get_result();
                       if ($res3->num_rows>0){
                       while ($data= $res3->fetch_assoc()){
                         $img = $data["image"];
                       }
                      }else {
                        echo "";
                      }
                       if ( $query1->execute()){
                         
                       $query2 = $conn->prepare("SELECT * from comments where userID = ? && hallID = ?");
                       $query2->bind_param("ss", $userID, $hallID);
                       $query2->execute();
                      
                       $result=$query2->get_result();
                       if ($result->num_rows>0){
                       while($row=$result->fetch_assoc()){
                         $comment = $row["comment"];
                         $author = $row["username"];
                         $mydate = $row["timestamp"];
                        
                       }
                       
                      
                  echo "
                    <div class='clearfix'></div>
                    <hr>
                    <ul class='media-list'>
                        <li class='media'>
                            <a href='#' class='pull-left'>
                                <img src='".$img."' alt='' class='img-circle'>
                            </a>
                            <div class='media-body'style='padding:5px;'>
                                <span class='text-muted pull-right'>
                                    <small class='text-muted'>".dateDiff($mydate)." ago</small>
                                </span>
                                <strong class='text-default'>". ucwords($author)."</strong>
                                <h5>".$comment."</h5>
                            </div>";
                          }
                        }}
                     ?> 
 

 <?php 

 $userID = $_SESSION["userID"];
 $ID = $_GET["value"];
$ID = $conn->real_escape_string($ID);
$hallID = $ID;
if (isset($_SESSION["userID"])){
  $query2 = $conn->prepare("SELECT * from comments where hallID = ?");
  $query2->bind_param("s", $hallID);
  $query2->execute();
   
  $result=$query2->get_result();
  if ($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    $comment = $row["comment"];
    $author = $row["username"];
    $mydate = $row["timestamp"];
     $userID = $row["userID"];
     $cid = $row["cID"];
    $query3 = $conn->prepare("select * from user_img where userID = ?");
    $query3->bind_param("s", $row["userID"]);
     $query3->execute();
     $res3 = $query3->get_result();
       if ($res3->num_rows>0){
      while ($data= $res3->fetch_assoc()){
     $img = $data["image"];
     }
                      }else {
                        echo "";
                      }
  

echo "
<div class='clearfix'></div>
<hr>
<ul class='media-list'>
   <li class='media'>
       <a href='#' class='pull-left'>
           <img src='".$img."' alt='' class='img-circle'>
       </a>
       <div class='media-body'style='padding:5px;'>
           <span class='text-muted pull-right'>
               <small class='text-muted'>".dateDiff($mydate)." ago</small>
               
           </span>
           
          
           <strong class='text-default'>". ucwords($author)."</strong>
           <h5>".$comment."</h5>

       </div>";

       

     }
    }
}else{
  echo "";
}

 ?>

                        </li>

                       
                       <style>
    .comment-wrapper .panel-body {
    max-height:650px;
    overflow:auto;
}

.comment-wrapper .media-list .media img {
    width:64px;
    height:64px;
    border:2px solid #e5e7e8;
    border-radius: 40px;
}

.comment-wrapper .media-list .media {
    border-bottom:1px dashed #efefef;
    margin-bottom:25px;
}
                                    </style>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    	

</div>
</div>
</div>
</div>
</div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/ratekit.min.js"></script>
 <!--JavaScript at end of body for optimized loading-->
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script>

      
 //Or with jQuery

  $(document).ready(function(){
    $('.datepicker').datepicker({
        minDate: 0,
       maxDate: new Date('2030-05-26'),
       autoClose:true,
       disableWeekends:true,
       format: "yyyy-mm-dd"
    
    });
   
  });
 var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
$(".my-rating-4").starRating({
  totalStars: 5,
  starShape: 'rounded',
  starSize: 40,
  emptyColor: 'lightgray',
  hoverColor: 'salmon',
  activeColor: 'crimson',
  useGradient: false
});

</script>
</body>
  
</html>