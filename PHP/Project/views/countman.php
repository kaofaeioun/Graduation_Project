<?php			
header('Content-Type: application/json; charset=UTF-8');
include ("mysql_connect.php");			
 		
		date_default_timezone_set('Asia/Taipei');
		$t = date("Y/m/d H:i:s");
		$AT = strtotime($t)-300;
		$t = date("Y/m/d H:i:s" ,$AT);
		$sql="SELECT COUNT(User_ID) FROM UserStatus WHERE Status_Time > '$t'";
		$result=mysqli_query($link,$sql);
		$row1=mysqli_fetch_row($result);

		echo json_encode(array('msg'=>$row1[0]));
		return;
?>