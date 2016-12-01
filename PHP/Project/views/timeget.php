<?php
	include('mysql_connect.php');
	$singer=$_GET['singer'];
	$sql="SELECT EndTime from Mic where User_ID='$singer'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_row($result);
	if($row[0]){
		$a=$row[0];
		$b=strftime("%Y/%m/%d %H:%i:%s");
		$c=strtotime($a) - strtotime($c);
		echo json_encode(array('TimeNow1' => $c));
		return;
	}
?>