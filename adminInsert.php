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
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}
th {
  background-color: #4682B4;
  color: white;
}

.panel-body{
    padding-top:20px;
    padding-bottom:30px;
    padding-left:20px;
    padding-right:20px;
}

.btn{
  padding:10px;
  background-color:DodgerBlue;
}
</style>
</head>
	<body>
		<div class = "panel panel-body"  style = "margin:10px; padding:20px; font-size: 16px;">


<div class="center">
<h3> View and Upload Images </h3>
</div>
<div class = "row" >
<?php
include("db.php");
$hallID = $_SESSION["adminhallID"];

$id = $_SESSION['adminID'];
if (isset($_POST["display"])){

 $abc = $conn->query("Select * from images where hallID = '$hallID'");
 echo "<h4> Images </h4>";
echo '

<div class= "table-responsive" style = "background-color:light-blue;"> 
<table class= "table "> 
<tr> 
<th> Image ID </th>
<th> Images </th>
</tr>';
if ( $abc->num_rows>0){
 while ($res = $abc-> fetch_assoc()){
echo '<tr>
<td  id = "imageID">'.$res["imageID"].'</td>
<td  id = "images"> '.$res["image"]. '</td> 
</tr>';}
}
else {
    echo '<tr>
	<td colspan = "4"> Data not found. </td>
	 </tr>';
}
echo'</table>
</div>';
}
?>
</div>
</div>
</div>
<div class = "container" style="margin-left:20px; margin-right:20px;"><h4><strong> Upload Image</strong></h4> </div>
<div class = "jumbotron" style="padding:20px;"> 
<form action="adminInsert.php" method="post" enctype="multipart/form-data">
<div class="col-xs-5">
   <strong> Select Image Files to Upload:</strong><br>
    
    <input type="file" name="image" class = "form-control">
    </div><div class="wrap" >
    <input type="submit" name="submit" value="Upload Image" class = "btn btn-primary" style="margin-top:20px;">
  </div>
 
</form>

<form action = "adminInsert.php" method = "POST">
<div class="wrap">
 <button type="submit" name = "display" class="btn btn-primary btn-info" style="float:left; margin-top:30px; margin-left:20px; margin-bottom:30px;"> Display all Images</button>
</div>
</form>
</div>

<?php

include "db.php";

if (isset($_POST['submit'])){
$image = $_FILES['image'];
$type = $_FILES['image']['type'];
$image_size = $_FILES['image']['size'];
$tmp_dir = $_FILES['image']['tmp_name'];
move_uploaded_file($tmp_dir, "images/".$image['name']);
$img = "images/".$image['name'];
if ($type == "image/jpeg" || $type == "image/png" || $type == "image/jpg"){
    if ($image_size <= 2097152){
        $sql = $conn->prepare("INSERT INTO images(hallID, image) VALUES ( ?, ?);");
        $sql->bind_param("ss", $hallID, $img);

      $sql->execute();
      $result = $sql->get_result();

      if ($result){
       echo "<div class = 'alert alert-success'>
       Successfully uploaded on server!
       </div>";
      }

    }
}else {
    echo  "<div class = 'alert alert-warning'>
    Retry uploading file. File must be of type jpeg, .jpg or png.
    </div>";
}
}

if (!isset($_POST['submit'])) {
    
}
?>
</div>

<div class = "jumbotron justify-content-center" style="text-align:center; margin-top:100px;">
<div class="center">
<h3> Update Data</h3>

<div class="panel" style="margin-top:20px;">
    <?php
    include "db.php";
    $id = $_SESSION['adminID'];
    $select = "SELECT hall_details.hallID , hall_details.hallName , hall_details.location , hall_details.numOfGuests , 
    hall_details.pictures , hall_details.typeOfEvent , hall_details.themes ,hall_details.cateringType, hall_details.budget , hall_details.booked_date, admin.adminID from hall_details INNER JOIN admin on hall_details.hallID = admin.hallID where adminID = '$id'";
    
    $result = $conn->query($select);
    while ($row = $result->fetch_assoc()){
    echo "<div class = 'container'>
    <div class = 'card-body'>
    <form method = 'POST'>
                    <div class='form-group row'>
                      <label for='HallName' class='col-4 col-form-label'>Hall Name</label> 
                      <div class='col-8'>
                        <input id='HallName' name='hallName' placeholder='".ucfirst($row['hallName'])."' class='form-control here' type='text'>
                      </div>
                    </div>
                  
                    <div class='form-group row'>
                      <label for='location' class='col-4 col-form-label'>Location</label> 
                      <div class='col-8'>
                        <input id='location' name='location' placeholder='".$row['location']."' class='form-control here' type='text'>
                      </div>
                    </div>
                    <div class='form-group row'>
                      <label for='guests' class='col-4 col-form-label'>Number of Guests</label> 
                      <div class='col-8'>
                        <input id='guests' name='guests' placeholder='".$row['numOfGuests']."' class='form-control here' type='number'>
                      </div>
                    </div>
        
                    <div class='form-group row'>
                      <label for='typeOfEvent' class='col-4 col-form-label'>Type of Events</label> 
                      <div class='col-8'>
                        <input id='typeOfEvent'  name='typeOfEvent' placeholder='".$row['typeOfEvent']."' class='form-control here' type='text'>
                      </div>
                    </div> 
                    <div class='form-group row'>
                    <label for='themes' class='col-4 col-form-label'>Themes</label> 
                    <div class='col-8'>
                      <input id='themes'  name='themes' placeholder='".$row['themes']."' class='form-control here' type='text'>
                    </div>
                  </div> 
                  <div class='form-group row'>
                  <label for='budget' class='col-4 col-form-label'>Budget</label> 
                  <div class='col-8'>
                    <input id='budget'  name='budget' placeholder='".$row['budget']."' class='form-control here' type='number'>
                  </div>
                </div> 
                <div class='form-group row'>
                <label for='cateringType' class='col-4 col-form-label'>Catering Type</label> 
                <div class='col-8'>
                  <input id='cateringType'  name='cateringType' placeholder='".$row['cateringType']."' class='form-control here' type='text'>
                </div>
              </div> 
                    <div class='form-group row'>
                      <div class='col-10'>
                     <center>   <button name='submit' type='submit' class='btn btn-primary'>Update data </button></center>
                      </div>
                    </div>
                  </form>
    </div>
    
    
    </div>";
    }

    /* free result set */
    $result->close();

    if (isset($_SESSION["adminID"])){
    if (isset($_POST["submit"])){
        if ( !empty($_POST["hallName"]) && !empty($_POST["location"])  && !empty($_POST["guests"]) && !empty($_POST["typeOfEvent"]) && !empty($_POST["themes"]) && !empty($_POST["cateringType"]) && !empty($_POST["budget"])){
        
         $stmt = $conn->prepare( "UPDATE hall_details SET hallName = ?, location = ?, numOfGuests = ? , typeOfEvent=?, themes = ?, cateringType = ?, budget=? where hallID = '$hallID'");
         $stmt->bind_param("sssssss", $_POST["hallName"], $_POST["location"], $_POST["guests"], $_POST["typeOfEvent"], $_POST["themes"], $_POST["cateringType"], $_POST["budget"]);
         
         if($stmt->execute()){
           echo "<div class = 'alert alert-success' role='alert'>
           Updated Successfully.
           </div> ";
         }
        }else {
            echo "<div class = 'alert alert-warning' role='alert'>
            Kindly fill all the fields to update data.
            </div> ";
        }
        
         
       }
      }else {
        echo "<div class = 'alert alert-warning' role='alert'>
        <strong> Time Out!</strong> <br>
        Kindly login to access this page. 
        </div> ";
    }


?>   
</div> </div>
</div>

</body>



</html>