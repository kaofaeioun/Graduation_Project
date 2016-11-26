<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/channel.css">
	<link rel="stylesheet" href="CSS/all.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"><!-- search -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  <!-- search -->
	<title>MicMusic</title>
</head>
<body>
	<script type="text/javascript">
		<?php include("mysql_connect.php");
			if(!isset($_COOKIE['account'])): ?>
				$(document).ready(function(){
					$('#login').show();
				});		
		<?php else: $id=$_COOKIE['account']; ?>			
			$(document).ready(function(){				
				$('#user').show();
			});
		<?php endif; ?>
	</script>
	
	<div class="wrap">
		<div class="header">
			<h1><img src="image/Logo2.png"></h1>
			<script type="text/javascript">
				$(document).ready(function(){
  					$('#user').click(function() { 
  						//指定呼叫按鈕
    					$('.user_info').fadeToggle(300);
    					//顯示隱藏的div
  					});
				});
			</script>
			<div class="toolbar">
				<a href="login.php"><input type="button" id="login" value="登入"></a>
			<div class="user" id="user">
				<img src="photo.php?id=<?php echo $id?>">
					<div class="user_info">
						<ul>
							<li><p>Rank</p><img src="image/medal.png"></li>
							<li><p>勝場數</p><b2>94</b2>場</li>
							<li><p>勝場率</p><b3>87</b3>%</li>
						</ul>
						<span class="arrow_bottom_int"></span>
						<span class="arrow_bottom_out"></span>
							<div class="bot_area">
								<input type="button" class="logout" value="登出"onclick="location='logoutconnect.php'">
							</div>			
					</div>
				</div>
				<div class="search">
					<form action="fans.php" method="GET" name="font1">
						<script>
						    $(function() {
						        $( "#searchinfo" ).autocomplete({
						            source: 'search1.php'
						        });
						    });
						</script>
						<input type="text" class="search_blank" placeholder="輸入ID找歌手" name="name" id="searchinfo">
						<input type="image" class="search_image" src="image/search.png" id="search_image">
						
					</form>
					
				</div>
			</div>
			<div class="menu">
				<ul>
					<a href="battle.php"><li><img src="image/menu_battle.png" width="15%">  &nbsp<b>大亂鬥</b></li></a>
					<li><a href="channel.php"><img src="image/menu_personal.png" width="15%"> &nbsp<b>個人頻道</b></a></li>
					<li><a href="personalinfo.php"><img src="image/menu_person_info.png" width="15%"> &nbsp<b>我的資料</b></a>
					</li>
					<li><a href="setting.php"><img src="image/menu_setting.png" width="15%"> &nbsp<b>設定</b></a></li>
				</ul>
			</div>
		</div>
	</div>
	<hr>
	<div class="wrap">
		<div id="content">
			<h2>熱門頻道<b>/</b><br>Popular Channel</h2>
			<div class="bar">
				<ul>
					<li><a href="personal_channel_1.php"><div class="bar_item" style="background: #20A4F3;"></div></a>在線人數：9527<br>收藏人數：666
					</li>
					<li><a href="#"><div class="bar_item" style="background: #FF3366;"></div></a>在線人數：8763<br>收藏人數：870
					</li>
					<li><a href="#"><div class="bar_item" style="background: #F9C22E;"></div></a>在線人數：6666<br>收藏人數：426
					</li>
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
			<li><a href="battle.php"><img src="image/menu_battle.png"></a></li>
			<li><a href="channel.php"><img src="image/personal_chosen.png"></a></li>
			<li><a href="personalinfo.php"><img src="image/person_info.png"></a></li>
			<li><a href="setting.php"><img src="image/setting.png"></a></li>
		</ul>
	</footer>
	</div>
</body>
</html>