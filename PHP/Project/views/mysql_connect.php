<?php
/*$db_server = "140.127.218.201";
$db_name = "MICMUSIC";
$db_user = "kaofaeioun";
$db_passwd = "qwerqwer";

if(!mysqli_connect($db_server, $db_user, $db_passwd,$db_name))
        die("無法對資料庫連線");

mysqli_query("SET NAMES utf8");

if(!mysqli_select_db($db_name))
        die("無法使用資料庫");*/
$servername = "140.127.218.201:3306";
$username = "kaofaeioun";
$password = "qwerqwer";
$dbnamne = "MICMUSIC";
// Create connection
$conn = new mysqli($servername, $username, $password);
mysql_select_db($dbname,$conn);
// Check connection
if(!mysql_ping ($conn)){
  if($conn->connect_error){
      die("連線失敗！！Connection failed: " . $conn->connect_error);
  }else{
      echo "連線成功！ Connected successfully";
  }
  $conn->close();
}else{
  echo "無法連線....";
}
?>
