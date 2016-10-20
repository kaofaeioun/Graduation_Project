<?php
	$gb_DBname="MICMUSIC";
    $gb_DBuser="root";
    $gb_DBpass="qwerqwer";
    $gb_DBHOSTname="140.127.218.201";
    $SESS_DBH="";
    $SESS_LIFE=get_cfg_var("session.gc_maxlifetime");
function sess_open($save_path,$session_name){
global $gb_DBHOSTname,$gb_DBname,$gb_DBuser,$gb_DBpass,$SESS_DBH;
if(!$SESS_DBH=mysql_pconnect($gb_DBHOSTname,$gb_DBuser,$gb_DBpass)){
echo "<li>MySql Error:".mysql_error()."<li>";
die();
}
if(!mysql_select_db($gb_DBname,$SESS_DBH)){
echo "<li>MySql Error:".mysql_error()."<li>";
die();
}
return true;
}
function sess_close(){
return true;
}
function sess_read($key){
global $SESS_DBH,$SESS_LIFE;
$qry="select value from db_session where sesskey = '$key' and expiry > ".time();
$qid=mysql_query($qry,$SESS_DBH);
if(list($value)=mysql_fetch_row($qid)){
return $value;
}
return false;
}
function sess_write($key,$val){
global $SESS_DBH,$SESS_LIFE;
$expiry=time()+$SESS_LIFE;
$value=$val;
$qry="insert into db_session values('$key',$expiry,'$value')";
$qid=mysql_query($qry,$SESS_DBH);
if(!$qid){
$qry="update db_session set expiry=$expiry, value='$value' where sesskey='$key' and expiry >".time();
$qid=mysql_query($qry,$SESS_DBH);
}
return $qid;
}
function sess_destroy($key){
global $SESS_DBH;
$qry="delete from db_session where sesskey = '$key'";
$qid=mysql_query($qry,$SESS_DBH);
return $qid;
}
function sess_gc($maxlifetime){
global $SESS_DBH;
$qry="delete from db_session where expiry < ".time();
$qid=mysql_query($qry,$SESS_DBH);
return mysql_affected_rows($SESS_DBH);
}
session_module_name();
session_set_save_handler("sess_open","sess_close","sess_read","sess_write","sess_destroy","sess_gc");
?>
?>