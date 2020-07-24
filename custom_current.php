
<?php    
require "db.php";
session_start();
if (isset($_SESSION["userID"])){
 $userID = $_SESSION["userID"];}
 include "top-nav.php";
       ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Custom Criteria</title>

    <!-- load stylesheets -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                                         
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>              
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      </head>

      <body>

       
        <div class="container" id="top">
       
                    <div class="jumbotron" style=" color:black; font-family: Charcoal, sans-serif; justify:center;">

                        <div class="row" style="margin-bottom:5px;">
                            <div class="col-xs-12">
                                <div class="tm-banner-header" style = "margin-top:20px; margin-bottom:5px;">
                                  <center>  <h1 class="text tm-banner-title" style="color:crimson;">Custom Criteria</h1></center>
                                 
                                <center><em>We assist you to choose the best.</em></center><br>
                                    <a href="javascript:void(0)" class="tm-down-arrow-link"><i class="fa fa-2x fa-angle-down tm-down-arrow"></i></a>       
                                </div>    
                            </div>  <!-- col-xs-12 -->                      
                        </div> <!-- row -->
                    
   <center>        
<button onclick="getLocation()" class="btn btn-default">Your Current Location</button>  <p id="demo" style="font-size:12px;"></p></center>
<br>
            <form action="#" method="POST" class="tm-search-form tm-section-pad-2">
      
          <div class="form-group col-xs-3">
         <label for="raddressInput">Select your area:</label>
         <select name = "inputarea" id="addressInput" class="form-control" width="30px;">
         <option value = "Gulistan e Johar">Gulistan e Johar</option>
         <option value = "Bin Qasim Town<">Bin Qasim Town</option>
         <option value = "Gulshan e Iqbal, Block 10">Gulshan e Iqbal, Block 10 </option>
         <option value = "F.B. Area ">F.B Area </option>
         <option value = "Gulshan e Iqbal, Block 11">Gulshan e Iqbal, Block 11 </option>
         <option value = "North Karachi">North Karachi</option>
         <option value = "Gulistan e Johar">North Nazimabad</option>
         <option value = "Gulistan e Johar">Airport</option>
         <option value = "Defence DHA Phase 1">Defence DHA Phase 1</option>
           <option value = "Defence DHA Phase 2">Defence DHA Phase 2</option>
         <option value = "Defence DHA Phase 3">Defence DHA Phase 3</option>
         <option value = "Defence DHA Phase 4">Defence DHA Phase 4</option>
         <option value = "Defence DHA Phase 5">Defence DHA Phase 5</option>
         <option value = "PNS Karsaz ">PNS Karsaz </option>
         <option value = "Rashid Minhas Road  ">Rashid Minhas Road </option>
         </select>
         
         <br>
       </div>
       
       <div class="form-row col-xs-3">     
        <label for="radiusSelect">Radius:</label>
        <select id="radiusSelect" label="Radius" class="form-control">
          <option value="50" selected>50 kms</option>
          <option value="30">30 kms</option>
          <option value="20">20 kms</option>
          <option value="10">10 kms</option>
          </select>
                                    </div>


                                     <div class="form-row col-xs-3">                                    
                                       
                                            <label for="inputGuests">How many guests?</label>
                                                <input type="number"  autocomplete="off" class = "form-control" name="myInput" value="100" min="100" max="1200" step="100"></div>
                                    
                                     <div class="form-row col-xs-3">                                          
                                      <label for="inputBudget">Budget</label>     
                                        <input type="number" autocomplete="off" class = "form-control" name="budget" value="5000" min="20000" max="5000000" step="10000">                             
                                       <small> <center> (and below)</center></small>
                                         </div>


                               ` <!-- form-row -->
                                <div class="row">
                                        <div class="form-row col-xs-3"> 
                                        <label for="inputCheckIn"> Check Availability </label>
                                        <input name="check-in" type="text" autocomplete="off" class="cal form-control" id="inputCheckIn" placeholder="View the Calender..">
                                    </div>
                                    
                                    <div class="wrap"> 
                                    
                            <button type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" style="padding:20px;">
                                          Let's Find.
                              </button>
                                    </div>
                                </div>                              
                            </form>                             

                        </div> <!-- row -->
                                   
                </div>     <!-- .tm-container-outer -->                 
            </section>

    
  
<div style = "padding-bottom: 20%; ">
<div id="map" style="width: 100%; height: 70%"></div>

<div class="card-container">
   <?php
if (isset($_POST["btnSubmit"])){
    
   echo  "
   <div class='wrap' style='margin-bottom:10px;'> <h3> Showing results:</h3><div>";
    $area = $_POST["inputarea"];
    $guest = $_POST["myInput"];
    $budget = $_POST["budget"];
    $booked = $_POST["check-in"];

     $stmt = $conn->prepare("SELECT * from hall_details where location = ? OR numOfGuests = ? OR budget = ? OR booked_date != ?");
     $stmt->bind_param("ssss", $area, $guest, $budget, $booked);
     $stmt->execute();

     $result = $stmt->get_result();

      if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
       
      $hallID = $row["hallID"];
      $hallName = $row["hallName"];
      $location = $row["location"];
      $budget = $row["budget"];
    $numOfGuests = $row["numOfGuests"];
    $pictures = $row["pictures"];
    $typeOfEvent = $row["typeOfEvent"];
    $themes = $row["themes"];
    $cateringType = $row["cateringType"];
  
  
  echo "
<div class = 'row' style='padding:10px; margin-left:100px;padding-bottom:50px;'>
<div class='card' style='width: 50rem; height:60rem;'>

<img class='card-img-top' src = '$pictures ' width=90% height=50% alt = 'photo'/></center></br></br>
<h4 class='card-title'><strong>".$hallName."</strong></h4>
<p class='card-text'><label> Location: </label> ".$location."</p>

<ul class='list-unstyled list-inline d-flex  mb-0'>
      <li class='list-inline-item mr-0  text'> 
        <div class='chip mr-0' style = 'padding-right:20px;'><label> Budget:</label> Rs. ".$budget."</div>
      </li>
       <li class='list-inline-item mr-0 text'>
        <div class='chip mr-0 '> <label>Guests capacity:</label>".$numOfGuests."</div>
      </li>

    </ul>
    
    <li class='list-inline-item mr-0 text '> 
        <div class='chip mr-0' style = 'padding-left:20px; color:green;'> Available on: <label> ".$booked." </label></div>
      </li>

       <br><center><form action= '#' method = 'GET'> 
       <div class='chip mr-0' style = 'padding-bottom:20px;'>
<a name = 'check-in' id= 'btn-available' href = 'https://localhost:8080/Banquet_Details.php?value=".$hallID."' class = 'btn btn-primary tm-btn'>View Details</a>
</div>
</center>
</form>
<br>
    
   <br>
 
</div>
 </div>
   
";

                  }
} else {
    echo "

    <div class = 'container-fluid'> 0 results </div>" ;
}

}
   ?>
</div></div>
<style>
.card-container {
        width: 1500px;
        overflow-x: scroll;
        display: flex;
        background-color: #100e17;
        padding: 3rem;
        color:white;
    }

    .card {
      color:white;
        min-width: 300px;
        height: 420px;
        border-radius: 16px;
        background-color: #17141d;
        box-shadow: -1rem 0 3rem #000;
        display: flex;
        flex-direction: column;
        padding: 1.5rem;
        transition: 0.2s;
    }
</style>

        </div>
    </div> <!-- .main-content -->

    <!-- load JS files -->
    <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->       
    <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
    <script src="js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
    <script src="slick/slick.min.js"></script>                  <!-- https://kenwheeler.github.io/slick/ -->
    <script src="js/jquery.scrollTo.min.js"></script>   
    <script
  src="https://code.jquery.com/jquery-4.0.0.slim.js"
  integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
  crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script async defer 
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtpRbjEWi6HjF4uiYhAX9liNn_dun2cH0&callback=initMap">
    </script>
    <script> 
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}
  let map, infoWindow;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 24.895, lng: 67.106 },
    zoom: 6
  });
  infoWindow = new google.maps.InfoWindow();

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      position => {
        const pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        infoWindow.setPosition(pos);
        infoWindow.setContent("Location found.");
        infoWindow.open(map);
        map.setCenter(pos);
      },
      () => {
        handleLocationError(true, infoWindow, map.getCenter());
      }
    );
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: Turn on your location."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}


      
        /* DOM is ready
        ------------------------------------------------*/
        $(function(){

            // Change top navbar on scroll
            $(window).on("scroll", function() {
                if($(window).scrollTop() > 100) {
                    $(".tm-top-bar").addClass("active");
                } else {                    
                 $(".tm-top-bar").removeClass("active");
                }
            });

            // Smooth scroll to search form
            $('.tm-down-arrow-link').click(function(){
                $.scrollTo('#tm-section-search', 300, {easing:'linear'});
            });

            // Date Picker in Search form
            //var pickerCheckIn = datepicker('#inputCheckIn');

            //var dateAvailable = datepicker('#btn-available');

  
$('#inputCheckIn').datepicker({
    format: "dd/mm/yyyy",
    clearBtn: true,
    minDate: 0,
    daysOfWeekDisabled: ""
    
   

  });


            // Close navbar after clicked
            $('.nav-link').click(function(){
                $('#mainNav').removeClass('show');
            });

            // Slick Carousel
            $('.tm-slideshow').slick({
                infinite: true,
                arrows: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });

            loadGoogleMap();                                       // Google Map                
            $('.tm-current-year').text(new Date().getFullYear());  // Update year in copyright           
        });

    </script>             

</body>
</html>