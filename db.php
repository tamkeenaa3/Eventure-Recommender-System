<?php
$servername = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "eventure";

$conn = new mysqli($servername, $user, $password, $dbname);
if ($conn->connect_error){
echo $conn->connect_error;
}

 
?>