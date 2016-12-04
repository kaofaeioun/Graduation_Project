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
					<li><a href="setting.php"><img src="image/rules.png" width="15%"> &nbsp<b>規則說明</b></a></li>
				</ul>
			</div>
		</div>
	</div>
	<hr>
	<div class="wrap">
		<div id="content">
			<ul>
				<li>
					<h2>大亂鬥頻道選擇<b>/</b><br>Battle Choice</h2>
					<div class="bar">
						<ul>
							<li><a href="battle_channel_1.php"><div class="battle_channel" style="background: #FF2D2D;"></div></a><p>頻道1</p>
							<div class="qwerqwer">
								<div class="qwer">目前人次：</div>
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
							</div>
							
							<br>
							<div class="aaaa">
								<div class="qwer">排麥人數：</div>
								<div class="cccc">
									<?PHP
										$sql="SELECT COUNT(User_ID) FROM Mic";
										$result=mysqli_query($link,$sql);
										@$row=mysqli_fetch_array($result);
										echo $row[0];
									?>
								</div>
							</div>
							
								
							</li>					
						</ul>
					</div>
				</li>
				<li>
					<h2>排行榜<b>/</b><br>TOP 10</h2>
					<div class="top5">
						<div class="subtitle">
							<h5>ID</h5>
							<h6>勝場數</h6>
						</div>
						<ul>
							<?PHP
								$sqlphoto="SELECT Level From User Order by User_Wins DESC";
                                $resultphoto = mysqli_query($link,$sqlphoto);
  								$singerphoto[1]=mysqli_result($resultphoto, 0,0);
								$singerphoto[2]=mysqli_result($resultphoto, 1,0);
								$singerphoto[3]=mysqli_result($resultphoto, 2,0);
								$singerphoto[4]=mysqli_result($resultphoto, 3,0);
								$singerphoto[5]=mysqli_result($resultphoto, 4,0);                              
								$sql="SELECT User_ID From User Order by User_Wins DESC";
								$result=mysqli_query($link,$sql);
								$singer[1]=mysqli_result($result, 0,0);
								$singer[2]=mysqli_result($result, 1,0);
								$singer[3]=mysqli_result($result, 2,0);
								$singer[4]=mysqli_result($result, 3,0);
								$singer[5]=mysqli_result($result, 4,0);

								$sql2="SELECT User_Wins From User Order by User_Wins DESC";
								$result2=mysqli_query($link,$sql2);
								$point[1]=mysqli_result($result2, 0,0);
								$point[2]=mysqli_result($result2, 1,0);
								$point[3]=mysqli_result($result2, 2,0);
								$point[4]=mysqli_result($result2, 3,0);
								$point[5]=mysqli_result($result2, 4,0);
								for ($i=1; $i < 6; $i++) {
									echo "<li><div class='top_title'>".$i. "</div>";
								if ($singerphoto[$i]=='無階級') {
                                    echo "<img src='image/bronze.png'>";
                                }elseif ($singerphoto[$i]=='銅MIC I') {
                                    echo "<img src='image/bronze_1.png'>";
                                }elseif ($singerphoto[$i]=='銅MIC II') {
                                    echo "<img src='image/bronze_2.png'>";
                                }elseif ($singerphoto[$i]=='銅MIC III') {
                                    echo "<img src='image/bronze_3.png'>";
                                }elseif ($singerphoto[$i]=='銀Mic I') {
                                    echo "<img src='image/silver_1.png'>";
                                }elseif ($singerphoto[$i]=='銀Mic II') {
                                    echo "<img src='image/silver_2.png'>";
                                }elseif ($singerphoto[$i]=='銀Mic III') {
                                    echo "<img src='image/silver_3.png'>";
                                }elseif ($singerphoto[$i]=='金Mic I') {
                                    echo "<img src='image/golden_1.png'>";
                                }elseif ($singerphoto[$i]=='金Mic II') {
                                    echo "<img src='image/golden_2.png'>";
                                }elseif ($singerphoto[$i]=='金Mic III') {
                                    echo "<img src='image/golden_3.png'>";
                                }elseif ($singerphoto[$i]=='白金Mic I') {
                                    echo "<img src='image/platnum_1.png'>";
                                }elseif ($singerphoto[$i]=='白金Mic II') {
                                    echo "<img src='image/platnum_2.png'>";
                                }elseif ($singerphoto[$i]=='白金Mic III') {
                                    echo "<img src='image/platnum_3.png'>";
                                }elseif ($singerphoto[$i]=='鑽石Mic I') {
                                    echo "<img src='image/diamond_1.png'>";
                                }elseif ($singerphoto[$i]=='鑽石Mic II') {
                                    echo "<img src='image/diamond_2.png'>";
                                }elseif ($singerphoto[$i]=='鑽石Mic III') {
                                    echo "<img src='image/diamond_3.png'>";
                                }
									echo "<a href='fans.php?name=".$singer[$i]."'>".$singer[$i]."</a><div class='cool'>".$point[$i]."</div></li>";
								}
								function mysqli_result($res, $row, $field=0) {
								    $res->data_seek($row);
								    $datarow = $res->fetch_array();
								    return $datarow[$field];
								}
							?>
						</ul>
					</div>

					<script>
		                $(document).ready(function(){
		                    $(".top_slide").click(function(){
		                        $(".top10").slideToggle("slow");
		                    });
		                });
		            </script>
		            
					<p class="top_slide">第6~10名</p>
					<div class="top10">
						<ul>
							<?PHP
								$sqlphoto="SELECT Level From User Order by User_Wins DESC";
                                $resultphoto = mysqli_query($link,$sqlphoto);
  								$singerphoto[6]=mysqli_result($resultphoto, 5,0);
								$singerphoto[7]=mysqli_result($resultphoto, 6,0);
								$singerphoto[8]=mysqli_result($resultphoto, 7,0);
								$singerphoto[9]=mysqli_result($resultphoto, 8,0);
								$singerphoto[10]=mysqli_result($resultphoto, 9,0);
								$sql="SELECT User_ID From User Order by User_Wins DESC";
								$result=mysqli_query($link,$sql);
								$singer[6]=mysqli_result($result, 5,0);
								$singer[7]=mysqli_result($result, 6,0);
								$singer[8]=mysqli_result($result, 7,0);
								$singer[9]=mysqli_result($result, 8,0);
								$singer[10]=mysqli_result($result, 9,0);

								$sql2="SELECT User_Wins From User Order by User_Wins DESC";
								$result2=mysqli_query($link,$sql2);
								$point[6]=mysqli_result($result2, 5,0);
								$point[7]=mysqli_result($result2, 6,0);
								$point[8]=mysqli_result($result2, 7,0);
								$point[9]=mysqli_result($result2, 8,0);
								$point[10]=mysqli_result($result2, 9,0);

								for ($i=6; $i < 11; $i++) {
									echo "<li><div class='top_title_2'>".$i."</div>";
									if ($singerphoto[$i]=='無階級') {
                                    echo "<img src='image/bronze.png'>";
                                }elseif ($singerphoto[$i]=='銅MIC I') {
                                    echo "<img src='image/bronze_1.png'>";
                                }elseif ($singerphoto[$i]=='銅MIC II') {
                                    echo "<img src='image/bronze_2.png'>";
                                }elseif ($singerphoto[$i]=='銅MIC III') {
                                    echo "<img src='image/bronze_3.png'>";
                                }elseif ($singerphoto[$i]=='銀Mic I') {
                                    echo "<img src='image/silver_1.png'>";
                                }elseif ($singerphoto[$i]=='銀Mic II') {
                                    echo "<img src='image/silver_2.png'>";
                                }elseif ($singerphoto[$i]=='銀Mic III') {
                                    echo "<img src='image/silver_3.png'>";
                                }elseif ($singerphoto[$i]=='金Mic I') {
                                    echo "<img src='image/golden_1.png'>";
                                }elseif ($singerphoto[$i]=='金Mic II') {
                                    echo "<img src='image/golden_2.png'>";
                                }elseif ($singerphoto[$i]=='金Mic III') {
                                    echo "<img src='image/golden_3.png'>";
                                }elseif ($singerphoto[$i]=='白金Mic I') {
                                    echo "<img src='image/platnum_1.png'>";
                                }elseif ($singerphoto[$i]=='白金Mic II') {
                                    echo "<img src='image/platnum_2.png'>";
                                }elseif ($singerphoto[$i]=='白金Mic III') {
                                    echo "<img src='image/platnum_3.png'>";
                                }elseif ($singerphoto[$i]=='鑽石Mic I') {
                                    echo "<img src='image/diamond_1.png'>";
                                }elseif ($singerphoto[$i]=='鑽石Mic II') {
                                    echo "<img src='image/diamond_2.png'>";
                                }elseif ($singerphoto[$i]=='鑽石Mic III') {
                                    echo "<img src='image/diamond_3.png'>";
                                }
									echo "<a href='fans.php?name=".$singer[$i]."'>".$singer[$i]."</a><div class='cool'>".$point[$i]."</div></li>";
								}
							?>
						</ul>
					</div>
				</li>
			</ul>
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
