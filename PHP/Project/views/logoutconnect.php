<?php 
	include("mysql_connect.php");
	$user_now=$_COOKIE['account'];
	$sql="UPDATE User SET User_Status='0' WHERE User_ID='$user_now'";
	$result=mysqli_query($link,$sql);
?>

<?php 
	setcookie('account','',time()-3600);
	echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
?>

