<?php
	header("Content-type: text/xml");
	include("class/user.php");
	include("class/commodity.php");
	session_start();
	$cmmd = new commodity();
	echo "<?xml version='1.0'?>";
	echo "<PHP><br/>";
	if(isset($_SESSION['user'])){
		$u = $_SESSION['user'];
		$uid = $u->get_userID();
		$cid = $_GET['cid'];
		$cnum = $_GET['cnum'];
		include("conn/conn.php");
		$sql = "select num from bill where userID = $uid and cmdyID = $cid and status = '未完成'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$myrow = mysqli_fetch_assoc($result);
			echo "<text>$myrow[num], $cnum</text>";
			if($cnum < 0){
				//减操作
				$k = $myrow['num'] + $cnum;
				if($k > 0){
					$kql = "update bill set num = $k where userID = $uid and cmdyID = $cid and status = '未完成'";
					mysqli_query($conn, $kql);
					
					$sp = $cmmd->get_cmdyPrice($cid) * $k;
					echo "<cnum>$k</cnum><br/>";
					echo "<cspare>$sp</cspare><br/>";
				}
				else{
					//数量清0，清除记录。
					$kql = "delete from bill where userID = $uid and cmdyID = $cid and status = '未完成'";
					mysqli_query($conn, $kql);
					echo "<cnum>0</cnum><br/>";
					echo "<cspare>0</cspare><br/>";
				}
			}
			else{
				//加操作
				$k = $myrow['num'] + $cnum;
				$kql = "update bill set num = $k where userID = $uid and cmdyID = $cid and status = '未完成'";
				mysqli_query($conn, $kql);
				$sp = $cmmd->get_cmdyPrice($cid) * $k;
				echo "<cnum>$k</cnum><br/>";
				echo "<cspare>$sp</cspare><br/>";
			}
		}
	}
	echo "</PHP>";
?>