<?php
	include('mysql_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="http://fonts.googleapis.com/css?family=Cabin:400,500,600,bold" rel="stylesheet" type="text/css" >
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,bold" rel="stylesheet" type="text/css" >
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/login.css">
	<link rel="stylesheet" href="CSS/all.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"><!-- search -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script><!-- search -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  <!-- search -->
	<title>MicMusic</title>
</head>
<body>
	<div class="wrap">
		<div class="header">
			<h1><img src="image/Logo2.png"></h1>
			<div class="toolbar">
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
	</div><hr>
	<div class="wrap">
		<div id="content">
			<h2>登入<b>/</b><br>Login</h2>
				<div class="profile_pic"><img src="image/icon.PNG"></div>
				<div class="profile">		
					<form method="post" action="">
						<div class="profile_blank">
							<ul>
								<li>
									<input type="text" class="name_blank" placeholder="請輸入用戶/ID" name="id" onkeyup="value=value.replace(/[\W]/g,'')" 
										onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/)"	maxlength="20" required="">
								</li>
								<li>
									<input type="password" class="name_blank" placeholder="請輸入密碼/Password" name="pwd" Maxlength="20" required="">
								</li>
								<div id="msg"></div>
								<div class="clear"></div>				
								<b1>
									<button type="submit" class="ctrl-standard typ-subhed fx-sliderIn" id ="sub">Submit</button>
								</b1>
								<b1>
									<a href="register.php"><div class="gg-standard tmd-subhed wp-sliderIn">註冊</div></a>
								</b1>
							</ul>
						</div>
					</form>		
					<?php
  					if(isset($_POST['id'])&& isset($_POST['pwd'])){
		        		$account = $_POST['id'];
		    			$passwd = $_POST['pwd'];
    					//搜尋資料庫資料
		    			$sql = "SELECT * FROM User where User_ID ='$account'";
		    			$result = mysqli_query($link,$sql);
					 	$row=mysqli_fetch_row($result);
					 	if($row[0]==null){
					 		echo "<script>document.getElementById('msg').innerHTML = ('無此帳號!')</script>";
					 	}
					 	else if($row[1]==$passwd && $row[0]==$account){
	        					setcookie('account',$account,time()+3600*10);
	        					echo '<meta http-equiv=REFRESH CONTENT=0;url=battle.php>';
	      				}else if($row[1]!=$passwd){
	        					echo "<script>document.getElementById('msg').innerHTML = ('密碼輸入錯誤!')</script>";
	      				}else{
	    					echo "<script>document.getElementById('msg').innerHTML = ('無此帳號!')</script>";
  							}

  					}
  					?>
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
				<li><a href="channel.php"><img src="image/personal.png"></a></li>
				<li><a href="personalinfo.php"><img src="image/person_info_chosen.png"></a></li>
				<li><a href="setting.php"><img src="image/setting.png"></a></li>
			</ul>
		</footer>
	</div>
</body>
</html>
