<?php
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    MicArrange();
   }
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    MicCancel();
   }     
function MicArrange(){
include("mysql_connect.php");	
	$id=$_COOKIE['account'];
	$sql = "SELECT User_ID FROM Mic where User_ID = '$id'";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_row($result);
if(isset($id)&&$row[0]==null){
		$sql1="INSERT INTO Mic(User_ID,Battle_ID) values('$id','1')";
		$result1=mysqli_query($link,$sql1);
		$sql2="SELECT count(Mic_ID) FROM Mic where Mic_ID is not null";
		$result2=mysqli_query($link,$sql2);
		$row2=mysqli_fetch_row($result2);
		echo json_encode(array('Count_A' => $row2[0]));
        return;  
	}
}
function MicCancel(){
		include("mysql_connect.php");	
		$id=$_COOKIE['account'];
		$sql3="DELETE from Mic where User_ID='$id'";
		$result3=mysqli_query($link,$sql3);
		$sql4="SELECT count(Mic_ID) FROM Mic where Mic_ID is not null";
		$result4=mysqli_query($link,$sql4);
		$row4=mysqli_fetch_row($result4);
		echo json_encode(array('Count_B' => $row4[0]));
	    return;  
}
?>