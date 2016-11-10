<!DOCTYPE html>
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
			<h1><div class="Logo"><img src="image/Logo2.png"></div></h1>
			<div class="menu">
				<div class="search">
					<input type="text" class="search_blank" placeholder="輸入id找歌手">
					<input type="image" class="search_image" src="image/search.png">
				</div>
				<br>
				<ul>
					<li><a href="battle.html"><img src="image/menu_battle.png" width="15%">  &nbsp<b>大亂鬥</b></a></li>
					<li><a href="channel.html"><img src="image/menu_personal.png" width="15%"> &nbsp<b>個人頻道</b></a></li>
					<li><a href="personalinfo.php"><img src="image/menu_person_info.png" width="15%"> &nbsp<b>我的資料</b></a></li>
					<li><a href="setting.html"><img src="image/menu_setting.png" width="15%"> &nbsp<b>設定</b></a></li>
				</ul>
			</div>

		</div>
	</div><hr>
	<div class="wrap">
		<div id="content">
			<h2>註冊<b>/</b><br>Register</h2>
				<div class="profile_pic"><img src="image/profilepic.jpg" alt=""></div>
				<div class="profile">
					<form action="" method="post">
					<ul>
						<li>
							<input type="text" class="name_blank" id="id" placeholder="請輸入用戶/ID" required="">
						</li>
						<li>
							<input type="password" class="name_blank" id="pwd" placeholder="請輸入密碼/Password" required="">
						</li>
						<li>
							<input type="password" class="name_blank" id="repwd" placeholder="確認密碼/Confirm Password" required="">
						</li>
						<li>
							<input type="text" class="name_blank" id="name" placeholder="請輸入姓名/Name" required="">
						</li>
						<li>
							<input type="text" class="name_blank" id="mail" placeholder="請輸入電子郵件/E-mail" required="">
						</li>
						<li>
							<input type="text" class="name_blank" id="hobby" placeholder="請輸入興趣/Hobby(如:唱歌、運動)" required="">
						</li>
						<li>
							<input type="text" class="name_blank" id="favsinger" placeholder="請輸入喜歡的歌手/Favorate Singer(如:羅百吉)" required="">
						</li>
						<div class="clear"></div>	
						
							
						<div class="clear"></div>
						
						<button class="ctrl-standard typ-subhed fx-sliderIn" id="sub">Submit</button>
						<p id="submitresult"></p>
					</ul>
					</form>
				</div>
			<div class="clear"></div>
		</div>	
	</div>
<?php
	header('Content-Type: application/json; charset=UTF-8');
	include("mysql_connect.php");
	if (isset($_POST['id'])&&isset($_POST['pwd'])&&isset($_POST['repwd'])&&isset($_POST['name'])&&isset($_POST['mail'])&&isset($_POST['hobby'])&&isset($_POST['favsinger'])) { 

		$id = $_POST['id'];
		$pwd = $_POST['pwd'];
		$repwd = $_POST['repwd'];
		$name = $_POST['name'];
		$mail = $_POST['mail'];
		$hobby = $_POST['hobby'];
		$favsinger = $_POST['favsinger'];

		$sql = "SELECT * FROM User where User_ID = $id";
		$result = mysqli_query($sql);
		$row = mysqli_fetch_row($result);
		if($row[0] == $id ){
			echo '此帳戶已有人用過！';
		}
		else if($pwd!=$repwd){ 
      	 	echo '再次確認密碼！';
		}
		else{
			$sql2="INSERT INTO `User`(User_ID,User_PWD,User_Name,Email,Hobby,Fav_Singer) VALUES($id,$pwd,$name,$mail,$hobby,$favsinger)";
			$result2=mysqli_query($link,$sql2);
		}

	}

?>
	<div class="footer_space">
	<footer>
		<h3>MicMusic</h3>
		<p>© 2016 All rights reserved.</p>
		<p>NUKIM 106專題開發</p>
		<ul>
			<li><a href="battle.html"><img src="image/menu_battle.png"></a></li>
			<li><a href="channel.html"><img src="image/personal.png"></a></li>
			<li><a href="personalinfo.php"><img src="image/person_info_chosen.png"></a></li>
			<li><a href="setting.html"><img src="image/setting.png"></a></li>
		</ul>
	</footer>
	</div>
</body>
</html>