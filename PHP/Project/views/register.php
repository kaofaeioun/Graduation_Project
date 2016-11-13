<!DOCTYPE html>
<?php
	include('mysql_connect.php');
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="http://fonts.googleapis.com/css?family=Cabin:400,500,600,bold" rel="stylesheet" type="text/css" >
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,bold" rel="stylesheet" type="text/css" >
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/register.css">
	<link rel="stylesheet" href="CSS/all.css">
	<title>MicMusic</title>
</head>
<body>

	<div class="wrap">
		<div class="header">
			<h1><img src="image/Logo2.png"></h1>
			
			<div class="toolbar">
				<div class="search">
					<input type="text" class="search_blank" placeholder="輸入ID找歌手">
					<input type="image" class="search_image" src="image/search.png">
				</div>
			</div>
			<div class="menu">
				<ul>
					<li><a href="battle.php"><img src="image/menu_battle.png" width="15%">  &nbsp<b>大亂鬥</b></a></li>
					<li><a href="channel.php"><img src="image/menu_personal.png" width="15%"> &nbsp<b>個人頻道</b></a></li>
					<li><a href="personalinfo.php"><img src="image/menu_person_info.png" width="15%"> &nbsp<b>我的資料</b></a></li>
					<li><a href="setting.php"><img src="image/menu_setting.png" width="15%"> &nbsp<b>設定</b></a></li>
				</ul>
			</div>
		</div>
	</div><hr>
	<div class="wrap">
		<div id="content">
			<h2>註冊<b>/</b><br>Register</h2>
			<div class="photo">
				<img id="userimg" src="image/user_image.png">					
					<span class="upload_area"><img src="image/camera.png" width="28px" height="25px" style="padding-top: 4px">&nbsp 更換大頭貼照</span>
					<input type="file" id="upload" onchange="loadImageFile();"/>
			</div>

				<script type="text/javascript">
					oFReader = new FileReader(), rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

					oFReader.onload = function (oFREvent) {
					  document.getElementById("userimg").src = oFREvent.target.result;
					};

					function loadImageFile() {
					  if (document.getElementById("upload").files.length === 0) { return; }
					  var oFile = document.getElementById("upload").files[0];
					  if (!rFilter.test(oFile.type)) { alert("You must select a valid image file!"); return; }
					  oFReader.readAsDataURL(oFile);
					}	
				</script>

				<div class="profile">
					<form action="" method="post">
					<ul>
						<li>
							<input type="text" class="name_blank" name="id" placeholder="請輸入用戶/ID">
						</li>
						<li>
							<input type="password" class="name_blank" name="pwd" placeholder="請輸入密碼/Password">
						</li>
						<li>
							<input type="password" class="name_blank" name="repwd" placeholder="確認密碼/Confirm Password">
						</li>
						<li>
							<input type="text" class="name_blank" name="name" placeholder="請輸入姓名/Name">
						</li>
						<li>
							<input type="text" class="name_blank" name="mail" placeholder="請輸入電子郵件/E-mail">
						</li>
						<li>
							<input type="text" class="name_blank" name="hobby" placeholder="請輸入興趣/Hobby(如:唱歌、運動)">
						</li>
						<li>
							<input type="text" class="name_blank" name="favsinger" placeholder="請輸入喜歡的歌手/Favorate Singer(如:羅百吉)">
						</li>
						<div id="msg"></div>
						<div class="clear"></div>	
						<button type="Submit" class="ctrl-standard typ-subhed fx-sliderIn" id="sub">Submit</button>
					</ul>
					</form>
<?php
	if (isset($_POST['id'])&&isset($_POST['pwd'])&&isset($_POST['repwd'])&&isset($_POST['name'])&&isset($_POST['mail'])&&isset($_POST['hobby'])&&isset($_POST['favsinger'])) { 
			$id = $_POST['id'];
			$pwd = $_POST['pwd'];
			$repwd = $_POST['repwd'];
			$name = $_POST['name'];
			$mail = $_POST['mail'];
			$hobby = $_POST['hobby'];
			$favsinger = $_POST['favsinger'];

			$sql = "SELECT * FROM User where User_ID = '$id'";
			$result = mysqli_query($link,$sql);
			$row = mysqli_fetch_row($result);
			if($row[0] == $id ){
				echo "<script>document.getElementById('msg').innerHTML = ('此帳號已有人使用過!')</script>";
				echo "<script>alert('此帳號已有人使用過!')</script>";
			}
			else if($pwd!=$repwd){ 
	      	 	echo "<script>document.getElementById('msg').innerHTML = ('確認密碼錯誤!')</script>";
	      	 	echo "<script>alert('確認密碼錯誤!')</script>";
			}
			else{
				$sql2="INSERT INTO `User`(User_ID,User_PWD,User_Name,Email,Hobby,Fav_Singer) VALUES($id,$pwd,$name,$mail,$hobby,$favsinger)";
				$result2=mysqli_query($link,$sql2);
				echo "<script>document.getElementById('msg').innerHTML = ('註冊成功!')</script>";
				echo "<script>alert('註冊成功!')</script>";
			}
		}
?>
				</div>
			<div class="clear"></div>
		</div>	
	</div>

	<div class="footer_space">
	<footer>
		<h3>MicMusic</h3>
		<p>© 2016 All rights reserved.</p>
		<p>NUKIM 106專題開發</p>
		<ul>
			<li><a href="battle.php"><img src="image/menu_battle.png"></a></li>
			<li><a href="channel.php"><img src="image/personal.png"></a></li>
			<li><a href="personalinfo.php"><img src="image/person_info_chosen.png"></a></li>
			<li><a href="setting.php"><img src="image/setting.png"></a></li>
		</ul>
	</footer>
	</div>
</body>
</html>