<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type='text/javascript'>
	     	<?php
			follow();
			function follow(){
				if(isset($_GET['Track_name'])&& isset($_GET['Tracked_name'])){
						include("mysql_connect.php");
						$id1=$_GET['Track_name'];
						$id2=$_GET['Tracked_name'];
						$sql="INSERT INTO Track (Track_Name,Tracked_Name)VALUES ('$id1', '$id2')";
						$result=mysqli_query($link, $sql);									
				}
			}
			?>
	</script>
</head>
<body>
</body>
</html>