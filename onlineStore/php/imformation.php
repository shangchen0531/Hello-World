<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>个人信息</title>
	<link href="../image/头像2.png" rel="shortcut icon" sizes="32x32">
	<link href="../css/decorate.css" rel="stylesheet" type="text/css">
	<script src="../js/jquery.js" type="text/javascript"></script>
	<script src="../js/animation.js" type="text/javascript" defer="defer"></script>
	<script src="../js/check.js" type="text/javascript"></script>
	<script src="../js/AJAX.js" type="text/javascript"></script>
</head>

<body>
	<?php
		//session_start()使用后，将自动反序列化session文件，
		//然后填充$_SESSION超级数组，但是序列化的对象里面不包含方法，所以需要在session_start()前引入对象文件，
		//这样才能在$_SESSION数组中正常取出对象并调用其方法
		include('class/user.php');
		session_start();
	?>
	<header id="slogon">
		<p>殇尘书阁</p>
	</header>
	<div id="container">
		<div class="tablerow">
			<section id="personalMSG">
				<?php
					echo "<ul>";
					$u = $_SESSION['user'];
					$u->login(); //用户登录
					echo "</ul>";
				?>
			</section>
			<section id="modiPerMSG">
				<form id="user-info">
					<table>
						<?php
						//var_dump($u);
							echo "<tr class='buttonshadow' onclick='show(1);'><td>用户名: </td><td id='userName2'>".$u->get_userName()."<input type='text' name='userName' id='userName' style='display: none;'></td><td><span id='user_ID' class='status'></span></td></tr>";
							echo "<tr class='buttonshadow' onclick='show(2);'><td>用户密码: </td><td id='userPW2'>".$u->get_userPW()."<input type='text' name='userPW' id='userPW' style='display: none;'></td><td><span id='user_PW' class='status'></span></td></tr>";
							echo "<tr><td>用户性别: </td>";
							$sex = "\"".$u->get_userSex()."\"";
							echo "<td>";
							echo "<input type='radio' name='user_sex' id='man' value='男'>男 
								  <input type='radio' name='user_sex' id='woman' value='女'>女 
								  <input type='radio' name='user_sex' id='unknow' value='未定'>未定";
							echo "</td></tr>";
							echo "<script type='text/javascript'>checkSex($sex);</script>";
							echo "<tr><td>用户注册时间: </td><td>".$u->get_userRT()."</td></tr>";
							echo "<tr><td>用户权限: </td><td>".$u->get_userLevel()."</td></tr>";
							echo "<tr><td>用户信用: </td><td>".$u->get_userCredit()."</td></tr>";
							echo "<tr><td>用户折扣级别: </td><td>".$u->get_userDiscountID()."</td></tr>";
							echo "<tr><td>用户店铺编号: </td><td>".($u->get_userSID() == 0 ? "null" : $u->get_userSID())."</td></tr>";
							echo "<tr><td>用户余额: </td><td>".$u->get_userMoney()."</td></tr>";
						?>
					</table>
				</form>
				<button type="button" onClick="submitData('user-info');">保存修改</button>
			</section>
		</div>
	</div>
	<footer id="copyright">
		<p>
			&copy; <?php echo date("Y")?>, 阁物&bull;书尘 <br>
			雕栏玉砌应犹在，只是头发少。问君能有几多愁？恰似一江春水向东流。
		</p>
	</footer>
	<input type="hidden" id="userName3">
	<input type="hidden" id="userPW3">
</body>

</html>