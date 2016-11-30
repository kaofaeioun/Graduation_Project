<?php
	include ("mysql_connect.php");
	// $id=$_GET  // 要改接收到的ID(演唱完畢)
	$sql="SELECT User_Wins From User WHERE User_Id='$id'"; // 要改接收到的ID(演唱完畢)
	$result=mysqli_query($link,$sql);
	$point=mysqli_fetch_row($result);
	$point=$point[0]+1;
	$sql2="UPDATE User SET User_Wins='$point' WHERE User_Id='$id'";// 要改接收到的ID(演唱完畢)
	$result2=mysqli_query($link,$sql2);

	$result=mysqli_query($link,$sql);
	$point=mysqli_fetch_row($result);
	$p=$point[0];
	if ($p<1) {
		$sql="UPDATE User SET Level='無階級' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=3) {
		$sql="UPDATE User SET Level='銅MIC I' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=5) {
		$sql="UPDATE User SET Level='銅MIC II' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=8) {
		$sql="UPDATE User SET Level='銅MIC III' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=17) {
		$sql="UPDATE User SET Level='銀Mic I' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=26) {
		$sql="UPDATE User SET Level='銀Mic II' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=50) {
		$sql="UPDATE User SET Level='銀Mic III' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=61) {
		$sql="UPDATE User SET Level='金Mic I' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=72) {
		$sql="UPDATE User SET Level='金Mic II' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=90) {
		$sql="UPDATE User SET Level='金Mic III' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=110) {
		$sql="UPDATE User SET Level='白金Mic I' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=130) {
		$sql="UPDATE User SET Level='白金Mic II' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=180) {
		$sql="UPDATE User SET Level='白金Mic III' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=240) {
		$sql="UPDATE User SET Level='鑽石Mic I' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($p<=300){
		$sql="UPDATE User SET Level='鑽石Mic II' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}else{
		$sql="UPDATE User SET Level='鑽石Mic III' WHERE User_Id='$id'";
		$result=mysqli_query($link,$sql);
	}
?>