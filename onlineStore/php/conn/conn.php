<?php
	$host = "127.0.0.1"; //服务器地址
	$userName = "root";	 //用户名
	$password = "";		 //密码
	$DBname = "bookstoredb"; //数据库名
	@
	$conn = mysqli_connect($host, $userName, $password, $DBname) or die("数据库连接失败！".mysqli_error());
	mysqli_query($conn, "set names utf8");
?>