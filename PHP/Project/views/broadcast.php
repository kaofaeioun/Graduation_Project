<?php
header('Content-Type: application/json; charset=UTF-8');
include('mysql_connect.php');
	$id=$_GET['id'];
	$sql="SELECT User_Wins From User where User_ID='$id'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_row($result);
	if($row[0]>50){
	$sql2="UPDATE Personal SET Status='1' where User_ID='$id'";
	$result2=mysqli_query($link,$sql2);
		echo json_encode(array('success' =>'success'));
		return;
	}
	else{
		echo json_encode(array('fail'=>'fail'));
		return;
	}
?>