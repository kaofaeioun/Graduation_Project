<?php
include("mysql_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="http://fonts.googleapis.com/css?family=Cabin:400,500,600,bold" rel="stylesheet" type="text/css" >
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,bold" rel="stylesheet" type="text/css" >
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/personalinfo.css">
	<link rel="stylesheet" href="CSS/all.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<title>MicMusic</title>
</head>
<body>
	<div class="wrap">
		<div class="header">
			<h1><img src="image/Logo2.png"></h1>
			<script type="text/javascript">
				$(document).ready(function(){
  					$('.user_info').hide(); 
  					//隱藏要呼叫的div
  					$('#user').click(function() { 
  						//指定呼叫按鈕
    					$('.user_info').fadeToggle(300);
    					//顯示隱藏的div
    					return false;
  					});
				});
			</script>
			<div class="toolbar">
				<div class="user" id="user">
					<div class="user_info">
						<ul>
							<li><p>Rank</p><img src="image/medal.png"></li>
							<li><p>勝場數</p><b2>94</b2>場</li>
							<li><p>勝場率</p><b3>87</b3>%</li>
						</ul>
						<span class="arrow_bottom_int"></span>
						<span class="arrow_bottom_out"></span>	
							<div class="bot_area">
								<input type="button" class="logout" value="登出">
							</div>		
					</div>
				</div>
				<div class="search">
					<input type="text" class="search_blank" placeholder="輸入id找歌手">
					<input type="image" class="search_image" src="image/search.png">
				</div>
			</div>
			<div class="menu">
				<ul>
					<li><a href="battle.html"><img src="image/menu_battle.png" width="15%">  &nbsp<b>大亂鬥</b></a></li>
					<li><a href="channel.html"><img src="image/menu_personal.png" width="15%"> &nbsp<b>個人頻道</b></a></li>
					<li><a href="personalinfo.php"><img src="image/menu_person_info.png" width="15%"> &nbsp<b>我的資料</b></a></li>
					<li><a href="setting.html"><img src="image/menu_setting.png" width="15%"> &nbsp<b>設定</b></a></li>
				</ul>
			</div>
		</div>
	</div>
	<hr>
	<?php
	$id=$_COOKIE['userid'];
	$sql = "SELECT * FROM User where User_ID = $id";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	$name=$row[2];
	$email=$row[3];
	$hobby=$row[4];
	$favsinger=$row[5];
	$level=$row[8];
	?>
	<div class="wrap">
		<div id="content">
			<h2>個人資料<b>/</b><br>Personal Infomation</h2>
				<div class="profile_pic"><img src="image/profilepic.jpg" alt=""></div>
				<div class="profile">
					<li>
							<ul id="track_list">
								<li><b>追蹤名單</b>
								<img src="image/track.png" alt=""><br>33
								</li>
								<li><b>粉絲名單</b>
								<img src="image/tracked.png" alt=""><br>87
								</li>
								<li><b>勝場數</b>
								<img src="image/win.png" alt=""><br>87
								</li>
							</ul>
						</li>	
					<ul>
						<li>
							<b>姓名/Name</b>
							<div class="name_blank"><?php echo $name; ?></div>
						</li>
						<li>
							<b>用戶/ID</b>
							<div class="name_blank"><?php echo $id; ?></div>
						</li>
						<li>
							<b>電子郵件/E-mail</b>
							<div class="name_blank"><?php echo $email; ?></div>
						</li>
						<li>
							<b>等級/Level</b>
							<div class="name_blank" ><?php echo $level; ?></div></li>
						<li>
							<b>興趣/Hobby</b>
							<div class="name_blank" ><?php echo $hobby; ?></div></li>
						<li>
							<b>喜歡的歌手/Favorate Singer</b>
							<div class="name_blank" ><?php echo $favsinger ;?></div></li>
						<div class="clear"></div>	
						
							
						<div class="clear"></div>
						
						<button class="ctrl-standard typ-subhed fx-sliderIn">Submit</button>

					</ul>
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
			<li><a href="personalinfo.html"><img src="image/person_info_chosen.png"></a></li>
			<li><a href="setting.html"><img src="image/setting.png"></a></li>
		</ul>
	</footer>
	</div>
</body>
</html>