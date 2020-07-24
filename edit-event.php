<?php
require_once "db.php";
session_start();
$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

$sqlUpdate = "UPDATE events SET title='" . $title . "',start='" . $start . "',end='" . $end . "' WHERE id=" . $id;
mysqli_query($conn, $sqlUpdate);
mysqli_close($conn);

?>