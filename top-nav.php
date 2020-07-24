<?php 
include "db.php";
$i = 0;
if (isset($_SESSION["username"])){
$username = $_SESSION["username"];}
if (isset($_SESSION["userID"]) && isset($_SESSION["username"])){
  $username = $_SESSION["username"];
$sql3 = $conn->prepare("Select count(distinct(userID)) as 'count' from requestdata where userID = ? && seen = ? && status = 1 ");
$sql3->bind_param("ss", $userID, $i);
$sql3->execute();
$result = $sql3->get_result();

$sql4 = $conn->prepare("select image from user_img where userID = ?");
$sql4->bind_param("s", $userID);
$sql4->execute();
$res4 = $sql4->get_result();

while($row4=$res4->fetch_assoc()){
  $image = $row4["image"];
}

while($row=$result->fetch_assoc()){
  $count = $row["count"];

}}else{
  
}

?>

<style>.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 17px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 50px;
  margin-left: 50px;
}

.openbtn {
  font-size: 16px;
  cursor: pointer;
  background-color: #444;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}</style>
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <?php echo
  "<a href='https://localhost:8080/FYP/IndexPage/index.php'>Home</a>
  <a href='https://localhost:8080/custom_current.php'>Custom Search</a>
  <a href='https://localhost:8080/recommendations_current.php'>Venue Recommender </a>
  <a href='https://localhost:8080/editProfile.php'>Settings</a>
  ";
  ?>
</div>
<nav class="navbar navbar-inverse">
    <div class="container-fluid" style="color:white">
     <div class="navbar-header">
     <div id="main" class="wrap" > 
     
     <a class="navbar-brand" href="#" style="font-size:23px; color:white">Eventure</a>
     <button class="openbtn" onclick="openNav()">☰ </button>  
     
     </div></div>
     <ul class="nav navbar-nav navbar-right">
    
    <li class="wrap"><?php if(isset($_SESSION["username"])){echo "
    <img src= ".$image."  width='50' height='50' style='margin-top:13px; margin-right:10px; border:2px solid black; border-radius:20em;>"; }?>
    </li>
<li class="wrap">
<label style=" margin-top:60px; margin-right:80px;"> 
<?php if(isset($_SESSION["userID"])){
  echo "<a href='https://localhost:8080/userProfile2.php'>";
  echo $username;
  echo "</a>";
}else{
 echo "<a href='signup.php' style='color:white'> Please Sign Up. </a>";
} ?> </label>
</li>

      <li class="dropdown">
     
       <a href="#" name="not" class="dropdown-toggle" data-toggle="dropdown" style="margin-top:10px; margin-right:10px;">
       <?php  if(isset($_SESSION["adminhallID"])){ if($count > 0){ echo"<span class='label label-pill label-danger count' style='border-radius:10px;'> ".$count."</span> ";} }?>
       <span class="glyphicon glyphicon-bell" style="font-size:29px; color:azure;" ></span></a>
   
     
       <ul class="dropdown-menu">
<?php 

  
  

if (isset($_SESSION["userID"])){
$sql1 = $conn->prepare("Select * from requestdata where userID = ? && status= 1");
$sql1->bind_param("s", $userID);
$sql1->execute();


$result = $sql1->get_result();
if ($result->num_rows>0){
while($row= $result->fetch_assoc()){
    $hallID = $row["hallID"];
    $visit = $row["visitDate"];
    $hallname = $row["hallName"];
  $seen = $row["seen"];
  $status = $row["status"];
}

if ($status = 1){
echo "<li style='height:70px;'>
<a herf='https://localhost:8080/Banquet_Details.php' style='backrgound-color:Azure;'>
<strong style='color:crimson;'>".$hallname."</strong><br>
<small><em>Your request to visit hall on the date ".$visit." is approved.<br>
Your request to book hall on the date is approved.
</em><br>
Kindly proceed to payment after visit for booking.
</small>
</a>
</li>";
}
if ($status = 0){

    echo "<li style='height:70px;'>
     <a herf='https://localhost:8080/Banquet_Details.php' style='backrgound-color:Azure;'>
    <strong>".$hallname."</strong><br>
    <small><em>Visit on ".$visit." is confirmed. <br>. </em></small>
    </a>
    </li>";
  }





}else{
 echo '
  <li><a href = "#" class= "text-bold text-italic" >No Notifications found.</a></li>
  ';
}

}
else {
  echo '
  <li><a href = "#" class= "text-bold text-italic" >Please login to recieve notifications.</a></li>
  ';
}



?>

<li></li>
</ul>

      </li>
      <li>
   
      <a href="logout.php"><span class="glyphicon glyphicon-log-out" style="font-size:25px;margin-top:6px; color:azure;"></span></a>
     
      </li>
      
     </ul>
     
    </div>
   </nav>
  
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}


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

// submit form and get new records

$('#comment_form').on('submit', function(event){
 event.preventDefault();

 if($('#subject').val() != '' && $('#comment').val() != '')

 {

  var form_data = $(this).serialize();

  $.ajax({

   url:"insert.php",
   method:"POST",
   data:form_data,
   success:function(data)

   {

    $('#comment_form')[0].reset();
    load_unseen_notification();

   }

  });

 }

 else

 {
  alert("Both Fields are Required");
 }

});

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