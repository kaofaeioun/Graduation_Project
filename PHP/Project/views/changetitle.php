<?php
            changetitle();
            function changetitle()
            {
                include 'mysql_connect.php';
                $correct1 = $_GET['correctinfo'];
                $changed = $_GET['changed'];
                $usernow = $_GET['account'];
                $sql = "UPDATE Personal SET $changed='$correct1' Where User_ID='$usernow' ";
                $result = mysqli_query($link, $sql);
            }
?>
