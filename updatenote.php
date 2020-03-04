<?php

session_start();
$globalid = $_SESSION["emailid"];
$con = mysqli_connect('localhost','master','password');

mysqli_select_db($con,'tododb');

$task_name = $_POST['task_name'];
$current_list = $_POST['no'];
$response = [];
$query = "update tasklist set notes = '$current_list' where taskname = '$task_name' and emailid = '$globalid'";
    mysqli_query($con, $query);
// $response = $current_list;
// echo json_encode($response);
?>