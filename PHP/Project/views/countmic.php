<?php
header('Content-Type: application/json; charset=UTF-8');
include('mysql_connect.php');
$sql2="SELECT count(Mic_ID) FROM Mic where Mic_ID is not null";
	$result2=mysqli_query($link,$sql2);
	$row2=mysqli_fetch_row($result2);
	$sql3="SELECT User_ID From Mic Where Mic_ID is not null ORDER BY  `Mic_ID` ASC ";
	$result3=mysqli_query($link,$sql3);
	$singer=mysqli_result($result3, 0,0);
	$singer1=mysqli_result($result3, 1,0);
	$singer2=mysqli_result($result3, 2,0);
	$singer3=mysqli_result($result3, 3,0);
   
function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field];    
}	
	

	$data =array('MicCount'=>$row2[0],'Singer'=>$singer,'Singer1'=>$singer1,'Singer2'=>$singer2 ,'Singer3'=>$singer3);

 	echo isset($data) ? json_encode($data) : json_encode(array('msg' => 'error！'));

?>