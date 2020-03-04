<?php

session_start();
$globalid = $_SESSION["emailid"];
$con = mysqli_connect('localhost','master','password');

mysqli_select_db($con,'tododb');

$task_name = $_GET['task_name'];


    $query = "select notes from tasklist where taskname = '$task_name' and emailid = '$globalid'";

    $rs = mysqli_query($con,$query);
    
    $result = mysqli_fetch_array($rs);
    
   

    $response['note'] = $result[0];

    echo json_encode($response);

?>
