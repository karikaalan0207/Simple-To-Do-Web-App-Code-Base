<?php
    $con = mysqli_connect('localhost','master','password','tododb');

    $sql = "select * from lists";
    $lists = mysqli_query($con, $sql);
    while($row = mysqli_fetch_row($lists)) {
       echo "<li onclick = ''>$row[0]</li>";
    }
    // echo "Hello";

?>

