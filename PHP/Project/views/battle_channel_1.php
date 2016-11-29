<!DOCTYPE html>
<!--聽歌頁面-->
<html lang="en">
<head>
	<?php
		include("mysql_connect.php");
		$id=$_COOKIE['account'];
		$sqlID = "SELECT User_Name FROM User where User_ID = '$id'";
		$resultID = mysqli_query($link, $sqlID);
		$rowID = mysqli_fetch_row($resultID);
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
		<?php else: $id=$_COOKIE['account'];
		?>
			$(document).ready(function(){
				$('#user').show();
			});
		<?php endif;
		?>
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
				<div class="container"></div>
				<div class="user" id="user">
					<img src="photo.php?id=<?php echo $id;?>">
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
			<b><h2>大亂鬥模式 頻道1/Channel 1</h2></b>
			<div class="main">
				<div class="vote">
					<div class="board">
						<div class="circle_area">
							<div class="circle_1" id="circle"></div>
							<div class="circle_2" id="CountDown"></div>
							<script src="http://d3js.org/d3.v3.min.js"></script>
							<script type="text/javascript" src="./js/ArMen.js"></script>
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
					if (data.MicCount) {
						document.getElementById("MicCount").innerHTML = data.MicCount;
					}
					if (!data.MicCount){
						document.getElementById("MicCount").innerHTML = null;
					}
					if(data.Singer){
						document.getElementById("singerid").innerHTML = data.Singer;
						document.getElementById("singname").innerHTML = data.SingerName;
						document.getElementById("singerhref").href = "fans.php?name="+data.Singer;
					}
					if(data.Singer1){
						document.getElementById("queue1id").innerHTML = data.Singer1+"("+data.Singer1Name+")";
						document.getElementById("queue1href").href = "fans.php?name="+data.Singer1;
					}
					if(data.Singer2){
						document.getElementById("queue2id").innerHTML = data.Singer2+"("+data.Singer2Name+")";
						document.getElementById("queue2href").href = "fans.php?name="+data.Singer2;
					}
					if(data.Singer3){
						document.getElementById("queue3id").innerHTML = data.Singer3+"("+data.Singer3Name+")";
						document.getElementById("queue3href").href = "fans.php?name="+data.Singer3;
					}
					if(!data.Singer){
						document.getElementById("singerid").innerHTML = null;
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
					if(data.StatusResult){
						if(data.StatusResult==0){
							client.sound=true;
							client.mic=false;
						}
						else if(data.StatusResult==1)
						{
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
function CancelMic(){
	var request = new XMLHttpRequest();
		request.open("GET", "cancelmic.php?singer="+document.getElementById('singerid').innerHTML+"");
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send();
}
	</script>
					<div class="track">
						<?php
							$usernow = $_COOKIE['account'];
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
						<b id="singerid"></b>
						<b id="singname"></b>
						</a>
					<div class="vote_info">
						<li><img src="image/watcher.png" original title="目前觀看人數">8888</li>
						<li><img src="image/like.png" original title="追蹤人數"><b>87</b></li>
						<button id="reset">龜苓膏</button>
						<script type="text/javascript">
						$(document).on("click", "#reset",function() {
							function datareset(msg){
								for (var i = 0; i<window.data.length; i++){
									var el = window.data[i];
									if (el.name == msg && el.vote !== 0){
										el.vote--;
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
							resetvotes();
						});
						</script>
					</div>
					<?php
						$sqlTrack = "SELECT COUNT(DISTINCT Track_ID) as total FROM Track where Tracked_ID=''";
						$resultTrack = mysqli_query($link,$sqlTrack);
						$rowTrack = mysqli_fetch_assoc($resultTrack);
					?>
				</div>
				<?php
					date_default_timezone_set("Asia/Taipei");
				  $DateTime_Now = gmdate("Y-m-d H:i:s"); //取回伺服器 GMT 標準時間
				  $DataTime_Begin = "1970-01-01 00:00:00"; //設定時間起始格式
				  $TimeSpan = (strtotime($DateTime_Now) - strtotime($DataTime_Begin)) * 1000;
				?>
				<script type="text/javascript">
				   var systemTime = parseInt('<?=$TimeSpan;?>');
				   function calculate() {
				    var t = new Date(systemTime);
				    s = "0" + t.getSeconds();
				    s = s.substring(s.length - 2, s.length + 1);
					s = 60-s;
					document.getElementById('CountDown').innerHTML= s+"s";
				   }
				   calculate();
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
								CancelMic();
								s=s+60;
								CountMic();
								$(document).ready(function() {
  									$(".board").load("/ArMen.html");
  									console.log("HEY");
								});
							}if(s<30){
								if(document.getElementById('vtresult').innerHTML!="true"){
								document.getElementById("circleSvg").style.visibility = "visible";
								document.getElementById("Dislike").style.visibility = "visible";
								document.getElementById("Like").style.visibility ="visible";
								}
								document.getElementById("circleSvg").style.visibility ="visible";
							}if(s>30){
								document.getElementById("circleSvg").style.visibility = "hidden";
								document.getElementById("Dislike").style.visibility = "hidden";
								document.getElementById("Like").style.visibility= "hidden";
							}
						}
						setTimeout(showTime, 1000);
					</script>
					<script>
						$(document).ready(function(){
							$("#Like").click(function(){
								$("#Like").fadeOut();
								$("#Dislike").fadeOut();
							});
							$("#Dislike").click(function(){
								$("#Like").fadeOut();
								$("#Dislike").fadeOut();
							});
						});
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
					<li><p>目前排麥人數</p></li>
					<li><img src="image/line.png"></li>
					<li><p id="MicCount"></p></li>
					<li><p id="vtresult" hidden="hidden"></p></li>
				</div>
				<?php
					$id = $_COOKIE['account'];
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
				<li><a href="setting.php"><img src="image/setting.png"></a></li>
			</ul>
		</footer>
	</div>
	</body>
</html>
