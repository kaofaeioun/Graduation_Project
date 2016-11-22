<?php
	include("mysql_connect.php");
	if (!isset($_COOKIE['account'])) {
		echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
	}
?>		
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
				location.replace("login.php");
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
  					$('#user').click(function() { 
    					$('.user_info').fadeToggle(300);
    					return false;
  					});
				});
			</script>
			<script type="text/javascript">
				<?php if ($_COOKIE['account'] == $_GET['name']): ?>
					$(document).ready(function(){
						$('.trackbutton').hide();
					});
				<?php endif; ?>
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
								<input type="button" class="logout" value="登出"
								onclick="location='logoutconnect.php'">
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
						<?php
							if (isset($_GET['name'])) {
								$an = $_GET['name'];
								$sql= "SELECT * FROM User where User_ID = '$an'";
								$result = mysqli_query($link,$sql);
								$row = mysqli_fetch_assoc($result);
							}
						echo "
						<li id='info'>ID<div class='blank'>".$row['User_ID']."</div></li>
						<li id='info'>名字<div class='blank'>".$row['User_Name']."</div></li>
						
						";
						?>
					</ul>
				</div>
				<div class="rightbar">
					<img src="photo.php?id=<?php echo $row['User_ID'];?>" alt="">
					<?php
						$usernow = $_COOKIE['account'];
						$an = $_GET['name'];
						$sql = "SELECT Track_time FROM Track where Track_ID='$usernow' && Tracked_ID='$an'";
						$result = mysqli_query($link,$sql);
						$row = mysqli_fetch_row($result);
						if (isset($row[0])) {
							echo "
								<div class='trackbutton' >
									<input type='checkbox' id='followed' checked>
								</div>
							";
						}else{
							echo "
								<div class='trackbutton' >
									<input type='checkbox' id='follow'>
								</div>
							";
						}						
					?>
					<script type="text/javascript">
							$( document ).on( "click", "#followed", function() {
  									
  								var request = new XMLHttpRequest();
							    request.open("GET", "followcancel.php?Track_ID=<?php echo $usernow;?>&Tracked_ID=<?php echo $an;?>");
							    request.send();
							    $('#followed').attr('id','follow');		
								});
							$( document ).on( "click", "#follow", function() {
  								var request = new XMLHttpRequest();
							    request.open("GET", "follow.php?Track_ID=<?php echo $usernow;?>&Tracked_ID=<?php echo $an;?>");
							    request.send();
							    $('#follow').attr('id','followed');
								});
					</script>
				</div>
				<div class="clear"></div>
			</div>
			<ul id="track_list">
				<li>
					<?php 
						$an = $_GET['name'];
						echo "<a href='fansMenu_tagFollowers.php?name=".$an."'>追蹤名單<img src='image/track.png' >";
						$sql = "SELECT COUNT(Track_ID) as total FROM Track where Track_ID='$an'";
						$result = mysqli_query($link,$sql);
						$row2 = mysqli_fetch_assoc($result);
						echo $row2['total'];
						echo "</a>";
					?>
					
				</li>
				<li>
					<?php
						$an = $_GET['name'];
						echo "<a href='fansMenu_tagFans.php?name=".$an."'>粉絲名單<img src='image/tracked.png' >";
						
							$sql = "SELECT COUNT(DISTINCT Track_ID) as total FROM Track where Tracked_ID='$an'";
							$result = mysqli_query($link,$sql);
							$row2 = mysqli_fetch_assoc($result);
							echo $row2['total'];
					?>
					</a>
				</li>
				<li>勝場數<img src="image/win.png" alt="">87
				</li>						
			</ul>

			<div class="downbar">
				<ul>	
					<?php
							if (isset($_GET['name'])) {
								$an = $_GET['name'];
								$sql= "SELECT * FROM User where User_ID = '$an'";
								$result = mysqli_query($link,$sql);
								$row = mysqli_fetch_assoc($result);
							}
							
						echo "
						<li>
							<p>興趣</p>
							<div class='blankz'>".$row['Hobby']."</div>
						</li>

						<li>
							<p>喜歡的歌</p>
							<div class='blankz'>".$row['Fav_Songs']."</div>
						</li>

						<li>
							<p>喜歡的歌手</p>
							<div class='blankz'>".$row['Fav_Singer']."</div>
						</li>

						<li>
							<p>Level</p>
							<div class='blankz'>".$row['Level']."</div>
						</li>

						<div class='clear'></div>
						";
					?>
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