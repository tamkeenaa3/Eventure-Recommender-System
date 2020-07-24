
<?php 
include "db.php";
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

<body style = "margin-left:20px; margin-right:20px;" >

<div class = "container"  style = "margin:40px;" >
<?php if (isset($_SESSION['mesg'])){
      echo "<div class='alert alert-success' role='alert'>".$_SESSION['mesg']."</div>";
    } ?>
</div> 


<hr>
<div class="container bootstrap snippet" style = "align-content:center; text-align: center; ">
  <?php 
  if (isset($_SESSION['adminemail'])){
   $email = $_SESSION['adminemail'];
   echo $email;
   $sql = "SELECT * FROM admin where email = '$email'" ;
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $current_username= $row["name"];
      $current_phone = $row["phone"];
       $current_email = $row["email"];
        $userID = $row["adminID"];
    
    }}
    
    echo "<h1>". ucfirst($current_username)."'s Profile </h1>";
     echo "<h3> Admin </h3>";
   }?>
  
</div>

   
    </div>
    <div class="row">
    <div class = "container .justify-content-end" style = " width: 70%; float:right;"> 
             <?php 
             $sql = "Select * from admin where email = '$email'" or trigger_error($sql, E_USER_ERROR);
             $result = $conn->query($sql);
             if ($result->num_rows > 0){
            
            $row = $result -> fetch_assoc();
              echo "<div class = 'card'>
              <div class = 'card-body'>
              <form method = 'POST'>
                              <div class='form-group row'>
                                <label for='username' class='col-4 col-form-label'>User Name*</label> 
                                <div class='col-8'>
                                  <input id='username' name='username' placeholder='".ucfirst($row['name'])."' class='form-control here' readonly type='text'>
                                </div>
                              </div>
                            
                              <div class='form-group row'>
                                <label for='email' class='col-4 col-form-label'>Email</label> 
                                <div class='col-8'>
                                  <input id='email' name='email' placeholder='".$row['email']."' class='form-control here' readonly type='email'>
                                </div>
                              </div>
                              <div class='form-group row'>
                                <label for='contact' class='col-4 col-form-label'>Contact Number</label> 
                                <div class='col-8'>
                                  <input id='contact' name='contact' placeholder='0".$row['phone']."' class='form-control here' readonly type='phone'>
                                </div>
                              </div>
                  
                              <div class='form-group row'>
                                <label for='newpass' class='col-4 col-form-label'>New Password</label> 
                                <div class='col-8'>
                                  <input id='newpass' maxlength = '12' name='newpass' placeholder='New Password' class='form-control here' type='password'>
                                </div>
                              </div> 
                              <div class='form-group row'>
                                <div class='offset-4 col-8'>
                                  <button name='submit' type='submit' class='btn btn-primary'>Update My Password</button>
                                </div>
                              </div>
                            </form>
              </div>
              
              
              </div>";
              
          
              /* free result set */
              $result->close();
          }
          if (isset($_POST["submit"])){
           $newpass =  $_POST['newpass'];
           $newpass = password_hash($newpass, PASSWORD_BCRYPT);
            $stmt = $conn->prepare( "UPDATE admin SET password = ? where email = '$email'");
            $stmt->bind_param("s",$newpass);
            
            if($stmt->execute()){
              echo "<div class = 'alert alert-success' role='alert'>
              Updated Successfully.
              </div> ";
            }
           
            
          }
             
             
             ?> 
              
      </div>
  		<div class="col-sm-3" ><!--left col-->
            

      <div class="text-center"> 
      <?php 
      if(isset($_SESSION["adminhallID"])){
        $hallID = $_SESSION["adminhallID"];
      $q = $conn->prepare("Select count(*) AS total from requestdata where hallID = ? && status = 0");
      $q->bind_param("s", $hallID);
       $q->execute();
       $res = $q->get_result();
      
         while($row = $res->fetch_assoc()){
           $reqcount = $row["total"];
         }
       
    }
?>
               
          <div class="panel panel-default">
            <div class="panel-heading">Eventure <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="https://localhost:8080/adminInsert.php">Update Data </a></div>

<div class="panel-body"><a href="https://localhost:8080/adminRequests.php">Approve Booking <?php  if(isset($_SESSION["adminhallID"])){ if($reqcount > 0){ echo"<span class='label label-pill label-danger count' style='border-radius:10px;'> ".$reqcount."</span> ";} }?></a></div>

<div class="panel-body"><a href="https://localhost:8080/adminPay.php">Payment Details </a></div>

<div class="panel-body"><a href="https://localhost:8080/paymententry.php">Add Payments of General Customers</a></div>

</div>
          
          
  
        
          
        </div><!--/col-3-->
    
            
              
              <hr>
              
             </div><!--/tab-pane-->
            
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->

        
    </div><!--/row-->
                                          

    </body>
    </html>