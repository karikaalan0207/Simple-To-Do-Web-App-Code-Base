<?php

session_start();

$con = mysqli_connect('localhost','master','password');

mysqli_select_db($con,'tododb');

$emailid = $_POST['email'];
$pass = $_POST['password'];

$_SESSION["emailid"] = $emailid;

$s = "select * from users where emailid = '$emailid' and psswd = '$pass'";
$ss = "select emailid from users where emailid = '$emailid'";

$r = mysqli_query($con,$s);
$rr = mysqli_query($con,$ss);


$num = mysqli_num_rows($r);
$numm = mysqli_num_rows($rr);

$firstname = "select firstname from users where emailid = '$emailid' and psswd = '$pass'";
$lastname =  "select firstname from users where emailid = '$emailid' and psswd = '$pass'";

$fnq = mysqli_query($con,$firstname);

$e = mysqli_fetch_row($fnq);

$_SESSION["firstname"]=$e[0];


if($num == 1){
    $_SESSION["emailid"]=$emailid;
    header('location:index.php');
}
else if($num == 0 && $numm == 1){
    //js alert that username pass combo is wrong 
    echo '<script type="text/javascript">alert("Email Id , Password Combo is Wrong ! Please Try Again");</script>';
    echo ("<script>window.location='signin.html';</script>");
}
else if($numm == 0){
    echo '<script type="text/javascript">alert("Given Email Id Does not exist. Please Register your Account First ");</script>';
    echo ("<script>window.location='signup.html';</script>");
}

?>