<?php 
include "db.php";
session_start();
if (isset($_SESSION["userID"])){
$userID = $_SESSION["userID"];}
$i = 0;
if (isset($_POST["view"])){

    if($_POST["view"] != ''){
   $update = $conn->prepare("Update requestdata SET seen = 1 where userID = ? && seen = ?");
   $update->bind_param("ss", $userID, $i);
$update->execute();
    }
$sql1 = $conn->prepare("Select * from requestdata where userID = ? && status = 1");
$sql1->bind_param("s", $userID);
$sql1->execute();
$result = $sql1->get_result();
if ($result->num_rows>0){
while($row= $result->fetch_assoc()){
    $hallID = $row["hallID"];
    $event = $row["visitDate"];
    $meet = $row["meetDate"];
    $hallname = $row["hallName"];
  $status = $row["status"];
}
if ($status = 1){
echo "<li>
<a herf='#'>
<strong>".$hallname."</strong><br>
<small><em>Your request to reserve hall is approved.</em></small>
</a>
</li>";}
if ($status = 0){
    echo "<li>
    <a herf='#'>
    <strong>".$hallname."</strong><br>
    <small><em>Your request to reserve hall is cancelled. Request another date or contact manager.</em></small>
    </a>
    </li>";}
   
}}
else{
    $output .= '
    <li><a href = "#" class= "text-bold text-italic" >No Notifications found.</a></li>
    ';
    }

$show = $conn->prepare("Select * from requestdata where seen = ?");
$show->bind_parram("s", $i);
$show->execute();
$count = $show->get_result();

$data = array(
    'notification' => $output,
    'unseen_notification'  => $count

);
echo json_encode($data);

?>