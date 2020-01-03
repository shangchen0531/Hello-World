<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>收银台</title>
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
			<section id='counterMSG'>
				<?php
					include("class/commodity.php");
					$com = new commodity();
					if(isset($_GET["action"])){
						if($_GET['action'] == 'single'){//单个商品
							$cid = $_GET["id"];//商品ID
							$uid = $u->get_userID();
							$sql = "select num from bill where userID = $uid and cmdyID = $cid and status = '未完成'";
							include("conn/conn.php");
							$result = mysqli_query($conn, $sql);
							$_SESSION['singleID'] = $cid;
							if(mysqli_num_rows($result) > 0){
								//购物车有相同商品，显示购物车数量，更新账单记录
								$_SESSION['singleOne'] = 0;
								
								$myrow = mysqli_fetch_assoc($result);
								$price = $com->countPrice($cid, $myrow['num']);
								mysqli_free_result($result);
							}
							else{
								$_SESSION['singleOne'] = 1;
								//购物车没有相同商品，只买这一个，插入新记录
								$price = $com->countPrice($cid, 1, 1);
							}
							$com->showPrice($price);
						}
						else{//多个商品
							$_SESSION['singleOne'] = 2;
							$id = $_GET["id"];//用户ID
							$com->countPriceFromDB($id);
						}
					}
				?>
				<script type="text/javascript">checkWidth();</script>
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