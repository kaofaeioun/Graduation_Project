<!DOCTYPE html>
<!--聽歌頁面-->
<html lang="en">
<head>
	<?php
		include("mysql_connect.php");
		@$id=$_COOKIE['account'];
		$sqlID = "SELECT User_Name FROM User where User_ID = '$id'";
		$resultID = mysqli_query($link, $sqlID);
		$rowID = mysqli_fetch_row($resultID);
	?>
	<?php
	include ("mysql_connect.php");
	$Status="battle.php";
	$user_now=@$_COOKIE['account'];
	$sql="SELECT Status_Time FROM UserStatus WHERE User_ID='$user_now'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_assoc($result);
	if (isset($row)){
		// $sql3="SELECT Status_Time From UserStatus WHERE User_ID='$user_now'";
		// $result3=mysqli_query($link,$sql3);
		// $row3=mysqli_fetch_assoc($result3);
		date_default_timezone_set('Asia/Taipei');
		$t= date("Y/m/d H:i:s");
		// $timegap=strtotime($t) - strtotime($row3['Status_Time']);
		$sql="UPDATE UserStatus SET Status_Time='$t',Status='$Status'WHERE User_ID='$user_now' ";
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
	<link rel="stylesheet" href="CSS/battle_channel_1.css">
	<link rel="stylesheet" href="CSS/all.css">
	<link rel="Shortcut icon" type="image/x-icon" href="image/favicon.ico">
	<script>
		var client = { //is observerd
			"userid" : "<?php echo $id;?>",
			"pp" : "../img/profile.jpg", //Profil Pic
			"nn" : "<?php echo $rowID[0];?>", //Nickname
			"mg" : 4/100, // minGain
			"mic" : false,
			"sound" : true
		}
	</script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://cdn.pubnub.com/pubnub-3.4.4.js"></script>
	<script type="text/javascript" src="./js/jquery.nouislider.min.js"></script>
	<script type="text/javascript" src="./js/material.min.js"></script>
	<script type="text/javascript" src="./js/main.js"></script>
	<script type="text/javascript" src="./js/ripples.min.js"></script>
	<script type="text/javascript" src="./js/smooth.js"></script>
	<script type="text/javascript" src="./js/resampler.js"></script>
	<script type="text/javascript" src="./js/voip.js"></script>
	<script type="text/javascript" src="./js/congratulation.js"></script>
	<script type="text/javascript" src="./js/TweenMax.min.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.2/underscore-min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"><!-- search -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  <!-- search -->
	<title>MicMusic</title>
</head>

<body>
	<script type="text/javascript">
		<?php include("mysql_connect.php");
			if(!isset($_COOKIE['account'])): ?>
				location.replace("login.php");
		<?php else: $id=$_COOKIE['account'];
		?>
			$(document).ready(function(){
				$('#user').show();
			});
		<?php endif;
		?>
	</script>
	<div class="alert_bg">

	</div>
	<div id="alert_window">

			<h2><img src="image/icon.png" alt="">提醒您</h2>
			<p>
				目前正在進行投票，為維持投票公平性，暫不開放進入。<br>
				您可在下一輪演唱開始時進入，請稍後...
			</p>
			<input type="button" value="我知道了" class="alert_btn">
	</div>
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
				<div class="container"></div>
				<div class="user" id="user">
					<img src="photo.php?id=<?php echo $id;?>">
					<div class="user_info">
						<ul>
                            <li><p>Rank</p>
                            <?PHP
                                $an = $_COOKIE['account'];
                                $sql="SELECT Level From User where User_ID= '$an'";
                                $result = mysqli_query($link,$sql);
                                $row = mysqli_fetch_assoc($result);
                                if ($row['Level']=='無階級') {
                                    echo "<img src='image/bronze.png'>";
                                }elseif ($row['Level']=='銅MIC I') {
                                    echo "<img src='image/bronze_1.png'>";
                                }elseif ($row['Level']=='銅MIC II') {
                                    echo "<img src='image/bronze_2.png'>";
                                }elseif ($row['Level']=='銅MIC III') {
                                    echo "<img src='image/bronze_3.png'>";
                                }elseif ($row['Level']=='銀Mic I') {
                                    echo "<img src='image/silver_1.png'>";
                                }elseif ($row['Level']=='銀Mic II') {
                                    echo "<img src='image/silver_2.png'>";
                                }elseif ($row['Level']=='銀Mic III') {
                                    echo "<img src='image/silver_3.png'>";
                                }elseif ($row['Level']=='金Mic I') {
                                    echo "<img src='image/golden_1.png'>";
                                }elseif ($row['Level']=='金Mic II') {
                                    echo "<img src='image/golden_2.png'>";
                                }elseif ($row['Level']=='金Mic III') {
                                    echo "<img src='image/golden_3.png'>";
                                }elseif ($row['Level']=='白金Mic I') {
                                    echo "<img src='image/platnum_1.png'>";
                                }elseif ($row['Level']=='白金Mic II') {
                                    echo "<img src='image/platnum_2.png'>";
                                }elseif ($row['Level']=='白金Mic III') {
                                    echo "<img src='image/platnum_3.png'>";
                                }elseif ($row['Level']=='鑽石Mic I') {
                                    echo "<img src='image/diamond_1.png'>";
                                }elseif ($row['Level']=='鑽石Mic II') {
                                    echo "<img src='image/diamond_2.png'>";
                                }elseif ($row['Level']=='鑽石Mic III') {
                                    echo "<img src='image/diamond_3.png'>";
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
									@$percent=round($wins/($wins+$loses)*100,1);
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
								echo $username;?>
							</p>
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
					<li><a href="setting.php"><img src="image/rules.png" width="15%"> &nbsp<b>規則說明</b></a></li>
				</ul>
			</div>
		</div>
	</div>
	<hr>
	<div class="wrap">
		<div id="content">
			<b><h2>大亂鬥模式 頻道1/Channel 1</h2></b>
			<div class="main">
				<div class="vote">
					<div class="board">
						<div class="circle_area">
							<div class="circle_1" id="circle"></div>
							<div class="circle_2" id="CountDown"></div>
							<p id="singresult" hidden="hidden"></p>
							<script src="http://d3js.org/d3.v3.min.js"></script>
							<script type="text/javascript" src="./js/ArMen.js"></script>
						</div>
					</div>
					<!-- 成功動畫 -->
					<div id="congrats_bg">
						<div class="congrats">
							<h5>Congratulations!</h5>
						</div>
					</div>

					<!-- 小視窗 -->
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
<script type="text/javascript">
function CountMic(){
		var request = new XMLHttpRequest();
		request.open("GET", "countmic.php?id=<?php echo $id;?>");
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send();
	request.onreadystatechange = function() {
						        // 伺服器請求完成
		if (request.readyState === 4) {
						            // 伺服器回應成功
			if (request.status === 200) {
				var type = request.getResponseHeader("Content-Type");   // 取得回應類型
				if (type.indexOf("application/json") === 0) {
					var data = JSON.parse(request.responseText);
					if(data.MicOrder){
						document.getElementById("MicTitle").innerHTML = "排麥順位";
						document.getElementById("MicCount").innerHTML = data.MicOrder-1;
					}
					if(!data.MicOrder){

						if (data.MicCount) {
							document.getElementById("MicTitle").innerHTML = "目前排麥人數";
							document.getElementById("MicCount").innerHTML = data.MicCount;
						}
						if (!data.MicCount){
							document.getElementById("MicTitle").innerHTML = "目前排麥人數";
							document.getElementById("MicCount").innerHTML = null;
						}
					}
					if(data.Singer){
						var x="<?php echo $id;?>";
						if(x==data.Singer){
						document.getElementById("notrack").style.visibility="hidden";
						document.getElementById("GottentMic").style.visibility="hidden";
						}	
						document.getElementById("singerid").innerHTML = data.Singer;
						document.getElementById("singname").innerHTML = data.SingerName;
						document.getElementById("singerhref").href = "fans.php?name="+data.Singer;
					}
					if(data.TrackedNum){
						document.getElementById('TrackedNum').innerHTML=data.TrackedNum;
					}
					if(!data.TrackedNum){
						document.getElementById('TrackedNum').innerHTML=null;
					}
					if(data.Singer1){
						document.getElementById("queue1id").innerHTML = data.Singer1Name;
						document.getElementById("queue1href").href = "fans.php?name="+data.Singer1;
					}
					if(data.Singer2){
						document.getElementById("queue2id").innerHTML = data.Singer2Name;
						document.getElementById("queue2href").href = "fans.php?name="+data.Singer2;
					}
					if(data.Singer3){
						document.getElementById("queue3id").innerHTML = data.Singer3Name;
						document.getElementById("queue3href").href = "fans.php?name="+data.Singer3;
					}
					if(!data.Singer){
						document.getElementById("singerid").innerHTML = null;
						document.getElementById("singname").innerHTML = null;
					}
					if(!data.Singer1){
						document.getElementById("queue1id").innerHTML = null;
					}
					if(!data.Singer2){
						document.getElementById("queue2id").innerHTML = null;
					}
					if(!data.Singer3){
						document.getElementById("queue3id").innerHTML = null;
					}
					if(data.VoteResult){
						document.getElementById("vtresult").innerHTML="true";
					}
					if(data.SingResult){
						if(data.SingResult=="2"){
							document.getElementById("singresult").innerHTML="2";
							console.log("sing2");
						}
						else if(data.SingResult=="1"){
							document.getElementById("singresult").innerHTML="1";
							console.log("sing1");
						}
						else{
							document.getElementById("singresult").innerHTML="0";
							console.log("sing0");
						}
						calculate();
					}
					if(!data.SingResult){
						console.log("nosing");
							calculate();
					}
					if(data.StatusResult){
						if(data.StatusResult=="0"){
							//document.getElementById("GetMic").style.visibility="visible";
							client.sound=true;
							client.mic=false;
						}
						else if(data.StatusResult=="1")
						{	
							//document.getElementById("GottentMic").style.visibility="hidden";
							client.sound=false;
							client.mic=true;
						}
					}
				}
			} else {
				alert("發生錯誤: " + request.status);
			}
		}
	}
}
	CountMic();
function LoseResult(){
	var request = new XMLHttpRequest();
		request.open("GET", "cancelmic.php?singer="+document.getElementById('singerid').innerHTML+"&id=<?php echo $_COOKIE['account'];?>");
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send();
}
function Countlose(){
	var request =new XMLHttpRequest();
		request.open("GET", "pointcountlose.php?singer="+document.getElementById('singerid').innerHTML+"&id=<?php echo $_COOKIE['account'];?>");
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send();
}
function WinResult(){
	var request = new XMLHttpRequest();
		request.open("GET", "success.php?singer="+document.getElementById('singerid').innerHTML+"&id=<?php echo $_COOKIE['account'];?>");
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send();
}
function Countwin(){
	var request =new XMLHttpRequest();
		request.open("GET", "pointcountwin.php?singer="+document.getElementById('singerid').innerHTML+"&id=<?php echo $_COOKIE['account'];?>");
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send();
}
	</script>
					<div class="track">
						<?php
							@$usernow = $_COOKIE['account'];
							$sql1 = "SELECT User_ID FROM Mic where 1";
							$result1 =mysqli_query($link,$sql1);
							$row1=mysqli_fetch_row($result1);
							$singer=$row1[0];
							$sql2 = "SELECT Track_time FROM Track where Track_ID='$usernow' && Tracked_ID='$singer'";
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
						<b id="singerid" hidden="hidden"></b>
						<b id="singname"></b>
						</a>
					<div class="vote_info">
						<li><img src="image/watcher.png" original title="目前觀看人數">
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
							}

						</script>
						</li>
						<li><img src="image/like.png" original title="追蹤人數"><b id="TrackedNum"></b></li>
						<script type="text/javascript">
						</script>
					</div>
					<?php
						$sqlTrack = "SELECT COUNT(DISTINCT Track_ID) as total FROM Track where Tracked_ID=''";
						$resultTrack = mysqli_query($link,$sqlTrack);
						$rowTrack = mysqli_fetch_assoc($resultTrack);
					?>
				</div>
<script type="text/javascript">
var VoteCount = 0;
var NowStatus = 0;
function datareset(msg){
	for (var i = 0; i<window.data.length; i++){
	var el = window.data[i];
	if (el.vote !== 0 && el.name === msg){
		el.vote -= 1;
			console.log(el.name+":"+el.vote);
			}
		}
	}
function resetvotes(){
	pubnub.history({
		channel:"Vote2",
		start:0,
		 callback: function(msg) {
			var vote_history = msg[0];
			for (var i = 0; i < vote_history.length; i++) {
			datareset(vote_history[i]);
		}
	}
});
}
	$(document).ready(function(){
					$("#Like").click(function(){
						document.getElementById("Dislike").style.visibility = "hidden";
						document.getElementById("Like").style.visibility= "hidden";
						VoteCount++;
						console.log("Like");
					});
					$("#Dislike").click(function(){
						document.getElementById("Dislike").style.visibility = "hidden";
						document.getElementById("Like").style.visibility= "hidden";
						VoteCount++;
						console.log("Dislike");
					});
				});
function calculate() {
	var request = new XMLHttpRequest();
		request.open("GET", "timeget.php");
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send();
	request.onreadystatechange = function() {
						        // 伺服器請求完成
		if (request.readyState === 4) {
						            // 伺服器回應成功
			if (request.status === 200) {
				var type = request.getResponseHeader("Content-Type");   // 取得回應類型
				if (type.indexOf("application/json") === 0) {
					var data = JSON.parse(request.responseText);
					var systemTime = parseInt(data.TimeSpan);
					var t = new Date(systemTime);
					if(document.getElementById('singresult').innerHTML=="2"){
						s = "0" + t.getSeconds();
						s = s.substring(s.length - 2, s.length + 1);
						s = 120-s;
					}else{
						s = "0" + t.getSeconds();
						s = s.substring(s.length - 2, s.length + 1);
						s = 60-s;
					}
					document.getElementById('CountDown').innerHTML= s+"s";
				}
			}
		}
	}
}
			var startTime = new Date().getTime();
			var count = 0;
					function showTime() {
							s -= 1;
							document.getElementById('CountDown').innerHTML= s+"s";
							count++;
							var offset = new Date().getTime() - (startTime + count * 1000);
							var nextTime = 1000 - offset;
							if (nextTime < 0) nextTime = 0;
							setTimeout(showTime, nextTime);
					if(s==0){
						VoteCount = 0;
						NowStatus = 0;
						$("#alert_window").delay(600).fadeOut(500);
						$(".alert_bg").delay(600).fadeOut(500);
						if(data[0].vote<data[1].vote){
							Congratulation();
							Countwin();
							WinResult();
							resetvotes();
							s=s+120;
						}
						else if(data[0].vote>data[1].vote){
							Countlose();
							LoseResult();
							resetvotes();
							s=s+60;
						}
						else{
							LoseResult();
							resetvotes();
							s=s+60;
						}
					}
					if(s==59||s==119){
						CountMic();

					}
					if(s==60){
						WinResult();
					}
					if(s<30&&s>1){
						if(NowStatus !== 1){
							$("#alert_window").fadeIn();
							$(".alert_bg").fadeIn();
							$(".alert_btn").click(function(){
								window.location.assign("/battle.php");
							});
						}
						if(document.getElementById('vtresult').innerHTML!="true"&&document.getElementById('singresult').innerHTML=="0"){
							draw(data);
							if(VoteCount !== 0){
								document.getElementById("Dislike").style.visibility = "hidden";
								document.getElementById("Like").style.visibility= "hidden";
							} else {
								document.getElementById("Dislike").style.visibility = "visible";
								document.getElementById("Like").style.visibility ="visible";
							}

						}
							document.getElementById("circleSvg").style.visibility ="visible";
					}
					if(s>30){
							NowStatus = 1;
							document.getElementById("circleSvg").style.visibility = "hidden";
							document.getElementById("Dislike").style.visibility = "hidden";
							document.getElementById("Like").style.visibility= "hidden";
					}

				}
					setTimeout(showTime, 1000);
					</script>
				<script type="text/javascript">
					$( document ).on( "click", "#Like", function() {
	  					var i = document.getElementById("singerid").innerHTML;
	  					console.log(i);
	  					var request = new XMLHttpRequest();
						request.open("GET", "voteconnect.php?singer="+i+"&id=<?php echo $id;?>");
						 request.send();
					});
					$( document ).on( "click", "#Dislike", function() {
						var i = document.getElementById("singerid").innerHTML;
	  					var request = new XMLHttpRequest();
						request.open("GET", "voteconnect.php?singer="+i+"&id=<?php echo $id;?>");
						request.send();
					});
				</script>
				<div class="queue">
					<li><a id="queue1href"><b id='queue1id'></b></a></li>
					<li><a id="queue2href"><b id='queue2id'></b></a></li>
					<li><a id="queue3href"><b id='queue3id'></b></a></li>
				</div>
				<div class="mic_queue">
					<li><p id="MicTitle"></p></li>
					<li><img src="image/line.png"></li>
					<li><p id="MicCount"></p></li>
					<li><p id="vtresult" hidden="hidden"></p></li>
				</div>
				<?php
					@$id = $_COOKIE['account'];
					$sqlMic = "SELECT User_ID FROM Mic where User_ID='$id'";
					$resultMic=mysqli_query($link,$sqlMic);
					$rowMic = mysqli_fetch_row($resultMic);
					if (isset($rowMic[0])) {
					echo "<div class='get_mic'>
						<li><input type='checkbox' id='GottentMic' checked><p id='qwer'></p></li>
					</div>";
					}
					else{
					echo "<div class='get_mic'>
						<li><input type='checkbox' id='GetMic'><p id='qwer'></p></li>
					</div>";
					}
				?>
	<script>
	$( document ).on( "click", "#GetMic", function() {
    // 發送 Ajax 查詢請求並處理
    var request = new XMLHttpRequest();
    request.open("POST", "micconnect.php");
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
    request.onreadystatechange = function() {
        // 伺服器請求完成
        if (request.readyState === 4) {
            // 伺服器回應成功
            if (request.status === 200) {
                var type = request.getResponseHeader("Content-Type");   // 取得回應類型
                // 判斷回應類型，這裡使用 JSON
                if (type.indexOf("application/json") === 0) {
                    var data = JSON.parse(request.responseText);
                    if(data.Count_A){
                        document.getElementById("MicCount").innerHTML = data.Count_A;
                        CountMic();
                    }
                }
            } else {
                alert("發生錯誤: " + request.status);
            }
        }
    }
    $('#GetMic').attr('id','GottentMic');
});
	$( document ).on( "click", "#GottentMic", function() {
    // 發送 Ajax 查詢請求並處理
    var request = new XMLHttpRequest();
    request.open("GET", "micconnect.php");
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
    request.onreadystatechange = function() {
        // 伺服器請求完成
        if (request.readyState === 4) {
            // 伺服器回應成功
            if (request.status === 200) {
                var type = request.getResponseHeader("Content-Type");   // 取得回應類型
                // 判斷回應類型，這裡使用 JSON
                if (type.indexOf("application/json") === 0) {
                    var data = JSON.parse(request.responseText);
                    if(data.Count_B){
                        document.getElementById("MicCount").innerHTML = data.Count_B;
                    	CountMic();
                    }
                }
            } else {
                alert("發生錯誤: " + request.status);
            }
        }
    }
    $('#GottentMic').attr('id','GetMic');
});
</script>
				<div class="clear"></div>
				<div id="chatContent" class="chatroom">

				</div>
				<input id="chatInput" type="text" placeholder="留言......" class="reply">
			</div>
		</div>
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
				<li><a href="setting.php"><img src="image/rules.png"></a></li>
			</ul>
		</footer>
	</div>
	</body>
</html>
