<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript"> 
	<?PHP
			include ("mysql_connect.php");
			$an=$_GET['name'];
			$id=$_COOKIE['account'];
			if ($an == $id):?>
		location.replace("personal_channelHOST.php");
		<?php endif; ?>
	</script> <!-- 進來的如果是台主，導向HOST頁面 -->

	<?php
	include ("mysql_connect.php");
	$Status="battle.php";
	$user_now=@$_COOKIE['account'];
	$sql="SELECT Status_Time FROM UserStatus WHERE User_ID='$user_now' && Status='$Status'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_assoc($result);
	if (isset($row)){
		date_default_timezone_set('Asia/Taipei');
		$t= date("Y/m/d H:i:s");
		$sql="UPDATE UserStatus SET Status_Time='$t' WHERE User_ID='$user_now' && Status='$Status'";
		$result=mysqli_query($link,$sql);
		
	}else{
		date_default_timezone_set('Asia/Taipei');
		$t= date("Y/m/d H:i:s");
		$sql="INSERT INTO UserStatus (Status,User_ID,Status_Time) VALUES ('$Status','$user_now','$t')";
		$result2=mysqli_query($link,$sql);
	}
	?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/personal_channel_1.css">
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
			<div class="toolbar">
				<a href="login.php"><input type="button" id="login" value="登入"></a>
				<div id="user">
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
                                    @$percent=$wins/($wins+$loses)*100;
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
								<input type="button" class="logout" value="登出" onclick="location='logoutconnect.php'">
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
			<h2>
			【
			<?php 
			$an=$_GET['name'];
			echo $an;
			?>】的房間
			</h2>

			<div class="clear"></div>
			<div class="main">
				<div class="personal_area">
					<div class="board">
					<img src="image/onair.gif" class="onair">
						<div class="clear"></div>
					</div>
					
					<script>
						$(document).ready(function(){
  							$('#pic').click(function(){
  								//指定呼叫按鈕
    							$('#square').fadeToggle(500);
    							//顯示隱藏的div
    							$('#square').delay(500).fadeOut(500);
  							});
						});
					</script>
					
					<div class="track">
						<?php
							$an=$_GET['name'];
							$sql1 = "SELECT User_Name From User WHERE User_ID='$an'";
							$result1 =mysqli_query($link,$sql1);
							$row1=mysqli_fetch_row($result1);
							echo $row1[0];

							$usernow= $_COOKIE['account'];
							$sql2 = "SELECT Track_Time FROM Track where Track_ID='$usernow' && Tracked_ID='$an'";
							$result2 = mysqli_query($link,$sql2);
							$row2 = mysqli_fetch_row($result2);
							if (isset($row2[0])) {
								echo "
									<div id='pic'>
										<input type='checkbox' id='tracked' checked>
									</div>
								";
							}else{
								echo "
									<div id='pic'>
										<input type='checkbox' id='notrack'>
									</div>
								";
							}
						?>
						<div id="square"></div>
						<script type="text/javascript">
								$( document ).on( "click", "#tracked", function() {
	  								var i = document.getElementById('singerid').innerHTML;
	  								var request = new XMLHttpRequest();
								    request.open("GET", "followcancel.php?Tracked_ID="+i+"&Track_ID=<?php echo $id;?>");
								    request.send();
								    $('#tracked').attr('id','notrack');
								    document.getElementById("square").innerHTML = ("取消追蹤!");
								});
								$( document ).on( "click", "#notrack", function() {
									var i = document.getElementById('singerid').innerHTML;
	  								var request = new XMLHttpRequest();
								    request.open("GET", "follow.php?Tracked_ID="+i+"&Track_ID=<?php echo $id;?>");
								    request.send();
								    $('#notrack').attr('id','tracked');
								    document.getElementById("square").innerHTML = ("成功追蹤!");
								});
						</script>


					</div>
						<a id='singerhref'>
						<b id="singerid"></b>
						<b id="singname"></b>
						</a>
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
				<li><a href="setting.php"><img src="image/rules.png"></a></li>
			</ul>
		</footer>
	</div>
	</body>
</html>