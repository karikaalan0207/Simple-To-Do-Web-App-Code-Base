<?php

session_start();

$con = mysqli_connect('localhost','master','password');

mysqli_select_db($con,'tododb');

$task_name = $_POST['task_name'];

$response = [];
$response['message'] = $task_name;

echo json_encode($response);
    $query = "insert into tasklist (emailid,taskname) values ('$_SESSION[emailid]','$task_name')";
    mysqli_query($con,$query);
    // $response['message'] = "success";

?>
