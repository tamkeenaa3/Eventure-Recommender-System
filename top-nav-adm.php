<?php
include "db.php";
$adminname = $_SESSION["adminname"];
?>
<nav class="navbar justify-content-end" style="background-color:grey;">

<ul class="navbar justify-content-end">
<li class="wrap">
    <img src= "images/admin.jpg" width="50" height="50" style="margin-top:13px; margin-right:10px; border:2px solid white; border-radius:20em;">

</li>
<li class="wrap">
<label style="color:white; font-size:15px; margin-top:30px; margin-right:50px;"><a href = "adminProfile.php"style="color:white;" ><?php echo $adminname; ?></a> </label>
</li>
<li>
   <a href="adminLogout.php"><span class="glyphicon glyphicon-log-out" style="font-size:25px;margin-top:6px; color:white;"></span></a>
   </li>
</ul>

</nav>
  
