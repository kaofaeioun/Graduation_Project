<?php
header('Content-Type: application/json; charset=UTF-8');

//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("mysql_connect.php");
//搜尋資料庫資料
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    create();
   } 
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
function create(){
$id = $_POST['id'];
$pwd = $_POST['pwd'];
$repwd = $_POST['repwd'];
$name = $_POST['name'];
$mail = $_POST['mail'];
$hobby = $_POST['hobby'];
$favsinger = $_POST['favsinger'];

$sql = "SELECT * FROM User where User_ID = $id";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
if($id==null){
		echo json_encode(array('msg' => '請輸入帳號！'));
        return;  
}
else if($row[0] == $id ){
        echo json_encode(array('msg' => '此帳戶已有人用過！'));
        return;  
}
else if($pwd==null) {
		echo json_encode(array('msg' => '密碼未填！'));
        return;
}
else if($repwd==null){
		echo json_encode(array('msg' => '確認密碼未填！'));
		return;
}
else if($pwd!=$repwd){ 
       	echo json_encode(array('msg' => '再次輸入密碼！'));
       	return;
}
else if($name==null){
		echo json_encode(array('msg' => '名字未填！'));
        return;
}
else if($mail==null){
		echo json_encode(array('msg' => '信箱未填！'));
        return;
}
else if($hobby==null){
		echo json_encode(array('msg' => '興趣未填！'));
        return;
}
else if($favsinger==null){
		echo json_encode(array('msg' => '喜愛歌手未填！'));
        return;
}

else{
	$sql2="INSERT INTO `User`(User_ID,User_PWD,User_Name,Email,Hobby,Fav_Singer) VALUES($id,$pwd,$name,$mail,$hobby,$favsinger)";
	$result2=mysql_query($sql2);
	$data =array('id'=>$id,'pwd'=>$pwd ,'conpwd'=>$conpwd,'name'=>$name);

}
	echo isset($data) ? json_encode($data) : json_encode(array('msg' => 'OK！'));
}

?>
