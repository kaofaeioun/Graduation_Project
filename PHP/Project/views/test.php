<?php
header('Content-Type: application/json; charset=UTF-8');
include('mysql_connect.php');
	date_default_timezone_set("Asia/Taipei");
	$DateTime_Now = gmdate("Y-m-d H:i:s"); //取回伺服器 GMT 標準時間
	$DataTime_Begin = "1970-01-01 00:00:00"; //設定時間起始格式
	$TimeSpan = (strtotime($DateTime_Now) - strtotime($DataTime_Begin)) * 1000;
	$sql="SELECT SingResult From Mic Order by Mic_ID DESC";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_row($result);
	echo json_encode(array('TimeSpan' => $TimeSpan ,'SingResult'=>$row[0]));
		return;
?>