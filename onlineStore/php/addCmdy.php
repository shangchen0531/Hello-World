<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加商品</title>
<link href="../image/头像2.png" rel="shortcut icon" sizes="32x32">
<link href="../css/decorate.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/animation.js" type="text/javascript" defer="defer"></script>
<script src="../js/AJAX.js" type="text/javascript"></script>
<script src="../js/check.js" type="text/javascript"></script>
</head>

<body onClick="javascript:document.getElementsByTagName('caption')[0].innerHTML = '';">
	<?php
		//session_start()使用后，将自动反序列化session文件，
		//然后填充$_SESSION超级数组，但是序列化的对象里面不包含方法，所以需要在session_start()前引入对象文件，
		//这样才能在$_SESSION数组中正常取出对象并调用其方法
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
						//var_dump($u);
					}
					echo "</ul>";
				?>
			</section>
			<section>
				<form method="post" id='addForm' action="" enctype="multipart/form-data" name="form">
					<table id="addTable">
						<caption>
						</caption>
						<tr>
							<th>商品名: </th>
							<td><input type="text" name="cmdyName"></td>
						</tr>
						<tr>
							<th>商品价格: </th>
							<td><input type="text" name="cmdyPrice"></td>
						</tr>
						<tr>
							<th>商品产商: </th>
							<td><input type="text" name="cmdyOrigin"></td>
						</tr>
						<tr>
							<th>商品描述: </th>
							<td><textarea name="cmdyDes"></textarea></td>
						</tr>
						<tr>
							<th>商品图片: </th>
							<td><input type="file" name="picName"></td>
						</tr>
						<tr>
							<td colspan="2" id="sandr">
								<input type='submit' value='添加' class='button'>  
								<input type='reset' value='重置' class='button'>
							</td>
						</tr>
					</table>
				</form>
			</section>
		</div>
	</div>
	<footer id="copyright">
		<p>
			&copy; <?php echo date("Y")?>, 阁物•书尘 <br>
			雕栏玉砌应犹在，只是头发少。问君能有几多愁？恰似一江春水向东流。
		</p>
	</footer>
	<?php
		if(isset($_POST['cmdyName'])){
			//上传图片
			$sql = "insert into commodity(cmdyName, cmdyPrice, cmdyOrigin, cmdyDes, picName) 
					values('".$_POST['cmdyName']."', ".$_POST['cmdyPrice'].", '".$_POST['cmdyOrigin']."', '".$_POST['cmdyDes']."', '".$_POST['cmdyName']."')";
			include("conn/conn.php");
			$result = mysqli_query($conn, $sql);
			if($result && mysqli_affected_rows($conn) > 0){
				if(!empty($_FILES['picName']['name'])){
					$fileinfo = $_FILES['picName'];
					if($fileinfo['error'] == 0){
						//成功上传
						//转移图片
						$newWay = "../image/".$_POST['cmdyName'].".jpg";
						$newWay = iconv("utf-8", "gb2312", $newWay);//含有中文路径时需要编码转换，否则乱码
						
						move_uploaded_file($fileinfo['tmp_name'], $newWay);
						echo "<script type='text/javascript'>
								document.getElementsByTagName('caption')[0].innerHTML = '添加成功';
							 </script>";
					}
					else{
						echo "<script type='text/javascript'>
								document.getElementsByTagName('caption')[0].innerHTML = '图片上传失败';
							 </script>";
					}
				}
			}
			else{
				echo "<script type='text/javascript'>
								document.getElementsByTagName('caption')[0].innerHTML = '添加失败';
							 </script>";
				echo "<br>$sql";
			}
		}
	?>
</body>
</html>