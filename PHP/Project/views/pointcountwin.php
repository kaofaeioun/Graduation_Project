<?php
	include ("mysql_connect.php");
	$id=$_GET['id'];
	$singer=$_GET['singer'];
if($id==$singer){	
	$sql="SELECT User_Wins From User WHERE User_ID='$id'";
	$result=mysqli_query($link,$sql);
	$point=mysqli_fetch_row($result);
	$point=$point[0]+1;
	$sql2="UPDATE User SET User_Wins='$point' WHERE User_ID='$id'";
	$result2=mysqli_query($link,$sql2); 
	if ($point<1) {
		$sql="UPDATE User SET Level='無階級' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=3) {
		$sql="UPDATE User SET Level='銅MIC I' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=5) {
		$sql="UPDATE User SET Level='銅MIC II' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=8) {
		$sql="UPDATE User SET Level='銅MIC III' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=17) {
		$sql="UPDATE User SET Level='銀Mic I' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=26) {
		$sql="UPDATE User SET Level='銀Mic II' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=50) {
		$sql="UPDATE User SET Level='銀Mic III' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=61) {
		$sql="UPDATE User SET Level='金Mic I' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=72) {
		$sql="UPDATE User SET Level='金Mic II' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=90) {
		$sql="UPDATE User SET Level='金Mic III' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=110) {
		$sql="UPDATE User SET Level='白金Mic I' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=130) {
		$sql="UPDATE User SET Level='白金Mic II' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=180) {
		$sql="UPDATE User SET Level='白金Mic III' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=240) {
		$sql="UPDATE User SET Level='鑽石Mic I' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}elseif ($point<=300){
		$sql="UPDATE User SET Level='鑽石Mic II' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}else{
		$sql="UPDATE User SET Level='鑽石Mic III' WHERE User_ID='$id'";
		$result=mysqli_query($link,$sql);
	}
}	
?>