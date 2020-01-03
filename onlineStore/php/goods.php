<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php
	include('class/commodity.php');
	if(!isset($cmmd)){
		$cmmd = new commodity();
	}
	$id = $_GET['id'];
	$goodName = $cmmd->get_cmdyName($id);
	echo "<title>$goodName</title>";
	echo "<link href='../image/$goodName.jpg' rel='shortcut icon' sizes='32x32'>"
?>
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
			<section id="goodsMSG">
				<section>
					<?php
						echo "<table id='goodsTable'>";
						echo "<tr><th>商品图貌: </th><td><img src='../image/$goodName.jpg' alt='$goodName' width='128' height='128'></td></tr>";
						echo "<tr><th>商品名: </th><td>".$cmmd->get_cmdyName($id)."</td></tr>";
						echo "<tr><th>商品价格: </th><td>".$cmmd->get_cmdyPrice($id)." RMB</td></tr>";
						echo "<tr><th>商品产商: </th><td>".$cmmd->get_cmdyOrigin($id)."</td></tr>";
						echo "<tr><th>商品描述: </th><td>".$cmmd->get_cmdyDes($id)."</td></tr>";
						echo "</table>";
					?>
				</section>
				<section id="g2">
					<div onMouseOver="change(1, this, 'cart');" onMouseOut="change(2, this, 'cart');" onClick="addGoods(<?php echo $id; ?>, <?php echo $u->get_userID();?>);">
						<img src="../image/cart1.png" alt="cart" id="cart">
						<lable for="carts">加入购物车</lable>
					</div>
					<div onMouseOver="change(1, this, 'Favor');" onMouseOut="change(2, this, 'Favor');" onClick="addCollection(<?php echo $id; ?>, <?php echo $u->get_userID();?>);">
						<img src="../image/Favor.png" alt="Favor" id="Favor">
						<lable for="Favor">加入收藏</lable>
					</div>
					<a href="counter.php?action=single&id=<?php echo $id; ?>">
						<div onMouseOver="change(1, this, 'wallet');" onMouseOut="change(2, this, 'wallet');">
							<img src="../image/wallet1.png" alt="wallet" id="wallet">
							<lable for="wallet">立即购买</lable>
						</div>
					</a>
				</section>
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