<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="http://fonts.googleapis.com/css?family=Cabin:400,500,600,bold" rel="stylesheet" type="text/css" >
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,bold" rel="stylesheet" type="text/css" >
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/fans.css">
	<link rel="stylesheet" href="CSS/all.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type='text/javascript'>
		document.createElement("b1")
	</script>
	<title>MicMusic</title>
</head>
<body>
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
			<div class="topbar">
				<div class="leftbar">
					<ul>
						<li id="info">ID<div class="blank">AREYOUOK</div></li>
						<li id="info">名字<div class="blank">洋洋</div></li>
						
					</ul>
				</div>
				<div class="rightbar">
					<img src="image/profilepic.jpg" alt="">
					<div class="trackbutton">
						<input type="checkbox">	
					</div>					
				</div>
				<div class="clear"></div>
			</div>
			<ul id="track_list">
				<li>
					<a href="">追蹤名單<img src="image/track.png" alt="">33</a>
				</li>
				<li>
					<a href="">粉絲名單<img src="image/tracked.png" alt="">87</a>
				</li>
				<li>勝場數<img src="image/win.png" alt="">87
				</li>						
			</ul>

			<div class="downbar">
				<ul>	
					<li>
						<p>興趣</p>
						<div class="blankz">想要裝文青愛看書
						但是看到密密麻麻又沒有劇情的就會睡著天生吃貨一個喜歡四處遊蕩吃喝玩樂對美食有厲害的雷達應該算是專長哈哈哈</div>
					</li>
					<div class="clear"></div>
					<li>
						<p>喜歡的歌</p>
						<div class="blankz">可以吃喝玩樂跟老師喇咧的課啊~♡</div>
					</li>
					<div class="clear"></div>
					<li>
						<p>喜歡的歌手</p>
						<div class="blankz">想要環遊世界想要把全世界的美景都看完想要沒有煩惱想要一個不會低潮的宣宣想要有一個安全感。</div>
					</li>
					<div class="clear"></div>
					<li>
						<p>擅長歌路</p>
						<div class="blankz">天生公關料最厲害的就是喇咧跟屁話~</div>
					</li>
					<div class="clear"></div>
					<li>
						<p>Level</p>
						<div class="blankz">13</div>
					</li>

				</ul>
			</div>
		</div>	
	</div>

	<!-- 11111111111111111111111111111111111111111111 -->
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