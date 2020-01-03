<?php
	header("Content-type: text/xml");
	include("class/user.php");
	include("conn/conn.php");
	session_start();
	echo "<?xml version='1.0'?>";
	echo "<PHP>";
	if(!isset($_SESSION['user'])){ return ; }
	$u = $_SESSION['user'];
	$uid = $u->get_userID();
	$cid = $_GET['cid'];
	$sql = "delete from collect where userID = $uid and cmdyID = $cid";
	$result = mysqli_query($conn, $sql);
	if($result){
		echo "<result>true</result>";
	}
	else{
		echo "<result>false</result>";
	}
	echo "</PHP>";
?>