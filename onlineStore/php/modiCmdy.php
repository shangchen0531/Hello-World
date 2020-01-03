<?php
	header("Content-type: text/xml");
	include("conn/conn.php");
	echo "<?xml version='1.0'?>";
	echo "<PHP>";
	$modiAttriibute = $_GET['cla'];
	$cmdyID = $_GET['cid'];
	$data = $_GET['data'];
	$sql = "update commodity set $modiAttriibute = '$data' where cmdyID = $cmdyID";
	$result = mysqli_query($conn, $sql);
	if($result){
		if(mysqli_affected_rows($conn) > 0){
			echo "<result>true</result>";
		}
		else{ echo "<result>false</result>"; }
	}
	else{
		echo "<result>false</result>";
	}
	echo "</PHP>";
?>