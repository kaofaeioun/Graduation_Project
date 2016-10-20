<!DOCTYPE html>
<!--唱歌頁面-->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/battle_channel_1.css">
	<link rel="stylesheet" href="CSS/all.css">
	<script>
		var client = { //is observerd
			"pp" : "../img/profile.jpg", //Profil Pic
			"nn" : "Fuck U", //Nickname
			"mg" : 4/100, // minGain
			"mic" : true,
			"sound" : false
		}
	</script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="js/show.js"></script>
	<script type="text/javascript" src="./js/jquery.nouislider.min.js"></script>
	<script type="text/javascript" src="./js/material.min.js"></script>
	<script type="text/javascript" src="./js/main.js"></script>
	<script type="text/javascript" src="./js/ripples.min.js"></script>
	<script type="text/javascript" src="./js/smooth.js"></script>
	<script type="text/javascript" src="./js/resampler.js"></script>
	<script type="text/javascript" src="./js/voip.js"></script>
	<script type="text/javascript" src="./js/d3.min.js"></script>
	<title>MicMusic</title>
</head>
<body>
	<div class="wrap">
		<div class="header">
			<h1><img src="image/Logo2.png"></h1>
			<div class="menu">
				<div class="user"></div>
				<div class="search">
					<input type="text" class="search_blank" placeholder="輸入ID找歌手">
					<input type="image" class="search_image" src="image/search.png" alt="submit">
				</div>
				<br>
				<ul>
					<li><a href="battle"><img src="image/menu_battle.png" width="15%">  &nbsp<b>大亂鬥</b></a></li>
					<li><a href="channel"><img src="image/menu_personal.png" width="15%"> &nbsp<b>個人頻道</b></a></li>
					<li><a href="personalinfo.php"><img src="image/menu_person_info.png" width="15%"> &nbsp<b>我的資料</b></a></li>
					<li><a href="setting"><img src="image/menu_setting.png" width="15%"> &nbsp<b>設定</b></a></li>
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
							<div class="circle_1"></div>
							<div class="circle_2" id="CountDown"></div>
						</div>
						<div class="vote_like" id="like"><p id="likeresult"></div>
						<div class="vote_dislike" id="dislike"><p id="dislikeresult"></div>
					</div>

					<script>
						$(document).ready(function(){
  							$('.square').hide();
  							//隱藏要呼叫的div
  							$('#track img').click(function() {
  								//指定呼叫按鈕
    							$('.square').fadeToggle(500);
    							//顯示隱藏的div
    							$('.square').delay(800).fadeOut(500);
  							});
						});
					</script>

					<script>
     				 	$(document).ready(function(){
     				 		$("#track img").click(function(){
         						$("#track img").attr("src","image/like.png");
            				});
           				});
					</script>

					<div class="square">
						<span class="arrow_top_int"></span>
						追蹤成功!
					</div>
					<div id="track"><img src="image/cancerlike.png" original title="我要追蹤"><p id="singer"></div>
					<div class="vote_info">
						<li><img src="image/watcher.png" original title="目前觀看人數">8888</li>
						<li><img src="image/like.png" original title="追蹤人數">87</li>
					</div>
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
				    console.log(s);
				   }
				   calculate();
					function showTime()
						{
						    document.getElementById('CountDown').innerHTML= s+"s";
							if(s==0){

								location.reload();
							}
							if(s<30){
								document.getElementById("dislike").style.visibility = "visible";
								document.getElementById("like").style.visibility ="visible";
							}
							if(s>30){
								document.getElementById("dislike").style.visibility = "hidden";
								document.getElementById("like").style.visibility= "hidden";
							}
							s -= 1;
							setTimeout("showTime()",1000);
						}
						showTime();
		function CheckMic(){
			if (s==0){
				var request = new XMLHttpRequest();
    			request.open("POST", "checkmic.php");
    			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    			request.send();
				}
				setTimeout("CheckMic()",1000);
			}
						CheckMic();
					</script>

