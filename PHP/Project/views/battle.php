
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/battle.css">
	<link rel="stylesheet" href="CSS/all.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<title>MicMusic</title>
</head>
<body onunload="if(event.clientY<0) document.location=document.location.href">
	<script type="text/javascript">
		<?php include("mysql_connect.php");
			if(!isset($_COOKIE['account'])): ?>
				$(document).ready(function(){
					$('#user').hide();
					$('#login').show();
				});		
		<?php else: ?>
			$(document).ready(function(){
				$('#user').show();
				$('#login').hide();
			});
		<?php endif; ?>
	</script>
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
				<a href="login.php"><input type="button" id="login" value="登入"></a>
				<div id="user">
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
	</div>
	<hr>
	<div class="wrap">
		<div id="content">
			<h2>大亂鬥頻道選擇<b>/</b><br>Battle Choice</h2>
			<div class="bar">
				<ul>
					<li><a href="battle_channel_1.php"><div class="battle_channel" style="background: #FF2D2D;"></div></a><p>頻道1</p>目前人次：9527<br>排麥人數：33</li>
					<li><a href=""><div class="battle_channel" style="background: #0080FF;"></div></a><p>頻道2</p>目前人數：8763<br>收藏人數：27</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="footer_space">
		<footer>
				<h3>MicMusic</h3>
				<p>© 2016 All rights reserved.</p>
				<p>NUKIM 106專題開發</p>
				<ul>
			<li><a href="battle.php"><img src="image/battle_chosen.png"></a></li>
			<li><a href="channel.php"><img src="image/personal.png"></a></li>
			<li><a href="personalinfo.php"><img src="image/person_info.png"></a></li>
			<li><a href="setting.php"><img src="image/setting.png"></a></li>
			</ul>
		</footer>
	</div>
</body>
</html>