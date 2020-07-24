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
  $eventdt = $row["visitDate"];
  $hallID = $row["hallID"];

}


$sql2 = $conn->prepare("select hallName from hall_details where hallID = ?");
$sql2->bind_param("s", $hallID);
$sql2->execute();
$result = $sql2->get_result();
while($row=$result->fetch_assoc()){
  $hallName = $row["hallName"];

}
if (isset($_SESSION["userID"]))
$sql5 = $conn->prepare("select image from user_img where userID = ?");
$sql5->bind_param("s", $userID);
$sql5->execute();
$res5 = $sql5->get_result();
if ($res5->num_rows>0){
while($row5= $res5->fetch_assoc()){
  $image = $row5["image"];
}
}
else{
    $image = "default-user.png";
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
  <title> Profile Settings</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body >
<div class = "row" style="margin-left:5px;margin-right:5px;" >
  <?php include "top-nav.php"; ?>
  </div>

 <div class="container"  >
 <div class="col s4" >

 <div class="jumbotron"><center><h2><strong> Profile Settings</strong><h2></center></div>
 <div class="row" >
<?php

if (isset($_SESSION["email"]) || isset($_SESSION["userID"])){
$email = $_SESSION["email"];
$userID = $_SESSION["userID"];
             $sql = "Select * from users where email = '$email'";
             $result = $conn->query($sql);
             if ($result->num_rows > 0){
            
            $row = $result -> fetch_assoc();
              echo "<div class='container' style='padding:30px'>
              <form method = 'POST'>
              <div class='container'>
              <center>
              
                            <img src = '".$image."' width = 150 height= 150 style='border-radius:250px; border:2px solid white;'>
                            <h3>".$current_username." </h3><br>
                           
                             </center>
                            <br>
                            <div class='container' style='padding:70px; border:1px solid grey;'>   
                            <div class='form-group row'>
                                <label for='email' class='col-4 col-form-label'>Username </label> 
                                <div class='col-8'>
                                  <input id='email' name='email' placeholder='".$row['username']."' class='form-control here' autocomplete = 'off' type='text'>
                                </div>
                              </div>
                              <br>
                              <div class='form-group row'>
                                <label for='contact' class='col-4 col-form-label'>Contact Number</label> 
                                <div class='col-8'>
                                  <input id='contact' name='contact' placeholder='0".$row['phone']."' class='form-control here' readonly type='phone'>
                                </div>
                              </div>
                            <br>
                              <div class='form-group row'>
                                <label for='newpass' class='col-4 col-form-label'>New Password</label> 
                                <div class='col-8'>
                                  <input id='newpass' maxlength = '12' name='newpass' placeholder='New Password' class='form-control here' type='password'>
                                </div>
                              </div> 
                              
                              <div class='form-group' '>
                                <div class='row'>
                                  <button name='submit' type='submit' class='btn btn-primary'>Update My Profile</button>
                                </div>
                              </div>
                              
              </div>
              </form> </div>";

              $result->close();
          }
          if (isset($_SESSION["userID"])){
          if (isset($_POST["submit"]) ){
              if (!empty($_POST["newpass"]) && isset($_POST["newpass"])){
           $newpass =  $_POST['newpass'];
           $name = $_POST["email"];
           $newpass = password_hash($newpass, PASSWORD_BCRYPT);
            $stmt = $conn->prepare( "UPDATE users SET password = ? where userID = ?");
            $stmt->bind_param("ss",$newpass, $userID);
            
            if($stmt->execute()){
              echo "<div class = 'alert alert-success' role='alert'>
              Password Updated Successfully.
              </div> ";}
            }

            if (!empty($_POST["email"]) && isset($_POST["email"])){
                $name = $_POST["email"];
                 $stmt = $conn->prepare( "UPDATE users SET username = ? where userID = ?");
                 $stmt->bind_param("ss",$name, $userID);
                 
                 if($stmt->execute()){
                   echo "<div class = 'alert alert-success' role='alert'>
                   <strong>Username Updated Successfully.</strong><br>
                   Refresh the page to view changes.
                   </div> ";}
                 }
            
            }

            }
            
        }else{
              echo "<div class='alert alert-warning' role='alert'>
              <strong>WARNING!</strong> Kindly login first to view this page.
              </div>";
            }
         
          
           ?> 
          
          
  </div>
 </div>

     </div>
    </body>
    </html>

