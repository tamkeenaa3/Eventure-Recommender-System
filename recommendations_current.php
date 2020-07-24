<?php 
require "db.php";
session_start();

if (isset($_SESSION["userID"])){
$userID = $_SESSION["userID"];}
if (isset($_SESSION["username"])){
$username = $_SESSION["username"];}
include "top-nav.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Recommend</title>

    <!-- load stylesheets -->                                     
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <link rel="stylesheet" href="css/templatemo-style.css">      
    <link rel="stylesheet" href="slick/slick-theme.css">    
    <link rel="stylesheet" href="slick/slick.scss">       
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">                
  <style> 
  .checked{
  color:orange;
  }
      </style>
    
      </head>

      <body>
        <div class="tm-main-content" id="top" style=" background-color:white">
          
           

           <div class="tm-page-wrap mx-auto">
            <section class="tm-banner">
         <div class="container">

         <?php 
  if (isset($_SESSION["userID"])){
    $ID = $_SESSION["userID"];
$result2 = $conn->query("Select * from data where userID = '$ID'");


echo "<div class = 'panel panel-default'><div class = 'panel-heading'>
 <br><h2> Recommended for you:</h2><br>
 </div></div>";
if ($result2->num_rows > 0) {
while ($row= $result2->fetch_assoc()) {
    $hallID = $row['hallID'];
    $hallTitle = $row['hallName'];
    $userRating = $row['userRating'];
   

}}}
echo "<div>";
if (isset($_SESSION["userID"])){
$halls =  $conn->query("select * from data");
$matrix = array();
while ($row = $halls->fetch_array()){
$users = $conn->query("select username from users where userID='$row[userID]'");
$username = $users->fetch_array();

$matrix[$username['username']][$row['hallName']] = $row['userRating'];
}

$recommendation = array();
$recommendation = getRecommendation($matrix, $username['username']); 




foreach($recommendation as $row => $userRating){

$sql = $conn->query("Select * from hall_details where hallName = '$row'");

while($rec = $sql->fetch_array(MYSQLI_ASSOC) ){
   
echo " <div class='tm-recommended-place'>
<img src='".$rec['pictures']."' alt='Image' class='img-fluid tm-recommended-img'>
<div class='tm-recommended-description-box'>
    <h3 class='tm-recommended-title'>".$rec['hallName']."</h3>
    <p class='tm-text-highlight'>".$rec['location']."<br>
         Starting From ".$rec['budget']." pkr<br>
          Guest-Upto ".$rec['numOfGuests']."</p>
  <label style = 'color:blue;'> Similar users have liked this </label>  <span class = 'fa fa-star checked'> </span> 
  <br><br>
 
  <form method = 'GET'>
  <a href = 'https://localhost:8080/Banquet_Details.php?value=".$rec['hallID']."' name = 'view_details' class = 'btn btn-primary'> View Details </a>
  </form>
  </div>
<a href='#' class='tm-recommended-price-box'>
    <p class='tm-recommended-price'>Pkr ".$rec['budget']."</p>
</a>
</div><br/>";
}

}}
else{
    echo "<div alert='alert alert-info container' role='alert'>
    Kindly Login/Sign Up to get recommendations.
    </div>";
}


function getRecommendation($matrix, $person){
    $total = array();
    $simsums = array();
    $ranks = array();
    foreach($matrix as $otherPerson => $value){
        if ($otherPerson != $person){
            $sim = similarity_distance($matrix, $person, $otherPerson);
            
            foreach ($matrix[$otherPerson] as $key => $value){
                if (!array_key_exists($key, $matrix[$person])){
                    if(!array_key_exists($key, $total)){
                        $total[$key] = 0;
                        
                    }
                    $total[$key] += $matrix[$otherPerson][$key]*$sim;
                    if(!array_key_exists($key, $simsums)){
                        $simsums[$key] = 0;

                    }

                      $simsums[$key] += $sim;
                }
            }
        }
    }

    foreach($total as $key=>$value){
    $ranks[$key] = $value/$simsums[$key];
  
    }
    array_multisort($ranks, SORT_DESC);
    return $ranks;
}


function similarity_distance($matrix, $person1, $person2)
{
    $similar = array();
    $sum = 0;
    foreach($matrix[$person1] as $key=>$value){
        if (array_key_exists($key, $matrix[$person2] )){
            $similar[$key] = 1;
        }
    }
    

    if ($similar==0){
        return 0;
    }
     
    foreach($matrix[$person1] as $key=>$value){
        if (array_key_exists($key, $matrix[$person2] )){
            $sum = $sum + pow($value - $matrix[$person2][$key], 2);
        }
    }
    return 1/(1+ sqrt($sum));

}


