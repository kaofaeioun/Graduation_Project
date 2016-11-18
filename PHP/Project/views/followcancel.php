<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type='text/javascript'>
	   		<?php
			search();
			function search(){
				if(isset($_GET['Track_name'])&&isset($_GET['Tracked_name'])){
						include("mysql_connect.php");
						$id1=$_GET['Track_name'];
						$id2=$_GET['Tracked_name'];
						$sql="DELETE From Track Where Track_Name='$id1' && Tracked_Name='$id2'";
						$result=mysqli_query($link, $sql);
				}
				
			}
			?>
	   }
	</script>
</head>
<body>
</body>
</html>