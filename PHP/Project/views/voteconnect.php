<?php
header('Content-Type: application/json; charset=UTF-8');
include("mysql_connect.php");	

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
    like();
   }
   if ($_SERVER['REQUEST_METHOD'] == "GET") {
    dislike();
   } 
function like(){
	$id=$_COOKIE['userid'];
	$sql1 = "SELECT * FROM Vote where User_ID =$id";
	$result1=mysql_query($sql1);
	$row1 = mysql_fetch_row($result1);
	if(isset($id) && $row1[1]==null){
			$sql2="INSERT INTO Vote(User_ID,Battle_ID,Result) values($id,'1','1')";
			$result2=mysql_query($sql2);
			$sql3="SELECT count(Result) FROM Vote where Result ='1'";
			$result3=mysql_query($sql3);
			$row2=mysql_fetch_row($result3);
			$data=array("like"=>$row2[0]);
	}
	else if (isset($id) && $row1[1]!=null) {
			$sql3="SELECT count(Result) FROM Vote where Result ='1'";
			$result3=mysql_query($sql3);
			$row2=mysql_fetch_row($result3);
			$data=array("havevote"=>$row2[0]);
			
		}
	else{
		echo json_encode(array('msg' => '尚未登入！')); 
        return;
	}
	echo isset($data) ? json_encode($data) : json_encode(array('msg' => 'zz'));

}
function dislike(){
	$id=$_COOKIE['userid'];
	$sql1 = "SELECT * FROM Vote where User_ID =$id";
	$result1=mysql_query($sql1);
	$row1 = mysql_fetch_row($result1);
	if(isset($id) && $row1[1]==null){
			$sql2="INSERT INTO Vote(User_ID,Battle_ID,Result) values($id,'1','2')";
			$result2=mysql_query($sql2);
			$sql3="SELECT count(Result) FROM Vote where Result ='2'";
			$result3=mysql_query($sql3);
			$row2=mysql_fetch_row($result3);
			$data=array("dislike"=>$row2[0]);
	}
	else if (isset($id) && $row1[1]!=null) {
			$sql3="SELECT count(Result) FROM Vote where Result ='2'";
			$result3=mysql_query($sql3);
			$row2=mysql_fetch_row($result3);
			$data=array("havevote"=>$row2[0]);
			
		}
	else{
		echo json_encode(array('msg' => '尚未登入！')); 
        return;
	}
	echo isset($data) ? json_encode($data) : json_encode(array('msg' => 'zz'));

}
?>