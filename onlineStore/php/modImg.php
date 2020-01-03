<?php
	header("Content-type: text/xml");
	include("class/commodity.php");
	echo "<?xml version='1.0'?>";
	echo "<PHP>";
	
	if(!empty($_FILES['newPic']['name'])){
		$fileinfo = $_FILES['newPic'];
		
		if($fileinfo['error'] == 0){
			$com = new commodity();
			$cid = $_POST['cid'];
			$pname = $com->get_picName($cid);
			$newWay = "../image/$pname.jpg";//新路径，也是旧路径
			$newWay = iconv("utf-8", "gb2312", $newWay);//中文时转换编码
			
			move_uploaded_file($fileinfo['tmp_name'], $newWay);//如果目标文件已经存在，将会被覆盖。
			echo "<result>true</result>";
			echo "<pname>$pname</pname>";
		}
		else{
			echo "<result>false</result>";
		}
	}
	else{
		echo "<result>false</result>";
	}
	echo "</PHP>";
	
?>