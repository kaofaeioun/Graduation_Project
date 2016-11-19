<?php
				changeinfo();
			function changeinfo(){
				include("mysql_connect.php");
				$correct1=$_GET['correctinfo'];
				$changed =$_GET['changed'];
				$usernow = $_COOKIE['account'];
				$sql="UPDATE User SET $changed='$correct1' Where User_ID='$usernow' ";
				$result=mysqli_query($link, $sql);									
			
			}
?>
	