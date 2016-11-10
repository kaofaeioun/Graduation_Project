<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet"href="CSS/personal_channel_1.css">
	<link rel="stylesheet" href="CSS/all.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
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
				<div class="user" id="user">
					<a href="login.php"><input type="button" id="login" value="登入"></a>
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
					<input type="image" class="search_image" src="image/search.png" alt="submit">
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
			<b1><h2>Asia God Tone 的房間</h2></b1>
			<div class="main">
				<div class="personal_area">
					<div class="board">
						<div class="tool_bar">
							<li><a><img src="image/shape.png" original title="素材庫" onclick=""></a></li>
							<li><a><img src="image/photo.png" original title="匯入圖片"></a></li>
							<li><a><img src="image/text.png" original title="字型樣式"></a></li>
						</div>
						<div class="clear"></div>
					</div>

					<script type="text/javascript">
						$(document).ready(function(){
  							$('.square').hide(); 
  							//隱藏要呼叫的div
  							$('#pic').click(function() { 
  								//指定呼叫按鈕
    							$('.square').fadeToggle(500);
    							//顯示隱藏的div
    							$('.square').delay(800).fadeOut(500);
  							});
						});
					</script>

					<script>
						function changeSrc(){
							var imgObj = document.getElementById("pic");
							if (imgObj.getAttribute("src",2) == "image/cancerlike.png"){
	  							imgObj.src = "image/like.png";
							}
							else{
								imgObj.src = "image/cancerlike.png";
							}
						}
					</script>

					<div class="track">
						<div class="square">
							<span class="arrow_top_int"></span>
							追蹤成功!
						</div>
						<img src="image/cancerlike.png" original title="我要追蹤" id="pic" onclick="changeSrc()">咭咭三比靈
					</div>
					<div class="personal_info">
						<li><img src="image/watcher.png" original title="目前觀看人數">8888</li>
						<li><img src="image/like.png" original title="追蹤人數">87</li>
					</div>
				</div>

				<div class="clear"></div>

				<div class="chatroom">

				</div>
				<input type="text" placeholder="留言......" class="reply"></input>
			</div>
		</div>	
	</div>
	<div class="footer_space">
		<footer>
			<h3>MicMusic</h3>
			<p>© 2016 All rights reserved.</p>
			<p>NUKIM 106專題開發</p>
			<ul>
				<li><a href="battle.php"><img src="image/battle.png"></a></li>
				<li><a href="channel.php"><img src="image/personal_chosen.png"></a></li>
				<li><a href="personalinfo.php"><img src="image/person_info.png"></a></li>
				<li><a href="setting.php"><img src="image/setting.png"></a></li>
			</ul>
		</footer>
	</div>
	</body>
</html>