?>

</div>
                     
        </div>
        </section>      

</div>


    
            <div class="tm-container-outer" id="tm-section-3" >
                <ul class="nav nav-pills tm-tabs-links">
                    <li class="tm-tab-link-li">
                        <a href="#1a" data-toggle="tab" class="tm-tab-link active">
                            <img src="images/trend.png" style = "width: 40px; height:40px; font-size:20px; " alt="Image" class="img-fluid">
                           <br> Top Rated Banquets:
                        </a>
                    </li>
                   

                 
                </ul>
                <div>
            
           </div>
                    <!-- Tab 1 -->
                    <div class="tab-pane show active" id="1a" >  
                    
<?php
$sqly = $conn->query("SELECT hall_details.hallID , hall_details.hallName , hall_details.location , hall_details.numOfGuests , 
hall_details.pictures , hall_details.typeOfEvent , hall_details.themes , hall_details.budget , data.userRating, data.userID from hall_details INNER JOIN data on hall_details.hallID = data.hallID 
WHERE userID = 71 GROUP BY hallID");
while($row = $sqly->fetch_assoc()) {
    $hallID = $row['hallID'];
    $userRating = $row['userRating'];
 $sql = "SELECT * from hall_details where hallID = '$hallID'";

$result = $conn->query($sql);
$loc = "https://localhost:8080/Banquet_Details?hallID=".urlencode($hallID);
if ($result->num_rows > 0) {
   //output data of each row
   while($row = $result->fetch_assoc()) {
    $hallID = $row["hallID"];
     $hallName = $row["hallName"];
      $location = $row["location"];
    $numOfGuests = $row["numOfGuests"];
    $pictures = $row["pictures"];
    $typeOfEvent = $row["typeOfEvent"];
    $themes = $row["themes"];
    $budget = $row["budget"];
    echo" 
<div class='tm-recommended' '> 
    
                            <div class='tm-recommended-place' style='background-color:lavender; color:black;'>
                                <img src='".$pictures."' alt='Image' class='img-fluid tm-recommended-img'>
                                <div class='tm-recommended-description-box'>
                                    <h3 class='tm-recommended-title' style='color:black;'> ".$hallName."</h3>
                                    <p class='tm-text-highlight'> ".$location." <br>
                                    <label style = 'color:black;'>Rating:&nbsp;&nbsp; <span class = 'fa fa-star checked'></span>   ".$userRating."</label><br>
                                    Starting From  Pkr ".$budget." <br>Guest-Upto ".$numOfGuests."</p>
                                    <br>
                                    <form method = 'GET'>
                               <a href = 'https://localhost:8080/Banquet_Details.php?value=".urlencode($hallID)."'  class = 'btn btn-primary' name = 'mybtn' > View Details</a>
                               </form>
                                    </div>
                                <a href='#' class='tm-recommended-price-box'>
                                 <br>   
                                <p class='tm-recommended-price'>Pkr ".$budget."</p>
                                </a>    </div>
                              
                                
                             
                            ";
                      
}}else {
    echo "No records found.";
}

}

   ?>          

                        <a href="#" id = "showplaces" class="text-uppercase btn-primary tm-btn mx-auto tm-d-table">View Recommendations</a>
                    </div> <!-- tab-pane -->
                   
                  
                    
                    

                    <!-- Tab 4 -->
                    <div class="tab-pane fade" id = "4a">
                    <!-- Current Active Tab WITH "show active" classes in DIV tag -->
                        <div>
                            <label>Needs to connect to your current location.</label>


                        </div>
                  
                    </div>
                </div>
            </div>



              <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->       
    <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
    <script src="js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
    <script src="slick/slick.min.js"></script>                  <!-- https://kenwheeler.github.io/slick/ -->
    <script src="js/jquery.scrollTo.min.js"></script>           <!-- https://github.com/flesler/jquery.scrollTo -->
    <script> 
                Pkr 50,(function(){

            // Change top navbar on scroll
            Pkr 50,(window).on("scroll", function() {
                if(Pkr 50,(window).scrollTop() > 100) {
                    Pkr 50,(".tm-top-bar").addClass("active");
                } else {                    
                 Pkr 50,(".tm-top-bar").removeClass("active");
                }
            });

 // Slick Carousel
            Pkr 50,(".tm-slideshow").slick({
                infinite: true,
                arrows: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });
   // Smooth scroll to search form
            Pkr 50,(".tm-down-arrow-link").click(function(){
                Pkr 50,.scrollTo("#tm-section-search", 300, {easing:"linear"});
            });
           


           
  </script> 
</body>
</html>