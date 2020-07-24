<?php 
require "db.php";
require_once "login.php";
session_start();
if (isset($_GET['username']))
{
$username = $_GET['username'];
$get_user = $mysqli->query("SELECT * FROM users WHERE username = '$username'");
if ($get_user->num_rows == 1)
{
    $profile_data = $get_user->fetch_assoc();
           
}
       
} 


if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      $folder = "images/";
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
}


if (isset($_POST["update"])){
  $stmt = $conn->prepare("UPDATE users SET username = ?, phone = ? , email = ?");
     $stmt->bind_param("sss", $_POST["username"], $_POST["phone"] , $_POST["email"]);
     $stmt->execute();
     echo "<label> Data Updated.</label>";

}
if (isset($_POST["update2"])){
  $stmt = $conn->prepare("UPDATE users SET password = ?");
     $stmt->bind_param("s", $_POST["password"]);
     $stmt->execute();
echo "<label> Password Updated.</label>";
}


?>

<!DOCTYPE HTML>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<body>
<div class="well" >
  <h1> <?php echo $profile_data['username'] ?>Profile Settings</h1>
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
      <li><a href="#profile" data-toggle="tab">Password</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab">
            <label>Username</label>
            <input type="text" value="" class="input-xlarge" name="username">
            <label>Phone Number</label>
            <input type="text" value="John" class="input-xlarge" name="lname">
          
            <label>Email</label>
            <input type="text" value="jsmith@yourcompany.com" class="input-xlarge" name = "email">           

            <label>Time Zone</label>
            <select name="DropDownTimezone" id="DropDownTimezone" class="input-xlarge" >

            
              <option value="5.0">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
            </select>
          	<div>
        	    <button class="btn btn-primary" name= "update">Update</button>
        	</div>
        </form>
      </div>
      <div class="tab-pane fade" id="profile">
    	<form id="tab2">
        	<label>New Password</label>
        	<input type="password" class="input-xlarge" name = "password">
        	<div>
        	    <button name= "update2" class="btn btn-primary">Update</button>
        	</div>
    	</form>
      </div>
  </div>

</body>
  </html>