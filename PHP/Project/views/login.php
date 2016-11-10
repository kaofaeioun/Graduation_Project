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
	<link rel="stylesheet" href="CSS/login.css">
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
			<h2>登入<b>/</b><br>Login</h2>
				<div class="profile_pic"><img src="image/profilepic.jpg" alt=""></div>
				<div class="profile">
				
					<ul>
					<form method="post" action="">

						<li>
							<input type="text" class="name_blank" placeholder="請輸入用戶/ID" name="id" required="">
						</li>
						<li>
							<input type="password" class="name_blank" placeholder="請輸入密碼/Password" name="pwd" required="">
						</li>
						
						<div class="clear"></div>	
						

						<div class="clear"></div>
						<button type="submit" class="ctrl-standard typ-subhed fx-sliderIn" id ="sub">Submit</button>
					</form>
					</ul>
					
					<?php
					header("Content-Type: text/html; charset=utf-8");
  					if(isset($_POST['id'])&& isset($_POST['pwd'])){
		        		$account = $_POST['id'];
		    			$passwd = $_POST['pwd'];
    					//搜尋資料庫資料
		    			$sql = "SELECT * FROM User where User_ID =$account";
		    			$result = mysqli_query($link,$sql);
					 	if($row=mysqli_fetch_assoc($result)){
					 		if($row['User_PWD']==$passwd){
	        					setcookie('account',$account,time()+3600);
	        					echo '<meta http-equiv=REFRESH CONTENT=0;url=battle.html>';
	      					}else if($row['User_PWD']!=$passwd){
	        					echo "<script>alert('密碼錯誤！')</script>";
	      					}
	      				}	
	    				else{
	    					echo "<script>alert('無此帳號！')</script>";
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
			<li><a href="battle.html"><img src="image/menu_battle.png"></a></li>
			<li><a href="channel.html"><img src="image/personal.png"></a></li>
			<li><a href="personalinfo.php"><img src="image/person_info_chosen.png"></a></li>
			<li><a href="setting.html"><img src="image/setting.png"></a></li>
		</ul>
	</footer>
	</div>
</body>
</html>