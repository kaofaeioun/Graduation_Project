<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="CSS/setting.css">
    <link rel="stylesheet" href="CSS/all.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"><!-- search -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script><!-- search -->
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
        <?php else: ?>
            $(document).ready(function(){
                $('#user').show();
            });
        <?php endif; $id=$_COOKIE['account']; ?>
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
        <div class="content">
            <h2>常見問題<b>/</b><br>MicMusic 大亂鬥暨積分階級規則</h2>
            <script> 
                $(document).ready(function(){
                    $(".question1").click(function(){
                        $("#setting_person1").slideToggle("slow");
                    });
                });
            </script>
            <h4 class="question1">Q1. 什麼是大亂鬥模式？</h4>
            <div class="setting_person" id="setting_person1">
                <ul>
                    <li>
                       在大亂鬥模式裡排麥進行唱歌後，會有60秒的時間試唱。在這60秒時間的前30秒過後，系統將會顯示投票按鈕讓頻道內的觀眾進行投票。而60秒一到，系統則會計算投票結果，並依據觀眾的投票比例顯示「成功」或「失敗」，決定演唱者能否續唱。演唱者能夠藉由大亂鬥模式獲得積分，贏取階級。
                    </li>
                </ul>
            </div>
           <!--  6666666666666666666666666666666666 -->
           <script> 
                $(document).ready(function(){
                    $(".question2").click(function(){
                        $("#setting_person2").slideToggle("slow");
                    });
                });
            </script>
            <h4 class="question2">Q2. 階級如何決定？</h4>
            <div class="setting_person" id="setting_person2">
                <ul>
                    <li>
                       使用者的階級由大亂鬥模式中續唱次數獲得的積分決定。系統將會判斷您的大亂鬥續唱次數，經計算之後給予演唱者階級。例：無階級晉升到銅Mic需要獲得2場續唱次數。
                    </li>
                </ul>
            </div>
            <!-- 666666666666666666666666666666666666666666 -->
            <script> 
                $(document).ready(function(){
                    $(".question3").click(function(){
                        $("#setting_person3").slideToggle("slow");
                    });
                });
            </script>
            <h4 class="question3">Q3. 階級如何分別？</h4>
            <div class="setting_person" id="setting_person3">
                <ul>
                    <li>
                       階級由低到高，分別為：無階級、銅 Mic、銀 Mic、金 Mic、白金 Mic、鑽石 Mic。<br>
                        <ul class="medalpic">
                            <li><img src="image/bronze.png" ><div class="words">▲ 銅 Mic</div></li>
                            <li><img src="image/silver.png" ><div class="words">▲ 銀 Mic</div></li>
                            <li><img src="image/golden.png" ><div class="words">▲ 金 Mic</div></li>
                            <li><img src="image/platnum.png" ><div class="words">▲ 白金 Mic</div></li>
                            <li><img src="image/diamond.png" ><div class="words">▲ 鑽石 Mic</div></li>
                        </ul>
                       其中每個階級再分為3個等級，3為最高。達到該階級等級3之後，再升一等即可晉升下一個階級。<br>
                       如：一位階級為銀3的使用者，再升一等後即可晉升為金1。<br>
                       演唱者在每個階級，皆會有屬於該階級的徽章。
                    </li>
                </ul>
            </div>
            <!-- 666666666666666666666666666666666666666666666 -->
            <script> 
                $(document).ready(function(){
                    $(".question4").click(function(){
                        $("#setting_person4").slideToggle("slow");
                    });
                });
            </script>
            <h4 class="question4">Q4. 階級能為演唱者帶來什麼？</h4>
            <div class="setting_person" id="setting_person4">
                <ul>
                    <li>
                       個人台：演唱者需要金MIC階級以上，才能獲得開啟個人台經營的權利。 <br>
                       排行榜：每月MicMusic將會依照階級推出新的排行榜，演唱者可以透過爬到更高的階級，在排行榜上嶄露頭角，吸引更多追隨者。

                    </li>
                </ul>
            </div>
                
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
                <li><a href="personalinfo.php"><img src="image/person_info.png"></a></li>
                <li><a href="setting.php"><img src="image/rules_chosen.png"></a></li>
            </ul>
        </footer>
    </div>
    </body>
</html>