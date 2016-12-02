<?php
	include ("mysql_connect.php");
	$id=$_GET['id'];
	$singer=$_GET['singer'];
	if($id==$singer){
	$sql="SELECT User_Loses From User Where User_ID='$id'" ; // 要改接收到的ID(演唱完畢)
	$result=mysqli_query($link,$sql);
	$point=mysqli_fetch_row($result);
	$point=$point[0]+1;
	$sql2="UPDATE User SET User_Loses='$point' WHERE User_ID='$id'";// 要改接收到的ID(演唱完畢)
	$result2=mysqli_query($link,$sql2);
}
?>