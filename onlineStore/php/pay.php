<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>支付结果</title>
<link href="../image/头像2.png" rel="shortcut icon" sizes="32x32">
<link href="../css/decorate.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/animation.js" type="text/javascript" defer="defer"></script>
<script src="../js/check.js" type="text/javascript"></script>
<!--<script src="../js/AJAX.js" type="text/javascript"></script>-->
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
			<section>
				<?php
					if(isset($u)){
						$uid = $u->get_userID();
						if(isset($_SESSION['singleOne'])){
							include('conn/conn.php');
							$status = $_SESSION['singleOne'];
							if($status == 0){
								//购物车有相同商品
								//账单表有记录，结算后更新账单状态
								if(!isset($_SESSION['singleID'])){
									return ;
								}
								
								$cid = $_SESSION['singleID'];
								$sql = "update bill set status = '已完成' where userID = $uid and cmdyID = $cid and status = '未完成'";
							}
							else if($status == 1){
								//购物车没有相同商品，只买这一个，插入新记录
								$cid = $_SESSION['singleID'];
								//INSERT INTO `bill` (`billID`, `userID`, `cmdyID`, `num`, `status`) VALUES (NULL, '13', '1', '5', '已完成');
								$sql = "insert into bill(userID, cmdyID, num, status) values($uid, $cid, 1, '已完成')";
								
							}
							else if($status == 2){
								//购物车页过来的，更新所有记录					
								$sql = "update bill set status = '已完成' where userID = $uid and status = '未完成'";
							}
							else{
								echo '交易已完成，点击右侧"首页"可返回首页。';
							}
							
							if($status != -1){
								$result = mysqli_query($conn, $sql);
								if($result){
									if(isset($_GET['tradeCredit'])){
										$credit = $_GET['tradeCredit'];
										echo "<p>付款成功！本次交易额度为: $credit 元</p>";
										unset($_GET['tradeCredit']);
									}
									else{
										echo "<p>付款失败！本次交易额度为: 0.0 元</p>";
									}
								}
								else{
									echo $sql;
									echo "<p>数据连接错误！</p>";
								}
							}
							$_SESSION['singleOne'] = -1;
						}
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