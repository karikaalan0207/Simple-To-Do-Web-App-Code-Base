<?php

session_start();

$con = mysqli_connect('localhost','master','password');

mysqli_select_db($con,'tododb');

$task_name = $_POST['task_name'];
$current_list = $_POST['currentlist'];
$response = [];


    $query = "insert into tasklist (emailid,taskname,category) values ('$_SESSION[emailid]','$task_name','$current_list')";
    mysqli_query($con,$query);
    // $response['message'] = "success";

?>