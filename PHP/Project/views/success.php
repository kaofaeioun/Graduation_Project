<?php
	include('mysql_connect.php');
	$id=$_GET['id'];
	$singer=$_GET['singer'];
if($id==$singer){	
	date_default_timezone_set('Asia/Taipei');
	$delaytime= date("Y/m/d H:i:s",strtotime("+2 minute")); 
	$sql="UPDATE Mic SET `SingResult`='1',`EndTime`='$delaytime' where User_ID='$id'";
	$result=mysqli_query($link,$sql);
}	
?>