<?php
	header("Content-type: text/xml");
	
	//session取出用户， 根据商品id，把商品信息插入到账单表中
	echo '<?xml version="1.0"?>';
	echo '<PHP>';
	$cid = $_GET['cid'];
	$uid = $_GET['uid'];
	include("conn/conn.php");
	$sql = "select * from bill where userID = $uid and cmdyID = $cid and status = '未完成'";
	$result = mysqli_query($conn, $sql);
	if($result) {
		
		if(mysqli_num_rows($result) > 0){
			//有未结算的记录，数量加1
			$myrow = mysqli_fetch_assoc($result);
			$num = $myrow['num'] + 1;
			$sq2 = "update bill set num = $num where userID = $uid and cmdyID = $cid and status = '未完成'";
			$r2 = mysqli_query($conn, $sq2);
			echo "<result>".($r2 ? "true" : "false")."</result>";
		}
		else{
			//没有未结算的记录，插入新记录
			$sq2 = "insert into bill(userID, cmdyID, num) values($uid, $cid, 1)";
			$r2 = mysqli_query($conn, $sq2);
			echo "<result>".($r2 ? "true" : "false")."</result>";
		}
		mysqli_free_result($result);
	}
	echo '</PHP>';
?>