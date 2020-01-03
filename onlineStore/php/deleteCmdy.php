<?php
	include('conn/conn.php');
	$cid = $_GET['cid'];
	$sql = "delete from commodity where cmdyID = $cid";
	$result = mysqli_query($conn, $sql);
	if($result && mysqli_affected_rows($conn) > 0){
		echo "<script>alert('删除成功！'); history.go(-1);</script>";
	}
	else{
		echo "<script>alert('删除失败！<br>$sql); history.go(-1);</script>";
	}
?>