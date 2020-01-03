<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>账号登录</title>
	<link href="../image/头像2.png" rel="shortcut icon" sizes="32x32">
	<link href="../css/decorate.css" rel="stylesheet" type="text/css">
	<script src="../js/jquery.js" type="text/javascript"></script>
	<script src="../js/animation.js" type="text/javascript" defer="defer"></script>
	<script src="../js/check.js" type="text/javascript" defer="defer"></script>
</head>

<body onmouseup="hide()">
	<header id="slogon">
		<p>殇尘书阁</p>
	</header>
	<div id="loginDiv">
		<form method="post" action="" id="loginForm">
			<caption>请输入你的登录信息:</caption>
			<table>
				<tr>
					<td>用户名：</td>
					<td><input type="text" name="userName" id="userName"></td>
					<td><span id='user_ID' class="status"></span></td>
				</tr>
				<tr>
					<td>密码：</td>
					<td><input type="password" name="userPW" id="userPW"></td>
					<td><span id='user_PW' class="status"></span></td>
				</tr>
			</table>
			<span id="exist_status" class="status"></span><br>
			<div id="loginbutton">
				<input type="submit" name="submit" value="登录" onClick="return checkLogin();">
				&nbsp;&nbsp;
				<input type="reset" name="reset" value="重置">
			</div>
		</form>
	</div>
	<?php
		if(isset($_POST['userName']) && isset($_POST['userPW'])){
			include('class/user.php');
			$u = new user($_POST['userName'], $_POST['userPW'], "未定");
			if($u->exist()){
				if($u->checkPW()){
					session_start();
					$u->updateFromDB();
					$_SESSION['user'] = $u;
					if(isset($_SESSION['page'])){
						unset($_SESSION['page']);
					}
					header('Location: index.php');
				}
				else{
					echo "<script type='text/javascript'>document.getElementById('userName').value = '".$_POST['userName']."';</script>";
					echo "<script type='text/javascript'>document.getElementById('userPW').value = '".$_POST['userPW']."';</script>";
					echo "<script type='text/javascript'>document.getElementById('exist_status').innerHTML = \"密码错误,请检查\";</script>";
				}
			}
			else{
				echo "<script type='text/javascript'>document.getElementById('userName').value = '".$_POST['userName']."';</script>";
				echo "<script type='text/javascript'>document.getElementById('exist_status').innerHTML = \"用户不存在,请先<a href='register.php'>注册</a>\";</script>";
			}
		}
	?>
</body>
</html>