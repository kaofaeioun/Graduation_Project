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
                location.replace("login.php");
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
                    <li><a href="setting.php"><img src="image/menu_setting.png" width="15%"> &nbsp<b>設定</b></a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div class="wrap">
        <div class="content">
            <h2>設定<b>/</b><br>Settings</h2>
            <h4>個人帳號設定</h4>
            <div class="setting_person">
                <ul>
                    <li>
                        <p>公開個人資料</p>
                        <div class="button-wrap" id="btn_1">
                            <div class="button-bg">
                              <div class="button-out"></div>
                              <div class="button-in"></div>
                              <div class="button-switch"></div>
                            </div>
                        </div>
                        <script>
                            $('#btn_1').on("click", function(){
                              $(this).toggleClass('button-active');
                            });
                        </script>
                        <div class="clear"></div>
                    </li>
                </ul>
            </div>
                
            <h4>頻道設定</h4>
            <div class="setting_person">
                <ul>
                    <li>
                        <p>追蹤通知</p>
                        <div class="button-wrap" id="btn_2">
                            <div class="button-bg">
                              <div class="button-out"></div>
                              <div class="button-in"></div>
                              <div class="button-switch"></div>
                            </div>
                        </div>
                        <script>
                            $('#btn_2').on("click", function(){
                              $(this).toggleClass('button-active');
                            });
                        </script>
                    </li>
                    <div class="clear"></div>
                    <li>
                        <p>被追蹤通知</p>
                        <div class="button-wrap" id="btn_3">
                            <div class="button-bg">
                              <div class="button-out"></div>
                              <div class="button-in"></div>
                              <div class="button-switch"></div>
                            </div>
                        </div>
                        <script>
                            $('#btn_3').on("click", function(){
                              $(this).toggleClass('button-active');
                            });
                        </script>
                    </li>
                    <div class="clear"></div>
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
                <li><a href="setting.php"><img src="image/setting_chosen.png"></a></li>
            </ul>
        </footer>
    </div>
    </body>
</html>