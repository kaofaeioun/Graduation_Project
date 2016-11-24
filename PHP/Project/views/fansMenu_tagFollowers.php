<?php
	include('mysql_connect.php');
	if (!isset($_COOKIE['account'])) {
		echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/fansMenu.css">
	<link rel="stylesheet" href="CSS/all.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type='text/javascript'>
	</script>
	<title>MicMusic</title>
</head>
<body>
	<script type="text/javascript">
		<?php include("mysql_connect.php");
			if(!isset($_COOKIE['account'])): ?>	
				location.replace("login.php");
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
                        return false;
                    });
                });
            </script>
			<div class="toolbar">
				<a href="login.php"><input type="button" id="login" value="登入"></a>
				<div class="user" id="user">
					<script type="text/javascript">
                        document.getElementById("user").style.backgroundImage = "url('photo.php?id=<?php echo $id;?>')";
                    </script>
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
			<h2>追蹤名單/Followers</h2>
				
			<div class="clear"></div>

			
			<div class="list">
				<ul>
					<?php
						$now = $_GET['name'];
						$sql = "SELECT Tracked_ID FROM Track where Track_ID = '$now' order by Tracked_ID";
						$result=mysqli_query($link,$sql);
						$row2=mysqli_num_rows($result);
						for ($i = 0; $i < $row2; $i++) { 

							$row=mysqli_fetch_row($result);
							echo "
							<li>
							<a>
							<div class='userimg'>
								<a href='fans.php?name=".$row[0]."'>
									<img src='photo.php?id=".$row[0]."''>
								</a>
							</div>
							<div class='userid'>
								<a href='fans.php?name=".$row[0]."'>" .$row[0]."
									</a>
							</div>
							<a>
							</li>
								
								";

							}


					?>
						<div class='clear'></div>


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