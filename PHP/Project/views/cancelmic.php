<?php
	include("mysql_connect.php");
	$singer=$_GET['singer'];
	$sql2="Delete From Mic where User_ID ='$singer'";
	$result2=mysqli_query($link,$sql2);
	$sql3="UPDATE User SET `User_Status`='0' where `User_ID`='$singer'";
?>