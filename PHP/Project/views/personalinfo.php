<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="http://fonts.googleapis.com/css?family=Cabin:400,500,600,bold" rel="stylesheet" type="text/css" >
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,bold" rel="stylesheet" type="text/css" >
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="CSS/personalinfo.css">
	<link rel="stylesheet" href="CSS/all.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="./js/pic_adjust.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"><!-- search -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  <!-- search -->
	<title>MicMusic</title>
</head>
<body>
	<script type="text/javascript">
		<?php include("mysql_connect.php");
			if(!isset($_COOKIE['account'])): ?>	
				location.replace("login.php");
		<?php else: $id=$_COOKIE['account']; ?>
			$(document).ready(function(){
				$('#user').show();
				PicAutoMid();
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

			<div class="profile_pic">
				<form action="" method="POST" enctype="multipart/form-data">
				<div class="dialog">
					<input type="submit" class="send" value="確定" id="send">
					<input type="button" class="cancel" value="取消" onclick="loadImageFileCancel()">				
				</div>
				<div class="change_ok">更換成功!</div>
				<div class="change_fail">更換失敗，請上傳小於2MB之照片!</div>
				<img src="photo.php?id=<?php echo $id?>" id="userimg">
				<span class="upload_area"><img src="image/camera.png" width="28px" height="25px" style="padding-top: 4px">&nbsp 更換大頭貼照</span>
				<input type="file" name="upload" id="upload" onchange="loadImageFile()"/>
			</div>
			
			<!-- 傳圖片到資料庫 -->
			<?php
				if(isset($_COOKIE['account'])){
					if(isset($_FILES["upload"]["size"])){
						if ($_FILES["upload"]["size"]<2000000&&$_FILES["upload"]["size"]>0){
						$id=$_COOKIE['account'];	
				        $file = fopen($_FILES["upload"]["tmp_name"], "rb");
				        $fileContents = fread($file, filesize($_FILES["upload"]["tmp_name"]));
				        fclose($file);
				        $fileContents = base64_encode($fileContents);
				        $sql="UPDATE User SET Photo='$fileContents' Where User_ID='$id'";
				        $result=mysqli_query($link,$sql);
				        echo "<script>$('.change_ok').fadeIn(500)</script>";
				        echo "<script>$('.change_ok').delay(800).fadeOut(500)</script>";
					}
					else if($_FILES["upload"]["size"]>2000000||$_FILES["upload"]["size"]==0){
						echo "<script>$('.change_fail').fadeIn(500)</script>";
				        echo "<script>$('.change_fail').delay(800).fadeOut(500)</script>";
						}
					}
				}		
			?>
			<!-- END -->


			<!-- 預覽圖片 -->
			<script type="text/javascript">
				oFReader = new FileReader(), rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-windowdump)$/i;//判別檔案類型
				oFReader.onload = function (oFREvent) {
					ErasePadding();
			    	document.getElementById("userimg").src = oFREvent.target.result;
			    	PicAutoMid();
				};//檔名
				function loadImageFile() {
					if (document.getElementById("upload").files.length === 0){return;}//沒有上傳即return
						var oFile = document.getElementById("upload").files[0];
					if (!rFilter.test(oFile.type)) { 
						alert("請上傳圖片");
						return;
					}else {
						$(function checkwindow(){
							$(".dialog").fadeIn();
							oFReader.readAsDataURL(oFile);
							PicAutoMid();
						});
					}				
				}
				function loadImageFileCancel(){
					$(".dialog").fadeOut();
					document.getElementById("userimg").src ="photo.php?id=<?php echo $id?>" ;
					PicAutoMid();
				}	
			</script>
			<!-- END -->
							<ul id="track_list">
								<li>

									<nav id="nav-1">
									  <a class="link-1" href="fansMenu_Followers.php"><b>追蹤名單</b>
									  <?php
										$sql2="SELECT COUNT(Track_ID) as total FROM Track where Track_ID='$id'";
										$trackresult = mysqli_query($link,$sql2);
										$row2 = mysqli_fetch_assoc($trackresult);
										echo $row2['total'];
									  ?>
									  </a>
									</nav>
									<img src="image/track.png" alt=""><br>
									
									</a>	
								</li>

								<li>
									<nav id="nav-1">
									  <a class="link-1" href="fansMenu_Fans.php"><b>粉絲名單</b>
									  <img src="image/tracked.png" alt=""><br>
									  <?php
										$sql2="SELECT COUNT(Track_ID) as total FROM Track where Tracked_ID='$id'";
										$trackresult = mysqli_query($link,$sql2);
										$row2 = mysqli_fetch_assoc($trackresult);
										echo $row2['total'];
									  ?>
									  </a>
									</nav>
									
									
									</a>
								</li>
								<li class="wins"><b>勝場數</b>
								<img src="image/win.png" alt=""><br>
								<?PHP
	                                    $an = $_COOKIE['account'];
	                                    $sql="SELECT User_Wins From User where User_ID= '$an'";
	                                    $result = mysqli_query($link,$sql);
	                                    $row = mysqli_fetch_assoc($result);
	                                    echo $row['User_Wins'];
	                                ?>
								</li>
							</ul>
				<ul>
				<div class="profile">
						
							
						
						
					<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666 -->
						<script>
							$( document ).on( "click", "#change", function() {
							        $("#changename").slideToggle("slow");
							    });
						</script>
						<li>
							<b>用戶/ID</b>
							<div class="name_blank"><?php echo $id; ?></div>
						</li>
						<li>
							<b>姓名/Name</b>
							<div class="name_blank" id="showName"><?php echo $name; ?><img id="change" src="image/pen.png" alt=""></div>
						</li>
						<li id="changename">
							<b>修改姓名/Edit Name:</b>
							<div id="change_name_blank">
							
									<input type="text" id="correctinfo" placeholder="按此編輯你的姓名" required="" value='<?php echo $name; ?>' maxlength="12">
									<input type="button" id="changeinfoName" value="確定修改" >
							<script type="text/javascript">
							</script>
								
							<script type="text/JavaScript">
									document.getElementById("changeinfoName").onclick = function() {
											var x=document.getElementById("correctinfo").value;
										if(x.length==0){
											alert("姓名不得為空");
										}
										else{	
											var request = new XMLHttpRequest();
											request.open("GET", "changeinfo.php?changed=User_Name&correctinfo="+ document.getElementById("correctinfo").value);
											request.send();
 											document.getElementById("showName").innerHTML=document.getElementById("correctinfo").value+
 											"<img id='change' src='image/pen.png'>";
 											$("#changename").slideUp();
 										}
 									}			
							</script>

							</div>
						</li>
						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666 -->
						
						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666 -->
						<script>
							$( document ).on( "click", "#change1", function() {
							        $("#changeemail").slideToggle("slow");
							    });
						</script>
						<li>
							<b>電子郵件/E-mail</b>
							<div class="name_blank" id="showemail"><?php echo $email; ?><img id="change1" src="image/pen.png" ></div>
						</li>
						<li id="changeemail">
							<b>修改電子郵件/Edit E-mail:</b>
							<div id="change_name_blank">
							
									<input type="email" id="correctinfoEmail" placeholder="按此編輯你的E-mail" value="<?php echo $email; ?>" maxlength="30">
									<input type="button" id="changeinfoEmail" value="確定修改">
								
							<script type="text/JavaScript">
									document.getElementById("changeinfoEmail").onclick = function() {
										var y=document.getElementById("correctinfoEmail").value;
										if(y.length==0){
											alert("信箱不得為空");
										}
										else{
											var request = new XMLHttpRequest();
											request.open("GET", "changeinfo.php?changed=Email&correctinfo="+ document.getElementById("correctinfoEmail").value);
												request.send();
 									document.getElementById("showemail").innerHTML=document.getElementById("correctinfoEmail").value+
 											"<img id='change1' src='image/pen.png'>";
 											$("#changeemail").slideUp();
										}
									}	
							</script>

							</div>
						</li>

						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666 -->
						<script>
							$( document ).on( "click", "#change2", function() {
							        $("#changeHobby").slideToggle("slow");
							    });
						</script>
						<li>
							<b>興趣/Hobby</b>
							<div class="name_blank" id="showHobby"><?php echo $hobby; ?><img id="change2" src="image/pen.png" alt=""></div>
						</li>
						<li id="changeHobby">
							<b>修改興趣/Edit Hobby:</b>
							<div id="change_name_blank">
						
									<input type="text" id="correctinfoHobby" placeholder="按此編輯你的興趣" value="<?php echo $hobby; ?>"maxlength="20">
									<input type="button" id="changeinfoHobby" value="確定修改">
							
									
							<script type="text/JavaScript">
									document.getElementById("changeinfoHobby").onclick = function() {
											var request = new XMLHttpRequest();
											request.open("GET", "changeinfo.php?changed=Hobby&correctinfo="+ document.getElementById("correctinfoHobby").value);
												request.send();
 									document.getElementById("showHobby").innerHTML=document.getElementById("correctinfoHobby").value+
 											"<img id='change2' src='image/pen.png'>";
 											$("#changeHobby").slideUp();
											}
							</script>

							</div>
						</li>
						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666- -->
						<script>
							$( document ).on( "click", "#change3", function() {
							        $("#changeFavSinger").slideToggle("slow");
							    });
						</script>
						<li>
							<b>喜歡的歌手/Favorate Singer</b>
							<div class="name_blank" id="showFavSinger"><?php echo $favsinger;?><img id="change3" src="image/pen.png" alt=""></div>
						</li>
						<li id="changeFavSinger">
							<b>修改喜歡的歌手/Edit Favorate Singer:</b>
							<div id="change_name_blank">
							
									<input type="text" id="correctinfoFavSinger" placeholder="按此編輯喜歡的歌手" value="<?php echo $favsinger;?>" maxlength="20">
									<input type="button" id="changeinfoFavSinger" value="確定修改">
							
									
							<script type="text/JavaScript">
									document.getElementById("changeinfoFavSinger").onclick = function() {
											var request = new XMLHttpRequest();
											request.open("GET", "changeinfo.php?changed=Fav_Singer&correctinfo="+ document.getElementById("correctinfoFavSinger").value);
												request.send();
 									document.getElementById("showFavSinger").innerHTML=document.getElementById("correctinfoFavSinger").value+
 											"<img id='change3' src='image/pen.png'>";
 											$("#changeFavSinger").slideUp();
											}
							</script>

							</div>
						</li>
						<!-- 6666666666666666666666666666666666666666666666666666666666666666666666666666- -->
						<script>
							$( document ).on( "click", "#change4", function() {
							        $("#changeFav_Songs").slideToggle("slow");
							    });
						</script>
						<li>
							<b>喜歡的歌/Favorate Songs</b>
							<div class="name_blank" id="showFav_Songs"><?php echo $favsong;?><img id="change4" src="image/pen.png" alt=""></div>
						</li>
						<li id="changeFav_Songs">
							<b>修改喜歡的歌/Edit Favorate Songs:</b>
							<div id="change_name_blank">
							
									<input type="text" id="correctinfoFav_Songs" placeholder="按此編輯喜歡的歌" value="<?php echo $favsong;?>" maxlength="20">
									<input type="button" id="changeinfoFav_Songs" value="確定修改">
							
									
							<script type="text/JavaScript">
									document.getElementById("changeinfoFav_Songs").onclick = function() {
											var request = new XMLHttpRequest();
											request.open("GET", "changeinfo.php?changed=Fav_Songs&correctinfo="+ document.getElementById("correctinfoFav_Songs").value);
												request.send();
 									document.getElementById("showFav_Songs").innerHTML=document.getElementById("correctinfoFav_Songs").value+
 											"<img id='change4' src='image/pen.png'>";
 											$("#changeFav_Songs").slideUp();
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
			<li><a href="setting.php"><img src="image/rules.png"></a></li>
		</ul>
	</footer>
	</div>
</body>
</html>