<?php
	include("mysql_connect.php");
	if (!isset($_COOKIE['account'])) {
		echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
	}
	if (isset($_GET['name'])) {
		@$an = $_GET['name'];
		$sqlget= "SELECT * FROM User where User_ID = '$an'";
		$resultget = mysqli_query($link,$sqlget);
		$rowget = mysqli_fetch_assoc($resultget);
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"><!-- search -->
	<link rel="Shortcut icon" type="image/x-icon" href="image/favicon.ico">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="./js/pic_adjust.js"></script>
	<script type="text/javascript" src="http://cdn.pubnub.com/pubnub-3.4.4.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  <!-- search -->
	<script src="./nojs/pubnub-setup.js"></script>
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
  					$('#user').click(function(e){
						$('.user_info').fadeIn();
						e.stopPropagation();
						e.preventDefault();
					});
					$(document).click(function(){
						$('.user_info').fadeOut();
					});
					$('.user_info').click(function(e){
						e.stopPropagation();
						e.preventDefault();
						return false;
					});
				});
			</script>
			<script type="text/javascript">
				<?php if ($_COOKIE['account'] == $_GET['name'] || !isset($rowget['User_ID'])): ?>
					$(document).ready(function(){
						$('.trackbutton').hide();
						$('.rightbar').css("margin-top","12px");
					});
				<?php endif; ?>
			</script>

			<div class="toolbar">
				<a href="login.php"><input type="button" id="login" value="登入"></a>
				<div class="user" id="user">
					<img src="photo.php?id=<?php echo $id?>">
					<div class="user_info">
						<ul>
							<li><p>Rank</p>
							<?PHP
								$an = $_COOKIE['account'];
								$sql="SELECT Level From User where User_ID= '$an'";
								$result = mysqli_query($link,$sql);
								$row = mysqli_fetch_assoc($result);
								if ($row['Level']=='無階級') {
									echo "<img src='image/bronze.png'>";
								}elseif ($row['Level']=='銅MIC I') {
									echo "<img src='image/bronze_1.png'>";
								}elseif ($row['Level']=='銅MIC II') {
									echo "<img src='image/bronze_2.png'>";
								}elseif ($row['Level']=='銅MIC III') {
									echo "<img src='image/bronze_3.png'>";
								}elseif ($row['Level']=='銀Mic I') {
									echo "<img src='image/silver_1.png'>";
								}elseif ($row['Level']=='銀Mic II') {
									echo "<img src='image/silver_2.png'>";
								}elseif ($row['Level']=='銀Mic III') {
									echo "<img src='image/silver_3.png'>";
								}elseif ($row['Level']=='金Mic I') {
									echo "<img src='image/golden_1.png'>";
								}elseif ($row['Level']=='金Mic II') {
									echo "<img src='image/golden_2.png'>";
								}elseif ($row['Level']=='金Mic III') {
									echo "<img src='image/golden_3.png'>";
								}elseif ($row['Level']=='白金Mic I') {
									echo "<img src='image/platnum_1.png'>";
								}elseif ($row['Level']=='白金Mic II') {
									echo "<img src='image/platnum_2.png'>";
								}elseif ($row['Level']=='白金Mic III') {
									echo "<img src='image/platnum_3.png'>";
								}elseif ($row['Level']=='鑽石Mic I') {
									echo "<img src='image/diamond_1.png'>";
								}elseif ($row['Level']=='鑽石Mic II') {
									echo "<img src='image/diamond_2.png'>";
								}elseif ($row['Level']=='鑽石Mic III') {
									echo "<img src='image/diamond_3.png'>";
								}
							?>
							</li>
							<li><p>勝場數</p><b2>
								<?PHP
									$an = $_COOKIE['account'];
									$sql="SELECT User_Wins From User where User_ID= '$an'";
									$result = mysqli_query($link,$sql);
									$row = mysqli_fetch_assoc($result);
									echo $row['User_Wins'];
								?>
							</b2>場</li>
							<li><p>勝場率</p><b3>
								<?PHP
									$an = $_COOKIE['account'];
									$sql="SELECT User_Wins FROM User where User_ID= '$an'";
									$result = mysqli_query($link,$sql);
									$row=mysqli_fetch_assoc($result);

									$sql2="SELECT User_Loses FROM User where User_ID= '$an'";
									$result2= mysqli_query($link,$sql2);
									$row2=mysqli_fetch_assoc($result2);

									$wins=$row['User_Wins'];
									$loses=$row2['User_Loses'];
									@$percent = round($wins / ($wins + $loses) * 100,1);
									echo $percent;
								?>
							</b3>%</li>
						</ul>
						<span class="arrow_bottom_int"></span>
						<span class="arrow_bottom_out"></span>
							<div class="bot_area">
								<p><?php
								$sql="SELECT User_Name From User WHERE User_id='$id'";
								$result=mysqli_query($link,$sql);
								$row=mysqli_fetch_assoc($result);
								$username=$row['User_Name'];
								echo $username;?></p>
								<input type="button" class="logout" value="登出"
								onclick="location='logoutconnect.php'">
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
					<li><a href="battle.php"><img src="image/menu_battle.png" width="15%">  &nbsp<b>大亂鬥</b></a></li>
					<li><a href="channel.php"><img src="image/menu_personal.png" width="15%"> &nbsp<b>個人頻道</b></a></li>
					<li><a href="personalinfo.php"><img src="image/menu_person_info.png" width="15%"> &nbsp<b>我的資料</b></a></li>
					<li><a href="setting.php"><img src="image/rules.png" width="15%"> &nbsp<b>規則說明</b></a></li>
				</ul>
			</div>
		</div>
	</div>
	<hr>
	<div class="wrap">
		<div id="content">
			<div class="topbar">
				<?php
					if(!isset($rowget['User_ID']) || $rowget['User_ID']==null){
						echo "<p>查無此人</p>";
					}
				?>
				<div class="leftbar">
					<ul>
					<div class="medalevel">
						<?PHP
							$an = $_GET['name'];
							$sql="SELECT Level From User where User_ID= '$an'";
							$result = mysqli_query($link,$sql);
							$row = mysqli_fetch_assoc($result);
							if ($row['Level']=='無階級') {
								echo "<img src='image/bronze.png'>";
							}elseif ($row['Level']=='銅MIC I') {
								echo "<img src='image/bronze_1.png'>";
							}elseif ($row['Level']=='銅MIC II') {
								echo "<img src='image/bronze_2.png'>";
							}elseif ($row['Level']=='銅MIC III') {
								echo "<img src='image/bronze_3.png'>";
							}elseif ($row['Level']=='銀Mic I') {
								echo "<img src='image/silver_1.png'>";
							}elseif ($row['Level']=='銀Mic II') {
								echo "<img src='image/silver_2.png'>";
							}elseif ($row['Level']=='銀Mic III') {
								echo "<img src='image/silver_3.png'>";
							}elseif ($row['Level']=='金Mic I') {
								echo "<img src='image/golden_1.png'>";
							}elseif ($row['Level']=='金Mic II') {
								echo "<img src='image/golden_2.png'>";
							}elseif ($row['Level']=='金Mic III') {
								echo "<img src='image/golden_3.png'>";
							}elseif ($row['Level']=='白金Mic I') {
								echo "<img src='image/platnum_1.png'>";
							}elseif ($row['Level']=='白金Mic II') {
								echo "<img src='image/platnum_2.png'>";
							}elseif ($row['Level']=='白金Mic III') {
								echo "<img src='image/platnum_3.png'>";
							}elseif ($row['Level']=='鑽石Mic I') {
								echo "<img src='image/diamond_1.png'>";
							}elseif ($row['Level']=='鑽石Mic II') {
								echo "<img src='image/diamond_2.png'>";
							}elseif ($row['Level']=='鑽石Mic III') {
								echo "<img src='image/diamond_3.png'>";
							}
						?>

					</div>
						<?php
							if (isset($_GET['name'])) {
								$an = $_GET['name'];
								$sql= "SELECT * FROM User where User_ID = '$an'";
								$result = mysqli_query($link,$sql);
								$row = mysqli_fetch_assoc($result);
							}
							if(@$row['User_ID']){
								echo "
								<li id='info'>ID<div class='blank'>".$row['User_ID']."</div></li>
								<li id='info'>名字<div class='blank'>".$row['User_Name']."</div></li>";
							}
						?>
					<li>
						<ul id="track_list">
							<li>
								<?php
									if(isset($rowget['User_ID'])){
									echo "<nav id='nav-1'><a href='fansMenu_tagFollowers.php?name=".$an."'class='link-1'>追蹤名單<img src='image/track.png' >";
									$sql = "SELECT COUNT(Track_ID) as total FROM Track where Track_ID='$an'";
									$result = mysqli_query($link,$sql);
									$row2 = mysqli_fetch_assoc($result);
									echo $row2['total'];
									echo "</a>";
									}
								?>

							</li>
							<li>
								<?php
									if(isset($rowget['User_ID'])){
									echo "<a href='fansMenu_tagFans.php?name=".$an."'class='link-1'>粉絲名單<img src='image/tracked.png' ></nav>";

										$sql = "SELECT COUNT(DISTINCT Track_ID) as total FROM Track where Tracked_ID='$an'";
										$result = mysqli_query($link,$sql);
										$row2 = mysqli_fetch_assoc($result);
										echo $row2['total'];
										echo "</a>";
									}
								?>
								</a>
							</li>
							<?php
								$sql="SELECT User_Wins From User Where User_ID='$an'";
								$result=mysqli_query($link,$sql);
								$row=mysqli_fetch_row($result);
								if(isset($rowget['User_ID'])){
									echo "<li class='wins'>勝場數<img src='image/win.png' alt=''>".$row[0]."</li>";
								}
							?>
							</ul>
					</li>

					</ul>

				</div>

				<script type="text/javascript">
					function AutoPadding() {
						var img_width = document.getElementById("bigphoto").width;
						var img_height = document.getElementById("bigphoto").height;
						if (img_width < 900 && img_height < 600){
							$(document).ready(function(){
								var img_padding_h = (600-img_height)/2;
								var img_padding_w = (900-img_width)/2;
								$('.entire_photo').css("padding-top",img_padding_h);
								$('.entire_photo').css("padding-bottom",img_padding_h);
								$('.entire_photo').css("padding-left",img_padding_w);
								$('.entire_photo').css("padding-right",img_padding_w);
							});
						}
						else if (img_width > img_height){
							var img_padding = (600-img_height)/2;
							$(document).ready(function(){
								$('.entire_photo').css("padding-top",img_padding);
								$('.entire_photo').css("padding-bottom",img_padding);
							});
						}
						else if (img_width < img_height){
							var img_padding = (900-img_width)/2;
							$(document).ready(function(){
								$('.entire_photo').css("padding-left",img_padding);
								$('.entire_photo').css("padding-right",img_padding);
							});
						}
					}
				</script>

				<div class="rightbar">
				<?php
					if(isset($rowget['User_ID'])){
					echo "<img src='photo.php?id=".$rowget['User_ID']."' id='userimg'>
						<div id='myModal' class='modal'>
							<div class='entire_photo' style='width: 900px;height:600px;background-color:black;box-sizing: border-box;margin:auto;'>
								<img class='modal-content' id='bigphoto'>
							</div>
						</div>";
					}
						$usernow = $_COOKIE['account'];
						@$an = $_GET['name'];
						$sql = "SELECT Track_time FROM Track where Track_ID='$usernow' && Tracked_ID='$an'";
						$result = mysqli_query($link,$sql);
						$row = mysqli_fetch_row($result);
						if (isset($_GET['name'])){
							if (isset($row[0])) {
								echo "
									<div class='trackbutton' >
										<input type='checkbox' id='followed' checked>
									</div>";
							}
							else{
								echo "
									<div class='trackbutton' >
										<input type='checkbox' id='follow'>
									</div>";
							}
						}

					?>
	<script type="text/javascript">
			var modal = document.getElementById('myModal');
			var img = document.getElementById('userimg');
			var modalImg = document.getElementById("bigphoto");
			img.onclick = function(e){
			    modal.style.display = "block";
			    modalImg.src = this.src;
			    AutoPadding();
			}
			$(document).click(function(){
				$('.modal').fadeOut(200);
			});
			$('#userimg').click(function(e){
				e.stopPropagation();
				e.preventDefault();
				return false;
			});
	</script>
				<script type="text/javascript">
					PicAutoMid();
				</script>
				<script type="text/javascript">
					PicAutoMid();
				</script>
				<script>
					/*$(function() {
						var pb = PUBNUB.init(PUBNUB.setup);
						$( document ).on( "click", "#follow", function() {
							pb.publish({
								channel: PUBNUB.setup.channel,
								message: {
								    iconUrl   : 'images/icon.png',
								    type      : 'basic',
								    title     : new Date(),
								    message   : "用戶 + <?php echo $usernow;?> + 追蹤了+<?php echo $an;?>",
								    priority  : 1,
								    buttons: [
								        {title: 'I want in', iconUrl: 'images/icon.png'}
								    ]
								}
							});
						});
						$( document ).on( "click", "#followed", function() {
							pb.publish({
								channel: PUBNUB.setup.channel,
								message: {
									iconUrl   : 'images/icon.png',
									type      : 'basic',
									title     : new Date(),
									message   : "用戶 + <?php echo $usernow;?> + 取消追蹤了+<?php echo $an;?>",
									priority  : 1,
									buttons: [
											{title: 'I want in', iconUrl: 'images/icon.png'}
									]
								}
							})
						});
					});*/
				</script>
					<script type="text/javascript">
							var pb = PUBNUB.init(PUBNUB.setup);
							$( document ).on( "click", "#followed", function() {
								pb.publish({
								channel: PUBNUB.setup.channel,
								message: {
									iconUrl   : 'images/icon.png',
									type      : 'basic',
									title     : "MicMusic",
									message   : "用戶 <?php echo $usernow;?> 取消追蹤了<?php echo $an;?>",
									priority  : 1,
									buttons: [
											{title: 'I want in', iconUrl: 'images/icon.png'}
									]
								}
							});
  								var request = new XMLHttpRequest();
							    request.open("GET", "followcancel.php?Track_ID=<?php echo $usernow;?>&Tracked_ID=<?php echo $an;?>");
							    request.send();
							    $('#followed').attr('id','follow');
							});
							$( document ).on( "click", "#follow", function() {
								pb.publish({
								channel: PUBNUB.setup.channel,
								message: {
								    iconUrl   : 'images/icon.png',
								    type      : 'basic',
								    title     : "MicMusic",
								    message   : "用戶  <?php echo $usernow;?>  追蹤了<?php echo $an;?>",
								    priority  : 1,
								    buttons: [
								        {title: 'I want in', iconUrl: 'images/icon.png'}
								    ]
								}
								});
  								var request = new XMLHttpRequest();
							    request.open("GET", "follow.php?Track_ID=<?php echo $usernow;?>&Tracked_ID=<?php echo $an;?>");
							    request.send();
							    $('#follow').attr('id','followed');
							});
					</script>
				</div>
				<div class="clear"></div>
			</div>


			<div class="downbar">
				<ul>
					<?php
							if (isset($_GET['name'])) {
								@$an = $_GET['name'];
								$sql= "SELECT * FROM User where User_ID = '$an'";
								$result = mysqli_query($link,$sql);
								$row = mysqli_fetch_assoc($result);
								if(@$row['Hobby']==null){
									$row['Hobby']="目前暫無資料";
								}
								if(@$row['Fav_Songs']==null){
									$row['Fav_Songs']="目前暫無資料";
								}
								if(@$row['Fav_Singer']==null){
									$row['Fav_Singer']="目前暫無資料";
								}
							}
						if(@$row['User_ID']){
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
					}
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
			<li><a href="setting.php"><img src="image/rules_chosen.png"></a></li>
		</ul>
	</footer>
	</div>
</body>
</html>
