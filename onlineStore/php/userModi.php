<?php
	header('Content-type: text/xml');//默认编码utf-8
	include('class/user.php');//默认编码utf-8
	session_start();
	echo '<?xml version="1.0"?>';
	echo '<PHP>';

	//获取用户
	
	function valid($str){
		if(strlen($str) === 0){
			return false;
		}
		for($i = 0; $i < strlen($str); $i++){
			if($str[i] === ' ' || $str[i] === '\t' || 
			   $str[i] === '\n' || $str[i] === '\\' ||
			   $str[i] === '\"' || $str[i] === '\''){
				return false;
			}
		}
		return true;
	}

	$u = $_SESSION['user'];
	if($u->exist()){
		//更改属性
		if(valid($_POST['userName'])){
			$u->set_userName($_POST['userName']);
		}
		if(valid($_POST['userPW'])){
			$u->set_userPW($_POST['userPW']);
		}
		if(valid($_POST['user_sex'])){
			$u->set_userSex($_POST['user_sex']);
		}
		

		$u->updateFromDB();
		$_SESSION['user'] = $u;
		//回显结果
		
		echo "<userName id='uName'>".$u->get_userName()."</userName>";
		echo "<userPW id='uPW'>".$u->get_userPW()."</userPW>";
		echo "<userSex id='uSex'>".$u->get_userSex()."</userSex>";
	}

	
	echo '</PHP>';
?>