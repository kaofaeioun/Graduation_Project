<?php
    include('mysql_connect.php');
    if($_GET['id']&&$_GET['singer']){
    $id=$_GET['id'];
    $singer=$_GET['singer'];
    $sql="INSERT INTO `Vote`(User_ID,Mic_ID,Battle_ID) VALUES ('$id','$singer','1')";
    $result=mysqli_query($link,$sql) or die ("Query failed!");
    $row=mysqli_fetch_row($result);
    }
?>