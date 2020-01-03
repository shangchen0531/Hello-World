<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>账号注册</title>
	<link href="../image/头像2.png" rel="shortcut icon" sizes="32x32">
	<link href="../css/decorate.css" rel="stylesheet" type="text/css">
	<script src="../js/jquery.js" type="text/javascript"></script>
	<script src="../js/animation.js" type="text/javascript" defer="defer"></script>
	<script src="../js/check.js" type="text/javascript" defer="defer"></script>
</head>

<body onmouseup="hide()">
	<div id="kklll">
		<form method="post" action="" id="regisForm">
			<caption>请输入你的注册信息:</caption>
			<table>
				<tr>
					<td>昵称:</td>
					<td><input type="text" name="rname"></td>
					<td><span id='rname' class="status"></span></td>
				</tr>
				<tr>
					<td>性别:</td>
					<td>
						<input type="radio" name="rsex" value="男">男&nbsp;
						<input type="radio" name="rsex" value="女">女&nbsp;
						<input type="radio" name="rsex" value="未定">未定&nbsp;
					</td>
					<td><span id='rsex' class="status"></span></td>
				</tr>
				<tr>
					<td>密码:</td>
					<td><input type="password" name="rpw"></td>
					<td><span id='rpw' class="status"></span></td>
				</tr>
				<tr>
					<td>确认密码:</td>
					<td><input type="password" name="confirmPw"></td>
					<td><span id='confirmPw' class="status"></span></td>
				</tr>
			</table>
			<span id="exist_status"></span><br>
			<input type="submit" name="regis" value="注册" onClick="return checkRegis();">
			&nbsp;&nbsp;
			<input type="reset" name="reset" value="重置">
		</form>
	</div>
	<?php
		include_once('class/user.php');
		session_start();
		if(isset($_POST['rname']) && isset($_POST['rpw'])){
			$u = new user($_POST['rname'], $_POST['rpw'], $_POST['rsex']);
			if($u->exist()){
				echo "<script type='text/javascript'>document.getElementById('exist_status').innerHTML = '该用户名已存在，请用密码登录。'</script>";
			}
			else{
				$u->addToDB();
				$_SESSION['user'] = $u;
				header('Location: index.php');
			}
		}
	?>
</body>
</html>