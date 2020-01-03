<?php
	header("Content-type: text/xml");
	
	//session取出用户， 根据商品id，把商品信息插入到账单表中
	echo '<?xml version="1.0"?>';
	echo '<PHP>';
	$cid = $_GET['cid'];
	$uid = $_GET['uid'];
	include("conn/conn.php");
	$sql = "select * from collect where userID = $uid and cmdyID = $cid";
	$result = mysqli_query($conn, $sql);
	if($result) {
		if(mysqli_num_rows($result) <= 0){
			//还没有被收藏
			$sq2 = "insert into collect(cmdyID, userID, userSID) values($cid, $uid, 1)";
			$r2 = mysqli_query($conn, $sq2);
		}
		echo "<result>true</result>";
		mysqli_free_result($result);
	}
	echo '</PHP>';
?>