<script type="text/javascript">
	document.getElementById("like").onclick = function() {
    // 發送 Ajax 查詢請求並處理
    var request = new XMLHttpRequest();
    request.open("POST", "voteconnect.php");
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

                    if (data.like) {
                        document.getElementById("likeresult").innerHTML = data.like;
                    }
                    else if(data.havevote){
                    	document.getElementById("likeresult").innerHTML = data.havevote + "  您已經投過票";
                    }
                    else {
                        document.getElementById("likeresult").innerHTML = data.msg;
                    }
                }
            } else {
                alert("發生錯誤: " + request.status);
            }
        }
    }
}
document.getElementById("dislike").onclick = function() {
    // 發送 Ajax 查詢請求並處理
    var request = new XMLHttpRequest();
    request.open("GET", "voteconnect.php");
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

                    if (data.dislike) {
                        document.getElementById("dislikeresult").innerHTML = data.dislike;
                    }
                    else if(data.havevote){
                    	document.getElementById("dislikeresult").innerHTML = data.havevote + "  您已經投過票";
                    }
                    else {
                        document.getElementById("dislikeresult").innerHTML = data.msg;
                    }
                }
            } else {
                alert("發生錯誤: " + request.status);
            }
        }
    }
}

</script>

				<div class="queue">
					<li><p id='queue1'></li>
					<li><p id='queue2'></li>
					<li><p id='queue3'></li>
				</div>
				<div class="mic_queue">
					<li><p>目前排麥人數</p></li>
					<li><img src="image/line.png"></li>
					<li><p id="MicCount"></li>
				</div>
				<div id="get_mic">
					<li><input type="button" onclick="show(this)" value="我要排MIC" id="Mic"><p id="qwer"></li>
				</div>
	<script type="text/javascript">
	function test33(){
			<?php
				//include("mysql_connect.php");
				$sql="SELECT count(Mic_ID) FROM Mic where Mic_ID is not null";
				$result=mysql_query($sql);
				$row=mysql_fetch_row($result);
				$sql2="SELECT User_ID From Mic Where Mic_ID is not null ORDER BY  `Mic_ID` ASC ";
				$result2=mysql_query($sql2);

			?>
			var CountMic='<?php echo $row[0] ?>';
			var singer='<?php echo mysql_result($result2, 0)?>';
			var queue1='<?php echo mysql_result($result2, 1)?>';
			var queue2='<?php echo mysql_result($result2, 2)?>';
			var queue3='<?php echo mysql_result($result2, 3)?>';
			document.getElementById("MicCount").innerHTML = CountMic;
			document.getElementById("singer").innerHTML=singer;
			document.getElementById("queue1").innerHTML = queue1;
			document.getElementById("queue2").innerHTML = queue2;
			document.getElementById("queue3").innerHTML = queue3;
		}
		test33();
	document.getElementById("Mic").onclick = function() {
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

                    if (data.aaa) {
                        document.getElementById("qwer").innerHTML = data.aaa;
                    }
                    else if(data.bbb){
                    	document.getElementById("qwer").innerHTML = data.bbb;
                    }
                    else {
                        document.getElementById("qwer").innerHTML = data.msg;
                    }
                }
            } else {
                alert("發生錯誤: " + request.status);
            }
        }
    }
}
</script>
				<div class="clear"></div>
				<div id="chatContent" class="chatroom">

				</div>
				<input id="chatInput" type="text" placeholder="留言......" class="reply"></input>

			</div>
		</div>
	</div>
	<div class="footer_space">
	<footer>
		<h3>MicMusic</h3>
		<p>© 2016 All rights reserved.</p>
		<p>NUKIM 106專題開發</p>
		<ul>
			<li><a href="battle"><img src="image/battle_chosen.png"></a></li>
			<li><a href="channel"><img src="image/personal.png"></a></li>
			<li><a href="personalinf"><img src="image/person_info.png"></a></li>
			<li><a href="setting"><img src="image/setting.png"></a></li>
		</ul>
	</footer>
	</div>
</body>
</html>
