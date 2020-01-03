<?php
	class commodity{
		private $arr;
		private $nowPage;
		private $perNum;
		private $totalPage;
		
		public function __construct(){
			include('conn/conn.php');
			$this->arr = array();
			$sql = "SELECT * FROM commodity";
			$result = mysqli_query($conn, $sql);
			//$n = mysqli_num_rows($result);
			while($myrow = mysqli_fetch_assoc($result)){
				array_push($this->arr, $myrow['cmdyID']);
			}
			mysqli_free_result($result);
		}
		
		public function showPage($cp, $pn){
			$total = count($this->arr);
			$lim = ($total % $pn == 0) ? ($total / $pn) : ($total / $pn + 1);
			settype($lim, 'int');
			for($i = ($cp - 1) * $pn; $i < $cp * $pn && $i < $total; $i++){
				$this->displayCom($this->arr[$i]);
			}
			$this->nowPage = $cp;
			$this->perNum = $pn;
			$this->totalPage = $lim;
			$this->showFooter();
		}
		
		public function showColl($uid){
			include("conn/conn.php");
			$sql = "select cmdyID from collect where userID = $uid";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0){
				echo "<p id='cc'>您的收藏如下: </p>";
				while($myrow = mysqli_fetch_assoc($result)){
					$this->displayCom($myrow['cmdyID'], 1);
				}
			}
			else{
				echo "<p id='cc'>这里空空如也。</p>";
			}
			
		}
		
		public function displayCom($id, $k = 0){
			$pic = $this->get_picName($id);
			$clna = $k == 0 ? "ca" : "cb";
			echo "<a href='goods.php?id=$id' title='点击查看详情' class='$clna' id=cd$id>";
			echo "<div class='cmdy'>";
			echo "<img src='../image/".$pic.".jpg' alt='".$pic."'>";
			echo "<footer><p>".$pic."</p><p>现价: ".$this->get_cmdyPrice($id)."</p><p>出版社: ".$this->get_cmdyOrigin($id)."</p></footer>";
			echo "</div></a>";
		}
		
		public function showFooter(){
			echo "<footer id='lalala'>";
			echo "<a href='index.php?page=1#lalala'>首页 | </a>";
			if($this->nowPage <= 2){
				$len = ($this->totalPage >= 3) ? 3 : $this->totalPage;
				for($i = 1; $i <= $len; $i++){
					echo "<a href='index.php?page=".$i."#lalala'>".$i." </a>";
				}
			}
			else if($this->nowPage == $this->totalPage){
				for($i = $this->nowPage - 1; $i <= $this->totalPage; $i++){
					echo "<a href='index.php?page=".$i."#lalala'>".$i." </a>";
				}
			}
			else{
				echo "... ";
				$low = $this->nowPage - 1;
				$high = ($this->nowPage + 1 <= $this->totalPage) ? ($this->nowPage + 1) : $this->totalPage;
				for($i = $low; $i <= $high; $i++){
					echo "<a href='index.php?page=".$i."#lalala'>".$i." </a>";
				}
				echo "... ";
			}
			echo "<a href='index.php?page=".$this->totalPage."#lalala'>| 尾页</a>";
			echo "</footer>";
		}
		

        public function set_cmdyName($id, $val){
			include('conn/conn.php');
			$sql = "UPDATE commodity SET cmdyName = '".$val."' WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			mysqli_free_result($result);
		}

        public function set_cmdyPrice($id, $val){
			include('conn/conn.php');
			$sql = "UPDATE commodity SET cmdyPrice = ".$val." WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			mysqli_free_result($result);
		}

        public function set_cmdyOrigin($id, $val){
			include('conn/conn.php');
			$sql = "UPDATE commodity SET cmdyOrigin = '".$val."' WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			mysqli_free_result($result);
		}

        public function set_cmdyDes($id, $val){
			include('conn/conn.php');
			$sql = "UPDATE commodity SET cmdyDes = '".$val."' WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			mysqli_free_result($result);
		}

        public function set_picName($id, $val){
			include('conn/conn.php');
			$sql = "UPDATE commodity SET picName = '".$val."' WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			mysqli_free_result($result);
		}


		
		private function get_cmdyID($id){
			include('conn/conn.php');
			$sql = "SELECT cmdyID FROM commodity WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			$n = mysqli_num_rows($result);
			if($n > 0){
				$myrow = mysqli_fetch_assoc($result);
				mysqli_free_result($result);
				return $myrow['cmdyID'];
			}
			mysqli_free_result($result);
		}

		public function get_cmdyName($id){
			include('conn/conn.php');
			$sql = "SELECT cmdyName FROM commodity WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			$n = mysqli_num_rows($result);
			if($n > 0){
				$myrow = mysqli_fetch_assoc($result);
				mysqli_free_result($result);
				return $myrow['cmdyName'];
			}
			mysqli_free_result($result);
		}

		public function get_cmdyPrice($id){
			include('conn/conn.php');
			$sql = "SELECT cmdyPrice FROM commodity WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			$n = mysqli_num_rows($result);
			if($n > 0){
				$myrow = mysqli_fetch_assoc($result);
				mysqli_free_result($result);
				return $myrow['cmdyPrice'];
			}
			mysqli_free_result($result);
		}

		public function get_cmdyOrigin($id){
			include('conn/conn.php');
			$sql = "SELECT cmdyOrigin FROM commodity WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			$n = mysqli_num_rows($result);
			if($n > 0){
				$myrow = mysqli_fetch_assoc($result);
				mysqli_free_result($result);
				return $myrow['cmdyOrigin'];
			}
			mysqli_free_result($result);
		}

		public function get_cmdyDes($id){
			include('conn/conn.php');
			$sql = "SELECT cmdyDes FROM commodity WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			$n = mysqli_num_rows($result);
			if($n > 0){
				$myrow = mysqli_fetch_assoc($result);
				mysqli_free_result($result);
				return $myrow['cmdyDes'];
			}
			mysqli_free_result($result);
		}

		public function get_picName($id){
			include('conn/conn.php');
			$sql = "SELECT picName FROM commodity WHERE cmdyID = ".$id;
			$result = mysqli_query($conn, $sql);
			$n = mysqli_num_rows($result);
			if($n > 0){
				$myrow = mysqli_fetch_assoc($result);
				mysqli_free_result($result);
				return $myrow['picName'];
			}
			mysqli_free_result($result);
		}

		public function countPrice($cid, $num, $k = 0){
			$price = $this->get_cmdyPrice($cid);
			$price = $price * $num;
			$name = $this->get_cmdyName($cid);
			$picName = $this->get_picName($cid);
			echo "<div class='count' id=d$cid>";
			echo "<table>";
			echo "<tr><th></th><th>商品名</th><th>数量</th><th>总价</th>";
			if($k == 0){
				echo "<th>操作</th>";
			}
			echo "</tr>";
			echo "<tr><td class='cpic'><img src='../image/$picName.jpg' width='100' height='100'></td>";
			echo "<td class='cname'>$name</td>";
			echo "<td class='cnum'>$num</td>";
			echo "<td class='cprice'>$price</td>";
			if($k == 0){
				echo "<td class='cmunip'><button type='button' onClick='remove($cid);'>移除</button>";
				echo "<div class='signImg'>";
				echo "<img src='../image/jia1.png' alt='+' onMouseDown='change(2, this, \"jia\");' onMouseUp='change(1, this, \"jia\");' onclick='changeComNum($cid, 1);'>";
				echo "<img src='../image/jian1.png' alt='-' onMouseDown='change(2, this, \"jian\");' onMouseUp='change(1, this, \"jian\");' onclick='changeComNum($cid, -1)'></div></td>";
				
			}
			echo "</tr></table>";
			echo "</div>";
			return $price;
		}
		
		public function countPriceFromDB($id){
			include("conn/conn.php");
			$sql = "select cmdyID, num from bill where userID = $id and status = '未完成'";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0){
				//得到账单
				$total = 0;
				while($myrow = mysqli_fetch_assoc($result)){
					$total += $this->countPrice($myrow['cmdyID'], $myrow['num']);
				}
				$this->showPrice($total);
			}
			else{
				echo "<p>您的购物车里没有商品。</p>";
			}
			mysqli_free_result($result);
		}
		
		public function showPrice($price){
			echo "<a href='pay.php?tradeCredit=$price'><button type='button' id='cbutton'>付款: $price 元</button></a>";
		}
		
		public function showAllComd(){
			
			include("conn/conn.php");
			$sql = "select * from commodity";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0){
				echo "<div id='allSearch'>";
				echo "<span>本站商品信息如下: </span>";
				echo "<div id='searchBox'><lable>根据ID查找商品: </lable>";
				echo "<input type='text' name='searchID'> ";
				echo "<button id='searchBu' onClick='jump();'>查询</button>";
				echo "<a id='finalAdd' href='addCmdy.php'>添加商品</a>";
				echo "</div>";
				echo "</div>";
				
				echo "<table id='allCommod'>";
				echo "<tr><th>商品图貌</th><th>商品ID</th><th>商品名</th><th>商品价格</th><th>商品产商</th><th width='200'>商品描述</th></tr>";
				while($myrow=mysqli_fetch_assoc($result)){
					echo "<tr id='u".$myrow['cmdyID']."'>";
					echo "<td class='picName'><img src='../image/".$myrow['picName'].".jpg' alt='".$myrow['cmdyName']."'></td>";
					echo "<td>".$myrow['cmdyID']."<br><a href='deleteCmdy.php?cid=".$myrow['cmdyID']."' class='dl'>移除</a></td>";
					echo "<td class='cmdyName buttonshadow'><span>".$myrow['cmdyName']."</span><input type='text' class='cmdyName'></td>";
					echo "<td class='cmdyPrice buttonshadow'><span>".$myrow['cmdyPrice']."</span><input type='text' class='cmdyPrice'></td>";
					echo "<td class='cmdyOrigin buttonshadow'><span>".$myrow['cmdyOrigin']."</span><input type='text' class='cmdyOrigin'></td>";
					echo "<td class='cmdyDes buttonshadow'><span>".$myrow['cmdyDes']."</span><textarea class='cmdyDes'></textarea></td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			else{
				echo "<p>暂无商品信息</p>";
			}
			
		}
		
	}
?>