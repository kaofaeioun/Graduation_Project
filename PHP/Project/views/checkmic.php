<?php 
	include("mysql_connect.php");
	$sql2="Delete From Mic where Mic_ID = (select min(Mic_ID) from (select * from Mic) as B) ";
	$result2=mysql_query($sql2);			
?>