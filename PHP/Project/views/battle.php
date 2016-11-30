<?php
	include ("mysql_connect.php");
	$Status="battle.php";
	$user_now=@$_COOKIE['account'];
	$sql="SELECT Status_Time FROM UserStatus WHERE User_ID='$user_now' && Status='$Status'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_assoc($result);
	if (isset($row)){
		// $sql3="SELECT Status_Time From UserStatus WHERE User_ID='$user_now'";
		// $result3=mysqli_query($link,$sql3);
		// $row3=mysqli_fetch_assoc($result3);
		date_default_timezone_set('Asia/Taipei');
		$t= date("Y/m/d H:i:s");
		// $timegap=strtotime($t) - strtotime($row3['Status_Time']);
		$sql="UPDATE UserStatus SET Status_Time='$t' WHERE User_ID='$user_now' && Status='$Status'";
		$result=mysqli_query($link,$sql);
		
	}else{
		date_default_timezone_set('Asia/Taipei');
		$t= date("Y/m/d H:i:s");
		$sql="INSERT INTO UserStatus (Status,User_ID,Status_Time) VALUES ('$Status','$user_now','$t')";
		$result2=mysqli_query($link,$sql);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/battle.css">
	<link rel="stylesheet" href="CSS/all.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  

	<title>MicMusic</title>
</head>
<body onunload="if(event.clientY<0) document.location=document.location.href">
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
					<img src="photo.php?id=<?php echo $id;?>">
					<div class="user_info">
						<ul>
							<li><p>Rank</p><img src="image/golden_2.png"></li>
							<li><p>勝場數</p><b2>94</b2>場</li>
							<li><p>勝場率</p><b3>87</b3>%</li>
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

		在線人數:
				<div id="Countmanshow"></div>
				<script type="text/javascript" src="countman.php"></script>

				<!-- 66666666666666666666666666666666666666666666666666666666666666666666 -->
				<script>
					Countman();
					function Countman(){
						var request = new XMLHttpRequest();
    					request.open("POST", "countman.php");
    					request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					    request.send();
					    request.onreadystatechange = function() {
					        if (request.readyState === 4) {
					            if (request.status === 200) {
					                var type = request.getResponseHeader("Content-Type");
					                if (type.indexOf("application/json") === 0) {               
					                    var data = JSON.parse(request.responseText);
					                    if (data.msg) {
					                        document.getElementById("Countmanshow").innerHTML = data.msg;
					                    }
					                }
					            } else {
					                alert("發生錯誤" + request.status);
					            }
					        }
					    }
						
						setTimeout("Countman()",60000);

						// $sql3="SELECT Status_Time From UserStatus WHERE User_ID='$user_now'";
						// $result3=mysqli_query($link,$sql3);
						// $row3=mysqli_fetch_assoc($result3);
						
						// $timegap=strtotime($t) - strtotime($row3['Status_Time']);
					}

				</script>
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