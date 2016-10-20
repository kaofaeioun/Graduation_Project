<?php
header('Content-Type: application/json; charset=UTF-8');

//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("mysql_connect.php");


//搜尋資料庫資料
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    search();
   } 
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
function search(){
$id = $_POST['id'];
$pwd = $_POST['pwd'];
$sql = "SELECT * FROM User where User_ID = $id";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
if($id != null && $pwd != null && $row[0] == $id && $row[1] == $pwd)
{
        //將帳號寫入session，方便驗證使用者身份
		$name=$row[2];
        setcookie('userid',$id,time()+3600);
        $data =array('id'=>$id,'pwd'=>$pwd ,'name'=>$name);
}
else
{
        echo json_encode(array('msg' => '登入失敗！'));
        return;
}
echo isset($data) ? json_encode($data) : json_encode(array('msg' => '沒有該帳戶	！'));

}
?>