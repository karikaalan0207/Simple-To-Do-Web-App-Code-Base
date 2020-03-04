<?php

session_start();

$con = mysqli_connect('localhost','master','password');

mysqli_select_db($con,'tododb');

$emailid = $_POST['emailu'];
$pass = $_POST['passwordu'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$s = "select * from users where emailid = '$emailid'";

$result = mysqli_query($con, $s);


$num = mysqli_num_rows($result);

if($num == 1){
    echo '<script type="text/javascript">alert("Email Id already Taken, Try with a different Email ID");</script>';
    header('location:signup.html');
}
else{
    $reg = "insert into users values ('$emailid','$pass','$firstname','$lastname')";
    mysqli_query($con, $reg);
    header('location:signin.html');
    // $_SESSION["emailid"]=$emailid;
    // $fnq = mysqli_query($con,$firstname);
    // $_SESSION["firstname"]=$fnq;
 
    echo '<script type="text/javascript">alert("Registration Successful");
    window.location="index.php";</script>';
    
}

?>