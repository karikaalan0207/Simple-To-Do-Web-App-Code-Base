<?php
    session_start();
    $globalid = $_SESSION["emailid"];

    $con = mysqli_connect('localhost','master','password','tododb');
    
    if(isset($_GET['category'])) {
        $category = $_GET['category'];
        //echo $category;
    }
    $sql = "select taskname from tasklist where category = '$category' and emailid = '$globalid' ";
    // var_dump($category);
    $lists = mysqli_query($con, $sql);
    while($row = mysqli_fetch_row($lists)) {
        echo "<li id = $row[0] class = 'oneitem' onclick = 'showinfo($row[0])'>$row[0]</li>";
    }
?>