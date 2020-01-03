<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>个人收藏</title>
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
		include('class/commodity.php');
		include('class/user.php');
		session_start();
		if(isset($_GET['out']) && $_GET['out'] == 1){
			if(isset($_SESSION['user'])){
				unset($_SESSION['user']);
				include("conn/conn.php");
				mysqli_close($conn);
			}
		}
	?>
	<header id="slogon">
		<p>殇尘书阁</p>
	</header>
	<div id="container">
		<div class="tablerow">
			<section id="personalMSG">
				<?php
					echo "<ul>";
					if(!isset($_SESSION['user'])){//提示注册
						echo "<li><a href='register.php'>注册</a>/<a href='login.php'>登录</a></li>";
					}
					else{
						$u = $_SESSION['user'];
						$u->login(); //用户登录
						if(isset($_GET['page'])){
							$_SESSION['page'] = $_GET['page'];
						}
						//var_dump($u);
					}
					echo "</ul>";
				?>
			</section>
			<section id="collectMSG">
				<?php
					if(isset($u)){
						$com = new commodity();
						$com->showColl($u->get_userID());
					}
				?>
			</section>
		</div>
	</div>
	<footer id="copyright">
		<p>
			&copy; <?php echo date("Y")?>, 阁物•书尘 <br>
			雕栏玉砌应犹在，只是头发少。问君能有几多愁？恰似一江春水向东流。
		</p>
	</footer>
</body>
</html>