<?php
header('Content-Type: application/json; charset=UTF-8');

include("mysql_connect.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    MicArrange();
   } 
function MicArrange(){
$id=$_COOKIE['userid'];
$sql = "SELECT * FROM Mic where User_ID = $id";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
if(isset($id) && $row[1]==null){
		$sql2="INSERT INTO Mic(User_ID,Battle_ID) values($id,'1')";
		$result2=mysql_query($sql2);
		$data=array("aaa"=>'請稍等片刻!');
}
else if(isset($id) && $row[1]!=null){
        $data=array("bbb"=>'您已排麥中');
}
else{
		echo json_encode(array('msg' => '尚未登入！')); 
        return;
	} 
echo isset($data) ? json_encode($data) : json_encode(array('msg' => '沒有該帳戶	！'));

}
?>