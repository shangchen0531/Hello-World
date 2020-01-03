<?php
	class user{
		private $userID; //用户ID
		private $userName; //用户昵称
		private $userPW; //用户密码
		private $userSex; //用户性别
		private $userRT; //用户注册时间
		private $userLevel; //用户权限, 0: 普通用户, 1: 店主， 2: 管理员， 3:超级管理员
		private $userCredit; //用户信用
		private $userDiscountID; //用户优惠级别
		private $userSID; //用户商铺ID
		private $userMoney; //用户账户余额
		
		public function __construct($name, $passw, $ussex){
			include('conn/conn.php');
			$this->userName = $name;
			$this->userPW = $passw;
			if($this->exist()){
				$sql = "select userID, userSex from _user where userName = '".$this->userName."'";
				$result = mysqli_query($conn, $sql);
				$myrow = mysqli_fetch_assoc($result);
				$this->userID = $myrow['userID'];
				$this->userSex = $myrow['userSex'];
				settype($this->userID, 'int');
			}
			else $this->userSex = $ussex;
		}
		
		public function exist(){
			include('conn/conn.php');
			$sql = "select * from _user where userName = '".$this->userName."'";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function checkPW(){
			include('conn/conn.php');
			$sql = "select userPW from _user where userID = '".$this->userID."'";
			$result = mysqli_query($conn, $sql);
			$myrow = mysqli_fetch_assoc($result);
			if($myrow && $myrow['userPW'] == $this->userPW){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function login(){
			echo "<li><span id='nickname'>".$this->userName."</span></li>";
			echo "<li><a href='index.php?out=1'>注销</a></li>";
			echo "<li><a href='index.php'>首页</a></li>";
			echo "<li><a href='imformation.php'>个人信息</a></li>";
			echo "<li><a href='counter.php?action=check&id=".$this->userID."'>购物车</a></li>";
			//echo "<li><a href='dealHis.php'>交易记录</a></li>";
			//echo "<li><a href='comment.php'>我的评论</a></li>";
			echo "<li><a href='collection.php'>我的收藏</a></li>";
			if($this->userLevel >= 2){//管理员
				echo "<li><a href='administration.php?ch=0'>后台管理</a></li>";
			}
			$this->updateFromDB();
		}
		
		public function addToDB(){
			include('conn/conn.php');
			if($this->userName != "" && $this->userPW != ""){
				date_default_timezone_set('PRC');
				$this->userSex = is_null($this->userSex) ? '未定' : $this->userSex;
				$sql = "insert into _user(userName, userPW, userSex, userRT) values('".$this->userName."', '".$this->userPW."', '".$this->userSex."', '".date('Y-m-d')."')";
				mysqli_query($conn, $sql);
				$this->updateFromDB();
			}
		}
		
		public function deleteFromDB(){
			include('conn/conn.php');
			if(isset($this->userID)){
				$sql = "DELETE FROM _user WHERE userID = ".$this->userID;
				mysqli_query($conn, $sql);
				unset($this->userID);
				unset($this->userName);
			}
		}
		
		public function updateFromDB(){
			include('conn/conn.php');
			if(isset($this->userName)){
				$sql = "SELECT * FROM _user WHERE userName = '".$this->userName."'";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) > 0){
					$myrow = mysqli_fetch_assoc($result);
					$this->userID = $myrow['userID'];
					$this->userPW = $myrow['userPW'];
					$this->userSex = $myrow['userSex'];
					$this->userRT = $myrow['userRT'];
					$this->userLevel = $myrow['userLevel'];
					$this->userCredit = $myrow['userCredit'];
					$this->userDiscountID = $myrow['userDiscountID'];
					$this->userSID = $myrow['userSID'];
					$this->userMoney = $myrow['userMoney'];
					settype($this->userID, 'int');
					settype($this->userLevel, 'int');
					settype($this->userCredit, 'int');
					settype($this->userDiscountID, 'int');
					settype($this->userSID, 'int');
					settype($this->userMoney, 'float');
				}
			}
		}
		
		public function get_userID(){ 
			return $this->userID;
		}
		public function get_userName(){ 
			return $this->userName;
		}
		public function get_userPW(){ 
			return $this->userPW;
		}
		public function get_userSex(){ 
			return $this->userSex;
		}
		public function get_userRT(){ 
			return $this->userRT;
		}
		public function get_userLevel(){ 
			return $this->userLevel;
		}
		public function get_userCredit(){ 
			return $this->userCredit;
		}
		public function get_userDiscountID(){ 
			return $this->userDiscountID;
		}
		public function get_userSID(){ 
			return $this->userSID;
		}
		public function get_userMoney(){ 
			return $this->userMoney;
		}
		public function get_usconn(){ 
			return $this->usconn;
		}
		

		public function set_userName($val){
			if(!isset($this->userID)){
				return false;
			}
			include('conn/conn.php');
			$sql = "update _user set userName = '".$val."' where userID = ".$this->userID;
			echo "<here>$sql</here>";
			$result = mysqli_query($conn, $sql);
			if($result){
				$this->userName = $val;
				return true;
			}
			return false;
		}
		public function set_userPW($val){
			if(!isset($this->userID)){
				return false;
			}
			include('conn/conn.php');
			$sql = "update _user set userPW = '".$val."' where userID = ".$this->userID;
			echo "<here>$sql</here>";
			$result = mysqli_query($conn, $sql);
			if($result){
				$this->userPW = $val;
				return true;
			}
			return false;
		}
		public function set_userSex($val){
			if(!isset($this->userID)){
				return false;
			}
			include('conn/conn.php');
			$sql = "update _user set userSex = '".$val."' where userID = ".$this->userID;
			echo "<here>$sql</here>";
			$result = mysqli_query($conn, $sql);
			if($result){
				$this->userSex = $val;
				return true;
			}
			return false;
		}
		public function set_userRT($val){
			if(!isset($this->userID)){
				return false;
			}
			include('conn/conn.php');
			$sql = "update _user set userRT = '".$val."' where userID = ".$this->userID;
			$result = mysqli_query($conn, $sql);
			if($result){
				$this->userRT = $val;
				return true;
			}
			return false;
		}
		public function set_userLevel($val){
			if(!isset($this->userID)){
				return false;
			}
			include('conn/conn.php');
			$sql = "update _user set userLevel = '".$val."' where userID = ".$this->userID;
			$result = mysqli_query($conn, $sql);
			if($result){
				$this->userLevel = $val;
				return true;
			}
			return false;
		}
		public function set_userCredit($val){
			if(!isset($this->userID)){
				return false;
			}
			include('conn/conn.php');
			$sql = "update _user set userCredit = '".$val."' where userID = ".$this->userID;
			$result = mysqli_query($conn, $sql);
			if($result){
				$this->userCredit = $val;
				return true;
			}
			return false;
		}
		public function set_userDiscountID($val){
			if(!isset($this->userID)){
				return false;
			}
			include('conn/conn.php');
			$sql = "update _user set userDiscountID = '".$val."' where userID = ".$this->userID;
			$result = mysqli_query($conn, $sql);
			if($result){
				$this->userDiscountID = $val;
				return true;
			}
			return false;
		}
		public function set_userSID($val){
			if(!isset($this->userID)){
				return false;
			}
			include('conn/conn.php');
			$sql = "update _user set userSID = '".$val."' where userID = ".$this->userID;
			$result = mysqli_query($conn, $sql);
			if($result){
				$this->userSID = $val;
				return true;
			}
			return false;
		}
		public function set_userMoney($val){
			if(!isset($this->userID)){
				return false;
			}
			include('conn/conn.php');
			$sql = "update _user set userMoney = '".$val."' where userID = ".$this->userID;
			$result = mysqli_query($conn, $sql);
			if($result){
				$this->userMoney = $val;
				return true;
			}
			return false;
		}
		
		public function showAllUser() {
			if($this->userLevel >= 2 && isset($this->userID)){
				include("conn/conn.php");
				$sql = "select * from _user";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) > 0){
					echo "<div id='allSearch'>";
					echo "<span>本站用户信息如下</span>";
					echo "<div id='searchBox'><lable>根据ID查找用户: </lable>";
					echo "<input type='text' name='searchID'> ";
					echo "<button id='searchBu' onClick='jump();'>查询</button>";
					echo "</div>";
					echo "</div>";
					
					echo "<table id='allUser'>";
					echo "<tr><th>用户ID</th><th>用户名</th><th>用户密码</th><th>用户性别</th><th>用户注册时间</th><th>用户权限</th><th>用户信用</th><th>用户折扣级别</th><th>用户商铺ID</th><th>用户余额</th></tr>";
					while($myrow=mysqli_fetch_assoc($result)){
						$kid = ($myrow['userID'] == $this->userID) ? "adm" : "";
						echo "<tr class='$kid' id='u".$myrow['userID']."'>";
						echo "<td>".$myrow['userID']."</td>";
						echo "<td>".$myrow['userName']."</td>";
						echo "<td>".$myrow['userPW']."</td>";
						echo "<td>".$myrow['userSex']."</td>";
						echo "<td>".$myrow['userRT']."</td>";
						echo "<td>".$myrow['userLevel']."</td>";
						echo "<td>".$myrow['userCredit']."</td>";
						echo "<td>".$myrow['userDiscountID']."</td>";
						$ssid = (is_null($myrow['userSID']) ? "NULL" : $myrow['userSID']);
						echo "<td>$ssid</td>";
						echo "<td>".$myrow['userMoney']."</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				else{
					echo "<p>暂无用户信息</p>";
				}
			}
		}
	}
?>