<?php
	include('mysql_connect.php');
	$id=$_GET['id'];
	$singer=$_GET['singer'];
if($id==$singer){
	$sql1="SELECT SingResult From Mic WHERE User_ID='$id'";
	$result1=mysqli_query($link,$sql1);
	$row=mysqli_fetch_row($result1);
	if($row[0]==0){	 
		$sql2="UPDATE Mic SET `SingResult`='2' where User_ID='$id'";
		$result2=mysqli_query($link,$sql2);
	}
	elseif($row[0]==2){
		$sql3="UPDATE Mic SET `SingResult`='1' where User_ID='$id'";
		$result3=mysqli_query($link,$sql3);
	}
}		
?>