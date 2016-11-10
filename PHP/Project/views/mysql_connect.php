<?php
$db_server = "140.127.220.144";
$db_name = "MICMUSIC";
$db_user = "kaofaeioun";
$db_passwd = "qwerqwer";
$link = mysqli_connect($db_server, $db_user, $db_passwd,$db_name);
mysqli_query($link,"SET NAMES UTF8");
if(mysqli_connect_errno($link)){
	die("Can not connect DB");
}
        
if(!mysqli_select_db($link, $db_name))
        die("Can not use DB");
?>
