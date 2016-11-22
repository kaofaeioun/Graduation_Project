<?php
search();
function search(){
	if(isset($_GET['Track_ID'])&&isset($_GET['Tracked_ID'])){
		include("mysql_connect.php");
		$id1=$_GET['Track_ID'];
		$id2=$_GET['Tracked_ID'];
		$sql="DELETE From Track Where Track_ID='$id1' && Tracked_ID='$id2'";
		$result=mysqli_query($link, $sql);
	}	
}
?>