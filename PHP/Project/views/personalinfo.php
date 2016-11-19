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
								<input type="button" class="logout" value="登出"onclick="location='logoutconnect.php'">
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
					<li><a href="battle.php"><img src="image/menu_battle.png" width="15%">  &nbsp<b>大亂鬥</b></a></li>
					<li><a href="channel.php"><img src="image/menu_personal.png" width="15%"> &nbsp<b>個人頻道</b></a></li>
					<li><a href="personalinfo.php"><img src="image/menu_person_info.png" width="15%"> &nbsp<b>我的資料</b></a></li>
					<li><a href="setting.php"><img src="image/menu_setting.png" width="15%"> &nbsp<b>設定</b></a></li>
				</ul>
			</div>
		</div>
	</div>
	<hr>
	<?php
		header("Content-Type: text/html; charset=utf-8");
		if(isset($_COOKIE['account'])){
		$id=$_COOKIE['account'];
		$sql = "SELECT * FROM User where User_ID = '$id'";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_row($result);
		$name=$row[2];
		$email=$row[3];
		$hobby=$row[4];
		$favsong=$row[5];
		$favsinger=$row[6];
		$level=$row[9];
	}
	?>
	<div class="wrap">
		<div id="content">
			<h2>個人資料<b>/</b><br>Personal Infomation</h2>
				<div class="profile_pic"><img src="photo.php?id=<?php echo $id?>" alt=""></div>
				<div class="profile">
					<li>
							<ul id="track_list">
								<li>
									<a href="fansMenu_Followers.php"><b>追蹤名單</b>
									<img src="image/track.png" alt=""><br>
									<?php
										$sql2="SELECT COUNT(Track_name) as total FROM Track where Track_name='$id'";
										$trackresult = mysqli_query($link,$sql2);
										$row2 = mysqli_fetch_assoc($trackresult);
										echo $row2['total'];
									?>
									
								</li>

								<li>
									<a href="fansMenu_Fans.php"><b>粉絲名單</b>
									<img src="image/tracked.png" alt=""><br>
									<?php
										$sql2="SELECT COUNT(Track_name) as total FROM Track where Tracked_name='$id'";
										$trackresult = mysqli_query($link,$sql2);
										$row2 = mysqli_fetch_assoc($trackresult);
										echo $row2['total'];
									?>
									</a>
								</li>
								<li><b>勝場數</b>
								<img src="image/win.png" alt=""><br>87
								</li>
							</ul>
						</li>
					<ul>
					<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666 -->
						<script>
							$(document).ready(function(){
							    $("#change").click(function(){
							        $("#changename").slideToggle("slow");
							    });
							});
						</script>
						<li>
							<b>姓名/Name</b>
							<div class="name_blank" id="showName"><?php echo $name; ?><img id="change" src="image/pen.png" alt=""></div>
						</li>
						<li id="changename">
							<b>修改姓名/Edit Name:</b>
							<div id="change_name_blank">
							<form>
									<input type="text" id="correctinfo" value=<?php echo $name; ?>>
									<input type="submit" id="changeinfoName" value="確定修改">
							
							</form>		
							<script type="text/JavaScript">
									document.getElementById("changeinfoName").onclick = function() {
											var request = new XMLHttpRequest();
											request.open("GET", "changeinfo.php?changed=User_Name&correctinfo="+ document.getElementById("correctinfo").value);
												request.send();
 									document.getElementById("showName").innerHTML=document.getElementById("correctinfo").value;
											}
							</script>

							</div>
						</li>
						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666 -->
						<li>
							<b>用戶/ID</b>
							<div class="name_blank"><?php echo $id; ?></div>
						</li>
						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666 -->
						<script>
							$(document).ready(function(){
							    $("#change1").click(function(){
							        $("#changeemail").slideToggle("slow");
							    });
							});
						</script>
						<li>
							<b>電子郵件/E-mail</b>
							<div class="name_blank" id="showemail"><?php echo $email; ?><img id="change1" src="image/pen.png" alt=""></div>
						</li>
						<li id="changeemail">
							<b>修改電子郵件/Edit E-mail:</b>
							<div id="change_name_blank">
							<form>
									<input type="text" id="correctinfoEmail" value=<?php echo $email; ?>>
									<input type="submit" id="changeinfoEmail" value="確定修改">
							
							</form>		
							<script type="text/JavaScript">
									document.getElementById("changeinfoEmail").onclick = function() {
											var request = new XMLHttpRequest();
											request.open("GET", "changeinfo.php?changed=Email&correctinfo="+ document.getElementById("correctinfoEmail").value);
												request.send();
 									document.getElementById("showemail").innerHTML=document.getElementById("correctinfoEmail").value;
											}
							</script>

							</div>
						</li>

						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666 -->
						<script>
							$(document).ready(function(){
							    $("#change2").click(function(){
							        $("#changeHobby").slideToggle("slow");
							    });
							});
						</script>
						<li>
							<b>興趣/Hobby</b>
							<div class="name_blank" id="showHobby"><?php echo $hobby; ?><img id="change2" src="image/pen.png" alt=""></div>
						</li>
						<li id="changeHobby">
							<b>修改興趣/Edit Hobby:</b>
							<div id="change_name_blank">
							<form>
									<input type="text" id="correctinfoHobby" value=<?php echo $hobby; ?>>
									<input type="submit" id="changeinfoHobby" value="確定修改">
							
							</form>		
							<script type="text/JavaScript">
									document.getElementById("changeinfoHobby").onclick = function() {
											var request = new XMLHttpRequest();
											request.open("GET", "changeinfo.php?changed=Hobby&correctinfo="+ document.getElementById("correctinfoHobby").value);
												request.send();
 									document.getElementById("showHobby").innerHTML=document.getElementById("correctinfoHobby").value;
											}
							</script>

							</div>
						</li>
						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666- -->
						<script>
							$(document).ready(function(){
							    $("#change3").click(function(){
							        $("#changeFavSinger").slideToggle("slow");
							    });
							});
						</script>
						<li>
							<b>喜歡的歌手/Favorate Singer</b>
							<div class="name_blank" id="showFavSinger"><?php echo $favsinger;?><img id="change3" src="image/pen.png" alt=""></div>
						</li>
						<li id="changeFavSinger">
							<b>修改喜歡的歌手/Edit Favorate Singer:</b>
							<div id="change_name_blank">
							<form>
									<input type="text" id="correctinfoFavSinger" value=<?php echo $favsinger;?>>
									<input type="submit" id="changeinfoFavSinger" value="確定修改">
							
							</form>		
							<script type="text/JavaScript">
									document.getElementById("changeinfoFavSinger").onclick = function() {
											var request = new XMLHttpRequest();
											request.open("GET", "changeinfo.php?changed=Fav_Singer&correctinfo="+ document.getElementById("correctinfoFavSinger").value);
												request.send();
 									document.getElementById("showFavSinger").innerHTML=document.getElementById("correctinfoFavSinger").value;
											}
							</script>

							</div>
						</li>
						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666- -->
						<script>
							$(document).ready(function(){
							    $("#change4").click(function(){
							        $("#changeFav_Songs").slideToggle("slow");
							    });
							});
						</script>
						<li>
							<b>喜歡的歌/Favorate Songs</b>
							<div class="name_blank" id="showFav_Songs"><?php echo $favsong;?><img id="change4" src="image/pen.png" alt=""></div>
						</li>
						<li id="changeFav_Songs">
							<b>修改喜歡的歌/Edit Favorate Songs:</b>
							<div id="change_name_blank">
							<form>
									<input type="text" id="correctinfoFav_Songs" value=<?php echo $favsong;?>>
									<input type="submit" id="changeinfoFav_Songs" value="確定修改">
							
							</form>		
							<script type="text/JavaScript">
									document.getElementById("changeinfoFav_Songs").onclick = function() {
											var request = new XMLHttpRequest();
											request.open("GET", "changeinfo.php?changed=Fav_Songs&correctinfo="+ document.getElementById("correctinfoFav_Songs").value);
												request.send();
 									document.getElementById("showFav_Songs").innerHTML=document.getElementById("correctinfoFav_Songs").value;
											}
							</script>

							</div>
						</li>
						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666- -->
						<li>
							<b>等級/Level</b>
							<div class="name_blank" ><?php echo $level; ?></div>
						</li>
						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666 -->

						<div class="clear"></div>	
						
							
						<div class="clear"></div>


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
			<li><a href="channel."><img src="image/personal.png"></a></li>
			<li><a href="personalinfo.php"><img src="image/person_info_chosen.png"></a></li>
			<li><a href="setting.php"><img src="image/setting.png"></a></li>
		</ul>
	</footer>
	</div>
</body>
</html>
