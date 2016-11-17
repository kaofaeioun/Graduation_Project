<?php
    include('mysql_connect.php');
    if($_GET['id']){
    $id=$_GET['id'];
    $sql="select Photo from User where User_ID=$id";
    $result=mysqli_query($link,$sql) or die ("Query failed!");
    $row=mysqli_fetch_row($result);
    Header( "Content-type: image/jpg");
        echo base64_decode($row[0]);
    }
?>