<!DOCTYPE html>
<!--聽歌頁面-->
<html lang="en">
<head>
	<?php
		include("mysql_connect.php");
		$id=$_COOKIE['account'];
		$sql1 = "SELECT User_Name FROM User where User_ID = $id";
		$result1 = mysqli_query($link, $sql1);
		$row1 = mysqli_fetch_row($result1);
	?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/battle_channel_1.css">
	<link rel="stylesheet" href="CSS/all.css">
	<link rel="Shortcut icon" type="image/x-icon" href="image/favicon.ico">
	<script>
		var client = { //is observerd
			"pp" : "../img/profile.jpg", //Profil Pic
			"nn" : "<?php echo $row1[0];?>", //Nickname
			"mg" : 4/100, // minGain
			"mic" : false,
			"sound" : true
		}
	</script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="./js/jquery.nouislider.min.js"></script>
	<script type="text/javascript" src="./js/material.min.js"></script>
	<script type="text/javascript" src="./js/main.js"></script>
	<script type="text/javascript" src="./js/ripples.min.js"></script>
	<script type="text/javascript" src="./js/smooth.js"></script>
	<script type="text/javascript" src="./js/resampler.js"></script>
	<script type="text/javascript" src="./js/voip.js"></script>
	<title>MicMusic</title>
</head>

<body>
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script type="text/javascript">
		<?php include("mysql_connect.php");
			if(!isset($_COOKIE['account'])): ?>
				$(document).ready(function(){
					$('#user').hide();
					$('#login').show();
				});
		<?php else: $id=$_COOKIE['account']; ?>
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
								<input type="button" class="logout" value="登出"onclick="location='logoutconnect.php'">
							</div>
					</div>
				</div>
				<div class="search">
					<input type="text" class="search_blank" placeholder="輸入ID找歌手">
					<input type="image" class="search_image" src="image/search.png" alt="submit">
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
							<div class="vote_like" id="like"></div>
							<div class="vote_dislike" id="dislike"></div>

							<script>
								var like_vote = 0,
								    dislike_vote = 0,
								    total_vote,like_R,dislike_R;

								function CountLikeVote() {
								  return like_R = like_vote / total_vote;
								  console.log(like_R);
								};
								function CountDislikeVote() {
								  return dislike_R = dislike_vote / total_vote;
								  console.log(dislike_R);
								};
								/* Body插入svg g標籤*/
								var svg = d3.select("body .board")
									.append("svg")
									.append("g");
								/*設定長寬、圓半徑*/
								var width = 200,
								    height = 200,
								    radius = 100;
								/*D3內建layout Pie套件，並輸入資料。*/
								var pie = d3.layout.pie()
									.sort(null)
									.value(function(d) {return d.value;});
								/*D3內建svg Arc套件，並輸入內外圓半徑*/
								var arc = d3.svg.arc()
									.outerRadius(radius * 1)
								  .innerRadius(radius * 0.75);

								svg.append("g")
									.attr("class", "fans");
								svg.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

								var key = function(d){ return d.data.label; };

								d3.select("#like").on("click", function(){
								    like_vote = like_vote + 1;
								    Votes(CountLikeVote());
								});
								d3.select("#dislike").on("click", function(){
								    dislike_vote = dislike_vote + 1;
								    Votes(CountDislikeVote());
								});

								function Votes(data) {
								  total_vote = like_vote + dislike_vote;
								  var dataset = [
								  			{label:"Dislike", value:CountDislikeVote(), color:"#ED1B2E"},
								        {label:"Like", value:CountLikeVote(), color:"#376FFF"}
								  		];
								  var fan = svg.select(".fans").selectAll("path.fan")
								    .data(pie(dataset));

								  fan.enter()
								    .insert("path")
								    .style("fill", function (d) {return d.data.color;})
								    .attr("class", "fan");

								  fan.transition().duration(1000)
								  	.attrTween("d", function(d) {
								  		this._current = this._current || d;
								  		var interpolate = d3.interpolate(this._current, d);
								  		this._current = interpolate(10);
								  		return function(t) {
								      	return arc(interpolate(t));
								  		};
								  	})

								  	fan.exit()
								  	.remove();
								}
							</script>
						</div>
					</div>
					<!--投票開始-->
					
					<!-- 小視窗 -->
					<script>
						$(document).ready(function(){
  							$('.square').hide();
  								//隱藏要呼叫的div
  							$('#pic').click(function(){
  								//指定呼叫按鈕
    							$('.square').fadeToggle(500);
    							//顯示隱藏的div
    							$('.square').delay(800).fadeOut(500);
  							});
						});
					</script>
					<!-- 圖變色 -->
					<script>
						function changeSrc(){
							var imgObj = document.getElementById("pic");
							if (imgObj.getAttribute("src",2) == "image/cancerlike.png"){
	  							imgObj.src = "image/like.png";
							}
							else{
								imgObj.src = "image/cancerlike.png";
							}
						}
					</script>

					<div class="track"><img src="image/cancerlike.png" original title="我要追蹤" id="pic" onclick="changeSrc()"><b id="singer"></b>
						<div class="square">
							<span class="arrow_top_int"></span>
							追蹤成功!
						</div>
					</div>
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
					/*	function CheckMic(){
							if (s==0){
								var request = new XMLHttpRequest();
				    			request.open("POST", "checkmic.php");
				    			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				    			request.send();
								}
								setTimeout("CheckMic()",1000);
							}
										CheckMic();*/
					</script>

					<script>
						$(document).ready(function(){
							$("#like").click(function(){
								$("#like").fadeOut();
								$("#dislike").fadeOut();
							});
							$("#dislike").click(function(){
									$("#like").fadeOut();
									$("#dislike").fadeOut();
							});
						});
					</script>

				<div class="queue">
					<li><p id='queue1'></p></li>
					<li><p id='queue2'></p></li>
					<li><p id='queue3'></p></li>
				</div>
				<div class="mic_queue">
					<li><p>目前排麥人數</p></li>
					<li><img src="image/line.png"></li>
					<li><p id="MicCount"></p></li>
				</div>
				<?php
					$id = $_COOKIE['account'];
					$sql = "SELECT User_ID FROM Mic where User_ID='$id'";
					$result=mysqli_query($link,$sql);
					$row = mysqli_fetch_row($result);
					if (isset($row[0])) {
					echo "<div class='get_mic'>
						<li><input type='checkbox' id='GottentMic' checked><p id='qwer' chec></p></li>
					</div>";
					}
					else{
					echo "<div class='get_mic'>
						<li><input type='checkbox' id='GetMic'><p id='qwer'></p></li>
					</div>";
					}
				?>
<script type="text/javascript">
function CountMic(){
		var request = new XMLHttpRequest();
		request.open("POST", "countmic.php");
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
					if(data.Singer){
						document.getElementById("singer").innerHTML = data.Singer;
					}
					if(data.Singer1){
						document.getElementById("queue1").innerHTML = data.Singer1;
					}
					if(data.Singer2){
						document.getElementById("queue2").innerHTML = data.Singer2;
					}
					if(data.Singer3){
						document.getElementById("queue3").innerHTML = data.Singer3;
					}
				}
			} else {
				alert("發生錯誤: " + request.status);
			}
		}
	}
}
	CountMic();
	</script>

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
