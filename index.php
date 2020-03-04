<?php

$globalid = $_SESSION["emailid"];


session_start();
if (!isset($_SESSION["emailid"]) || $_SESSION["emailid"]=="")
{
    echo ("<script>window.alert('Login First');window.location='signin.html';</script>");
}
?>
<?php
        $con = mysqli_connect('localhost','master','password','tododb');
        $sqlmd = "insert into lists values('myday',1)";
        $lists = mysqli_query($con, $sqlmd);
        $sqlim = "insert into lists values('important',1)";
        $listsim = mysqli_query($con, $sqlim);
       
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <link rel="stylesheet" href="css/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <!-- <link rel="shortcut icon" href="images/favicon.png"> -->
    <title>Taskmanager &mdash; Your all-in-one task managing app</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="images/logo.png" alt="taskmanager logo" class="logo">

            <form class="add" id = "useless" action="#">
                <input type="text" class="add__input" placeholder="Add Task">

                <button type="button" name="button" class="add__button">
                    <svg class="add__icon">
                        <use xlink:href="images/sprite.svg#circle-with-plus"></use>
                    </svg>
                </button>
            </form>
            <script>
                document.getElementById("useless").style.visibility = "hidden";
                document.getElementById("myday").style.opacity = 0;
            </script>
            <nav class="user-nav">
                <!-- <div id = "notuse" class="user-nav__icon-box">
                    <svg class="user-nav__icon">
                        <use xlink:href="images/sprite.svg#icon-bookmark"></use>
                    </svg>
                    <span class="user-nav__notification">7</span>
                </div>
                <div id = "notuse1" class="user-nav__icon-box">
                    <svg class="user-nav__icon">
                        <use xlink:href="images/sprite.svg#icon-chat"></use>
                    </svg>
                    <span class="user-nav__notification">13</span>
                </div> -->
                <div id = "logout">
                    <li id = "lg" onclick = "window.location.href='logout.php'"> Log Out </li>

                </div>

                <div class="user-nav__user">
                    <!-- <img id = "notuse2" src="images/user.png" alt="usre photo" class="user-nav__user-photo"> -->
                    <span id = "un" class="user__nav__user-name"><?php echo $_SESSION["firstname"];?></span>
                </div>
            </nav>
        </div>
        <div class="content">
            <nav class="sidebar">
                <ul class="side-nav">
                <!-- side-nav__item--active -->
                    <li class="side-nav__item " onclick = "mydayvis()">
                        <a href="#" class="side-nav__link">
                            <svg class="side-nav__icon">
                                <use xlink:href="images/sprite.svg#icon-layers"></use>
                            </svg>
                            <span>My Day</span>
                        </a>
                    </li>
                    <li class="side-nav__item" onclick = "importantvis()">
                        <a href="#" class="side-nav__link">
                            <svg class="side-nav__icon">
                                <use xlink:href="images/sprite.svg#icon-star"></use>
                            </svg>
                            <span>Important</span>
                        </a>
                    </li>
                    <!-- <li class="side-nav__item" onclick = "upcomingvis()">
                        <a href="#" class="side-nav__link">
                            <svg class="side-nav__icon">
                                <use xlink:href="images/sprite.svg#icon-time-slot"></use>
                            </svg>
                            <span>Upcoming Plans</span>
                        </a>
                    </li> -->
                    <li class="side-nav__item" onclick = "overallvis()">
                        <a href="#" class="side-nav__link">
                            <svg class="side-nav__icon">
                                <use xlink:href="images/sprite.svg#icon-text-document"></use>
                            </svg>
                            <span>Overall Plans</span>
                        </a>
                    </li>
                    <br>
                    <li class="add-list">
                        <ul class="task-list">
                            <?php
                                $globalid = $_SESSION["emailid"];
                                $con = mysqli_connect('localhost','master','password','tododb');
                                $sql = "select category from lists where type != 1 and emailid = '$globalid'";
                                $lists = mysqli_query($con, $sql);
                                while($row = mysqli_fetch_row($lists)) {
                                    // $json_string = json_encode
                                   echo "<li id = '" . $row[0] . "' onclick = 'customtasklistvis($row[0])'>$row[0]</li>";
                                //    echo "<li id = '$row[0]' onclick = 'customtasklistvis()'>$row[0]</li>";
                                }
                            ?>
                        </ul>
                        <ul id = "task-list-add">
                        </ul>
                        <center>
                            <div class="tasklist__form">
                                <br><br><br>
                                <input type="text" name="listname" class="tasklist__input" id="tasklist__input" placeholder="Add list">
                                <button type="submit" class='tasklist__submit' onclick="listinsert_ajax()"> + </button>
                            
                            </div>
                        </center> 
                    </li>
                </ul>
            </nav>
            <main class="task-view">
                <div id = "choose">
                   <center> <p id = "chooses"> Select a Category</p></center>
                </div>
                <div class="tasks" id="myday">
                    <h3 class="tasks__heading">My Day<li id="td"></li> </h3>
                    <script>
                            var n =  new Date();  
                            var b = n.toDateString();
                            document.getElementById("td").innerHTML = b;
                    </script> 
                    <ul class="tasks__list">
                            <?php
                                $con = mysqli_connect('localhost','master','password','tododb');
                                $sql = "select taskname from tasklist where category = 'myday' and emailid = '$globalid'";
                                $lists = mysqli_query($con, $sql);
                                while($row = mysqli_fetch_row($lists)) {
                                    echo "<li id = $row[0] class = 'oneitem' onclick = 'showinfo($row[0])'>$row[0]</li>";
                                }
                            ?>
                            <ul id ="myday_taskl">
                            </ul>
                    </ul>
                    <div class="tasks__form">
                        <input type="text" name = "task_name" class="tasks__input" id="tasks__inputid_myday" placeholder="Add list item">
                        <button class='tasks__submit' onclick="myday_ajax()"> + </button>
                    </div> 
                </div>
                <div class="tasks" id="upcoming">
                    <h3 class="tasks__heading">Upcoming</h3>
                    
                    <ul class="tasks__list">
                        <?php
                            $con = mysqli_connect('localhost','master','password','tododb');
                            $sql = "select taskname from tasklist where deadline > sysdate()";
                            $lists = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_row($lists)) {
                                echo "<li id = $row[0] class = 'oneitem' onclick = 'showinfo($row[0])'>$row[0]</li>";
                            }
                        ?>
                        <ul id ="upcoming_taskl">
                        </ul>
                    </ul>
                    <div class="tasks__form">
                    <input type="text" name = "task_name" class="tasks__input" id="tasks__inputid_upcoming" placeholder="Add list item">
                        <button class='tasks__submit' onclick="upcoming_ajax()"> + </button>
                    </div> 
                </div>
                <div class="tasks" id="important">
                    <h3 class="tasks__heading">Important</h3>
                     
                    <ul class="tasks__list">
                        <?php
                            $con = mysqli_connect('localhost','master','password','tododb');
                            $sql = "select taskname from tasklist where importanttask = 1 and emailid = '$globalid'";
                            $lists = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_row($lists)) {
                                echo "<li id = $row[0] class = 'oneitem' onclick = 'showinfo($row[0])'>$row[0]</li>";
                            }
                        ?>
                        <ul id ="important_taskl">
                        </ul>
                    </ul>
                    <div class="tasks__form">
                    <input type="text" name = "task_name" class="tasks__input" id="tasks__inputid_important" placeholder="Add list item">
                        <button class='tasks__submit' onclick="important_ajax()"> + </button>
                    </div> 
                </div>
                <div class="tasks" id="overall">
                    <h3 class="tasks__heading">Overall</h3>
                    
                    <ul class="tasks__list">
                        <?php
                            $con = mysqli_connect('localhost','master','password','tododb');
                            $sql = "select taskname from tasklist where emailid = '$globalid'";
                            $lists = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_row($lists)) {
                                echo "<li id = $row[0] class = 'oneitem' onclick = 'showinfo_t($row[0])'>$row[0]</li>";
                            }
                        ?>
                    </ul>
                </div>

                <div class="tasks" id="customtasklist">
                        <h3 class="tasks__heading" id = listheading></h3>
                        
                        <ul class="tasks__list" id='cts'>
                        </ul>
                    
                        <div class="tasks__form">
                            <input type="text" name = "task_name" class="tasks__input" id="tasks__inputid_list" placeholder="Add list item">
                            <button class='tasks__submit' onclick="listh_ajax()"> + </button>
                        </div>
                </div>
                
                <div class="info-box" id="info-box">
                    <div class="info-box__close" onclick = "hideinfo()">
                        &times;
                    </div>
                    
                    <div id = "infohead">
                        <h4 id = "infohead_h" class = "infohead_h"></h4>
                        <li id = "deltask" onclick = "deltask()" >Delete this Task</li>
                    </div>
                    
                    <div id = "deadline">
                        <h5 id = "deadline_l">
                        </h5>
                    </div>
                    <!-- <div id = "deadline_update">
                        <input type="text" name = "noteup" class="tasks__input" id="deadline_u" placeholder="update Deadline if needed">
                        <button id='deadline_up'  onclick=""> + </button>
                    </div> -->
                    <br>
                    <div id = "noted">
                        <li id = 'nott'></li>
                    </div>
                    <div id = "noted_update">
                        <input type="text" name = "note" class="tasks__input" id="note_u" placeholder="Add/Update Notes">
                        <button id='note_up'  onclick="update_note()"> + </button>
                    </div>
                    
                </div>

            </main>
        </div>
    </div>
</body>
</html>
