<?php
include('mysql_connect.php');
	$id=$_GET['id'];
	$sql2="UPDATE Personal SET Status='0' where User_ID='$id'";
	$result2=mysqli_query($link,$sql2);
?>