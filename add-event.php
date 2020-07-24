<?php
require_once "db.php";
session_start();
$hallID = isset($_GET['id']);
$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? $_POST['end'] : "";


 $sql = "Select * from hall_details where hallID = '$hallID'";
$res= $conn->query($sql);

 while ($row = $res->fetch_assoc()) {
        $hallID = $row["hallID"];

}

$sqlInsert = "INSERT INTO events (title, start, end, hallID) VALUES ('".$title."','".$start."','".$end ."', '".$hallID ."')";

$result =$conn->query($sqlInsert);

if (! $result) {
    $result = mysqli_error($conn);
}
?>