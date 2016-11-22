<?php
follow();
function follow(){
	if(isset($_GET['Track_ID'])&& isset($_GET['Tracked_ID'])){
		include("mysql_connect.php");
		$id1=$_GET['Track_ID'];
		$id2=$_GET['Tracked_ID'];
		$sql="INSERT INTO Track (Track_ID,Tracked_ID)VALUES ('$id1', '$id2')";
		$result=mysqli_query($link, $sql);									
		}
	}
?>