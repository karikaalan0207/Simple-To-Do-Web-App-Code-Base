<?php

session_start();
$globalid = $_SESSION["emailid"];
$con = mysqli_connect('localhost','master','password');

mysqli_select_db($con, 'tododb');

$listname = $_POST['listname'];

$testquery = "select * from lists where category = '$listname'";
$rr = mysqli_query($con,$testquery);
$num = mysqli_num_rows($rr);


if($num === 1)
{
    //js alert that list name already exists
    //echo "$listname";
   
    echo '<script type="text/javascript">alert("Given List Name already Exists , Try with a different entry");</script>';
}
else
{
    $query = "insert into lists values('$listname',0,'$globalid')";
    mysqli_query($con,$query);
    echo '<script type="text/javascript">alert("Insertion Successful");
    window.location="index.php";</script>';
}

?>


