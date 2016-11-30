<?php
header('Content-Type: application/json; charset=UTF-8');
include('mysql_connect.php');
	$id=$_GET['id'];
	$sql2="SELECT count(Mic_ID) FROM Mic where Mic_ID is not null";
	$result2=mysqli_query($link,$sql2);
	$row2=mysqli_fetch_row($result2);
	$sql3="SELECT User_ID From Mic Where Mic_ID is not null ORDER BY  `Mic_ID` ASC ";
	$result3=mysqli_query($link,$sql3);
	$singer=mysqli_result($result3, 0,0);
	$singer1=mysqli_result($result3, 1,0);
	$singer2=mysqli_result($result3, 2,0);
	$singer3=mysqli_result($result3, 3,0);

	$sql4="SELECT User_Name From User Where User_ID='$singer'";
	$sql5="SELECT User_Name From User Where User_ID='$singer1'";
	$sql6="SELECT User_Name From User Where User_ID='$singer2'";
	$sql7="SELECT User_Name From User Where User_ID='$singer3'";
	$result4=mysqli_query($link,$sql4);
	$result5=mysqli_query($link,$sql5);
	$result6=mysqli_query($link,$sql6);
	$result7=mysqli_query($link,$sql7);
	$singerName=mysqli_fetch_row($result4);
	$singer1Name=mysqli_fetch_row($result5);
	$singer2Name=mysqli_fetch_row($result6);
	$singer3Name=mysqli_fetch_row($result7);

	$sql8="SELECT * FROM Vote where User_ID='$id'&& Mic_ID='$singer'";
	$result8=mysqli_query($link,$sql8);
	$voteResult=mysqli_fetch_row($result8);
	if($id==$singer){
		$sql9="UPDATE User SET `User_Status`='1' where `User_ID`='$id'";
		$result9=mysqli_query($link,$sql9);
	}
	$sql10="SELECT User_Status FROM User where User_ID='$id'";
	$result10=mysqli_query($link,$sql10);
	$statusresult=mysqli_fetch_row($result10);
	$sql11="SELECT COUNT(Tracked_ID) as total FROM Track where Tracked_ID='$singer'";
	$result11 = mysqli_query($link,$sql11);
	$row11 = mysqli_fetch_assoc($result11);
	$sql12="SELECT MicOrder
		FROM (SELECT a1.Mic_ID,a1.User_ID, COUNT(a2.Mic_ID ) MicOrder
		FROM Mic a1, Mic a2
		WHERE a1.Mic_ID >= a2.Mic_ID
        GROUP BY a1.Mic_ID, a1.User_ID
		ORDER BY  a1.Mic_ID ASC
		) AS ZZZ
		WHERE User_ID =  '$id'";
	$result12=mysqli_query($link,$sql12);	
	$row12=mysqli_fetch_row($result12);

function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field];    
}	
	$data =array('MicCount'=>$row2[0],'Singer'=>$singer,'SingerName'=>$singerName[0],'Singer1'=>$singer1,'Singer1Name'=>$singer1Name[0],'Singer2'=>$singer2,'Singer2Name'=>$singer2Name[0] ,'Singer3'=>$singer3,'Singer3Name'=>$singer3Name[0],'VoteResult'=>$voteResult[0],'StatusResult'=>$statusresult[0],'TrackedNum'=>$row11['total'],'MicOrder'=>$row12[0]);

 	echo isset($data) ? json_encode($data) : json_encode(array('msg' => 'error！'));

?>