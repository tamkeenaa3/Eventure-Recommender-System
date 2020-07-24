<?php
    require_once "db.php";
session_start();
    $json = array();
    $hallID = isset($_GET['id']);
    $sqlQuery = "SELECT * FROM events where hallID = '$hallID' ORDER BY id";

    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    mysqli_close($conn);
    echo json_encode($eventArray);
?>