<?php
	header('Content-Type: application/json; charset=UTF-8');
	date_default_timezone_set("Asia/Taipei");
	$DateTime_Now = gmdate("Y-m-d H:i:s"); //取回伺服器 GMT 標準時間
	$DataTime_Begin = "1970-01-01 00:00:00"; //設定時間起始格式
	$TimeSpan = (strtotime($DateTime_Now) - strtotime($DataTime_Begin)) * 1000;
	echo json_encode(array('TimeSpan' => $TimeSpan));
		return;
?>