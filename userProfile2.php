
<?php 
include "db.php";
session_start();
if (isset($_SESSION['mesg'])){
      echo "<div class='alert alert-success' role='alert'>".$_SESSION['mesg']."</div>";
    } ?>
</div> 

<?php 

$userID = $_SESSION["userID"];
$sql1 = $conn->prepare("Select * from requestdata where userID = ?");
$sql1->bind_param("s", $userID);
$sql1->execute();
$result = $sql1->get_result();

while($row=$result->fetch_assoc()){
  $status = $row["status"];
  $eventdt =$row["approvedDate"];
  $meetdt =  $row["visitDate"];
  $hallID = $row["hallID"];

}


$sql2 = $conn->prepare("select hallName from hall_details where hallID = ?");
$sql2->bind_param("s", $hallID);
$sql2->execute();
$result = $sql2->get_result();
while($row=$result->fetch_assoc()){
  $hallName = $row["hallName"];

}

?>

<?php 
  if (isset($_SESSION['email'])){
$email = $_SESSION['email'];
$sql = "SELECT * FROM users where email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $current_username= $row["username"];
      $current_phone = $row["phone"];
      $current_role = $row["role"];
       $current_email = $row["email"];
        $userID = $row["userID"];
    
    }}
   }?>
<html>

<head>
  <title>User Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
  <link href="https://mdbootstrap.com/docs/jquery/content/icons-list/" rel="stylesheet">

<link rel="stylesheet" href=" fonts/icomoon/style.css">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href=" FYP/IndexPage/css/magnific-popup.css">
    <link rel="stylesheet" href=" FYP/IndexPage/css/jquery-ui.css">
    <link rel="stylesheet" href=" FYP/IndexPage/css/owl.carousel.min.css">
    <link rel="stylesheet" href=" FYP/IndexPage/css/owl.theme.default.min.css">

    <link rel="stylesheet" href= "FYP/IndexPage/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href=" FYP/IndexPage/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href=" FYP/IndexPage/css/aos.css">
    <link rel="stylesheet" href=" FYP/IndexPage/css/rangeslider.css">

    <link rel="stylesheet" href=" FYP/IndexPage/css/style.css">

</head>

<body >

<?php  include "top-nav.php"; ?>
<div class = "row" style="margin-left:5px; margin-right:5px;" >
  

    <div class="site-section" style=" ">
      <div class="container">
       

        <div class="row align-items-stretch">
        
        <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-4" >
        <a href="#" class="popular-category h-100" data-toggle="modal" data-target="#myModal"style="background:#720e3b; ">
            
              <span class="icon mb-3"><span class="flaticon-flower"></span></span>
              <span class="caption mb-3 d-block" style = "color:#fff;" > Rate your booked venues</span>
            </a>
          </div>
          <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-4" >
            <a href="https://localhost:8080/recommendations_current.php" class="popular-category h-100" style="background:#720e3b; ">
              <span class="icon mb-3"><span class="flaticon-flower"></span></span>
              <span class="caption mb-3 d-block" style = "color:#fff;" >Recommendation Engine</span>
                         </a>
          </div>
          <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-4">
            <a href="https://localhost:8080/custom_current.php" class="popular-category h-100" style="background:#720e3b; ">
              <span class="icon mb-3"><span class="flaticon-restaurant"></span></span>
              <span class="caption mb-3 d-block" style = "color:#fff;">Provide Your Custom Criteria</span>
                         </a>
          </div>



          </div>

  </div>
  </div>

  <div class="row" style="padding-bottom:40px;padding-top:40px;">

   <?php 
         if (isset($_SESSION["userID"])){
           $userID = $_SESSION["userID"];
           $que = $conn->prepare("select * from hall_booking where user_id= ?");
           $que->bind_param("s", $userID);
           $que->execute();
           $result = $que->get_result();

           while($row = $result->fetch_assoc()){
             $hallID = $row["hallID"];
             $hallname = $row["hallname"];
             $username = $row["username"];
           }

          }
      ?>        

<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">


<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Feedback</h4>
</div>
<div class="modal-body">
<div id="message" style="text-align: center; color: green;"></div>
                                <div class="form-group"> 
                                <span id="updatecapacitymodalerrortext" style="color:red"></span> 
                                  </div>
                                    <div class="form-group" >
         
                                    <label style="display:inline-block" class="col-md-4" style="font-family:Open Sans-serif;">Hello <?php echo $username; ?>   ! </label>
                                    <br><br>
                                    <div style="display:inline-block;" class="col-md-6">
                                    Let us know your feedback by providing us ratings. <br>
                                    </div>

</div>
<label style="display:inline-block;" for="input-1" class="control-label">Rate your overall experience at <?php echo $hallname;?>: </label>
<div style="display:inline-block;" id="rateYo"></div>
<input type="hidden" name="rating" id="rating_input"/>
<br/>
<button type="button" id="updateCapacityBtn" class="btn btn-info ">Save</button>
<button type="button" id="capacityModalClose" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div> 
<div class="modal-footer">
</div>

</div>
</div>

  </div>
  
  </div>
     <footer class="site-footer" style="font-size:12px; background-color:black; ">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4" style="color:white; font-weight:100px;font-size:16px;">About Us</h2>
                <p> Eventure Recommender System provides online booking of banquets by recommending the best banquets near to the provided location and requirements </p>            </div>
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
   <h2 class="footer-heading mb-4">Our Services</h2>
                             <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Facilities</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Contact Information</h2>
                <ul class="list-unstyled">
                  <li><a href="#">03009675427</a></li>
                  <li><a href="#">03335548876</a></li>
                  <li><a href="#">ers@gmail.com</a></li>
                                 </ul>
              </div>
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
                     <form action="#" method="post">
              <div class="input-group mb-3">
                          <div class="input-group-append">
                               </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row pt-5 mt-5">
          <div class="col-12 text-md-center text-left">
            <p>
              <!-- Link back to Free-Template.co can't be removed. Template is licensed under CC BY 3.0. -->
          &copy; 2019 .www.eventurerecommendersystem.com. All Rights Reserved. <br> Designed by SE students.         </p>
          </div>
        </div>
      </div>
    </footer>
  </div>

 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
<!-- Trigger the modal with a button -->
<script>
$(function () {
     
     $("#rateYo").rateYo({
    
       onSet: function (rating, rateYoInstance) {
          rating = Math.ceil(rating);
          $('#rating_input').val(rating);//setting up rating value to hidden field
          alert("Rating is set to: " + rating);
       }
     });
   });
</script>
 
    </body>


    </html>