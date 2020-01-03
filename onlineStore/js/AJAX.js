// JavaScript Document
function createXmlHttpRequestObject(){
	"use strict";
	var http_request = false;
	if (window.XMLHttpRequest){
		//Mozilla or apart from IE
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			http_request.overrideMimeType("text/xml");
		}
	} else if (window.ActiveXObject) {//IE
		try {
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e) {}
		}
	}
	return http_request;
}

function inputHide(){
	"use strict";
	var inputs = document.getElementsByTagName('input');
	for(var i = 0; i < inputs.length; i++){
		if(inputs[i].type == 'text'){
			inputs[i].style.display = 'none';
		}
	}
}

function submitData(id){
	"use strict";
	if(!checkModi()){ return ; }
	inputHide();
	
	var http_request = createXmlHttpRequestObject();
	
	if(!http_request) {
		alert("不能创建XMLHTTP实例!");
		return false;
	}
	
	http_request.onreadystatechange = function() {
		if (http_request.readyState == 4) {
			if ((http_request.status >= 200 && http_request.status < 300) || http_request.status == 304) {//请求成功
				var XMLDoc = http_request.responseXML;
				document.getElementById('userName2').firstChild.nodeValue = document.getElementById('nickname').firstChild.nodeValue = 
					XMLDoc.getElementById('uName').innerHTML;
				document.getElementById('userPW2').firstChild.nodeValue = 
					XMLDoc.getElementById('uPW').innerHTML;
				checkSex(XMLDoc.getElementById('uSex').innerHTML);
				consequent('修改成功');
			}
		}
	};
	
	http_request.open('post', 'userModi.php', true);
	var form = document.getElementById(id);
	http_request.send(new FormData(form));
}

function addGoods(cid, uid){
	"use strict";
	var xhr = createXmlHttpRequestObject();
	
	if(!xhr){
		alert("不能创建XMLHTTP实例!");
		return false;
	}
	
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {
			if((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) { //请求成功
				var XMLDoc = xhr.responseXML;
				//结果处理
				var r = XMLDoc.getElementsByTagName('result')[0].firstChild.nodeValue;
				if(r == 'true'){
					consequent('添加成功');
				}
				else{
					consequent('添加失败');
				}
			}
		}
	};
	xhr.open('get', 'addGoods.php?cid=' + cid + '&uid=' + uid, true);
	xhr.send(null);
}

function convert(re){
	"use strict";
	if(re - Math.floor(re) > 0.0){
		//小数, 先滤去三位小数后面的
		return Math.round(re * 10) / 10.0;
	}
	return re;
}

function countPayment(){
	"use strict";
	var father = document.getElementById('counterMSG'); //section元素
	//console.log("总：" + bu.innerHTML);
	
	var divs = document.getElementsByClassName("count");
	
	var i, cnum, csum;
	
	for(i = 0; i < divs.length; i++){
		cnum = parseInt(divs[i].querySelector('.cnum').innerHTML);
		if(cnum <= 0){
			console.log("被移除的商品:" + divs[i].querySelector('.cname').innerHTML);
			console.log(divs[i].id);
			console.log("要移除商品，目前购物车商品数量为：" + divs.length);
			father.removeChild(divs[i]);
			console.log("移除商品后，购物车商品数量为：" + divs.length);
		}
	}
	
	csum = 0;
	for(i = 0; i < divs.length; i++){
		cnum = parseInt(divs[i].querySelector('.cnum').innerHTML);
		if(cnum > 0){
			var pri = parseFloat(divs[i].querySelector('.cprice').innerHTML);
			console.log("数量大于0的商品价格: " + pri);
			csum += pri;
		}
	}
	
	console.log("现在总款：" + csum);
	var bu = document.getElementById('cbutton'); //付款按钮，总款
	if(csum <= 0){
		console.log(bu.parentElement);
		father.removeChild(bu.parentElement);
		var p = document.createElement('p');
		p.innerHTML = "您的购物车里没有商品。";
		father.appendChild(p);
	}
	else{
		bu.innerHTML = "付款: " + csum.toString() + " 元";
		father.getElementsByTagName('a')[0].href = "href='pay.php?tradeCredit=" + csum.toString() + "'";
	}
}

function changeComNum(id, num){
	"use strict";
	
	var xhr = new createXmlHttpRequestObject();
	
	if(!xhr){
		alert("不能创建XMLHTTP实例!");
		return false;
	}
	
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {
			if((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) { //请求成功
				var XMLDoc = xhr.responseXML;
				
				//结果处理
				var cnum = parseInt(XMLDoc.getElementsByTagName('cnum')[0].firstChild.nodeValue);//剩余数量
				var cspare = parseFloat(XMLDoc.getElementsByTagName('cspare')[0].firstChild.nodeValue);//剩余价格
				cspare = convert(cspare);
				var child = document.getElementById("d" + id); //商品div元素
				child.getElementsByClassName("cnum")[0].innerHTML = cnum.toString();
				child.getElementsByClassName("cprice")[0].innerHTML = cspare.toString();
				countPayment();
			}
		}
	};
	xhr.open('get', 'billModi.php?cid=' + id + '&cnum=' + num, true);
	xhr.send(null);
}

function addCollection(cid, uid){
	"use strict";
	var xhr = createXmlHttpRequestObject();
	
	if(!xhr){
		alert("不能创建XMLHTTP实例!");
		return false;
	}
	
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {
			if((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) { //请求成功
				var XMLDoc = xhr.responseXML;
				//结果处理
				var r = XMLDoc.getElementsByTagName('result')[0].firstChild.nodeValue;
				if(r == 'true'){
					consequent('收藏成功');
				}
				else{
					consequent('收藏失败');
				}
			}
		}
	};
	xhr.open('get', 'addColl.php?cid=' + cid + '&uid=' + uid, true);
	xhr.send(null);
}

function decollect(cid){
	"use strict";
	var xhr = createXmlHttpRequestObject();
	
	if(!xhr){
		alert("不能创建XMLHTTP实例!");
		return false;
	}
	
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {
			if((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) { //请求成功
				var XMLDoc = xhr.responseXML;
				//结果处理
				var r = XMLDoc.getElementsByTagName('result')[0].firstChild.nodeValue;
				if(r === 'true'){
					console.log('取消成功');
					var child = document.getElementById("cd" + cid);
					var father = document.getElementById("collectMSG");
					console.log(child);
					father.removeChild(child);
					console.log(father.childElementCount);
					if(father.childElementCount === 1){
						console.log(father.firstChild);
						document.getElementById("cc").innerHTML = "这里空空如也。";
					}
				}
				else{
					consequent('移除收藏失败');
				}
			}
		}
	};
	xhr.open('get', 'deleteColl.php?cid=' + cid, true);
	xhr.send(null);
}

jQuery(document).ready(function($){
	"use strict";
	$('.cb').bind({contextmenu: function(e){ return false; },
				   mousedown: function(e){
								if(e.which == 3){// 1 = 鼠标左键 left; 2 = 鼠标中键; 3 = 鼠标右键
									var str = e.currentTarget.id;
									console.log(str.substring(str.indexOf("cd") + 2));
									decollect(str.substring(str.indexOf("cd") + 2));
									return false;//阻止链接跳转
								}}
				  });
});
function modiCmdy(cid, cla, data, textELE){
	"use strict";
	var xhr = createXmlHttpRequestObject();
	
	if(!xhr){
		alert("不能创建XMLHTTP实例!");
		return false;
	}
	
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {
			if((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) { //请求成功
				var XMLDoc = xhr.responseXML;
				//结果处理
				var r = XMLDoc.getElementsByTagName('result')[0].firstChild.nodeValue;
				if(r == 'true'){
					textELE.text(data);
					consequent("修改成功");
				}
				else{
					consequent("修改失败");
				}
			}
		}
	};
	xhr.open('get', 'modiCmdy.php?cid=' + cid + '&cla=' + cla + '&data=' + data, true);
	xhr.send(null);
}

function modImg(){
	"use strict";
	console.log($("#cid").val());
	var cid = $("#cid").val();//物品ID
	var form = document.getElementById("picForm");//表单
	console.log(form.newPic);
	console.log($("tr#u" + cid + " .picName img").attr("src"));//获取图片路径
	console.log(form.cid);
	var xhr = createXmlHttpRequestObject();
	
	if(!xhr){
		alert("不能创建XMLHTTP实例!");
		return false;
	}
	
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4) {
			if((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) { //请求成功
				var XMLDoc = xhr.responseXML;
				//结果处理
				var r = XMLDoc.getElementsByTagName('result')[0].firstChild.nodeValue;
				if(r == 'true'){
					var newName = XMLDoc.getElementsByTagName('pname')[0].firstChild.nodeValue;
					
					console.log(newName);
					var $img = $("tr#u" + cid + " .picName img");
					console.log($img);
					window.location.reload()
					consequent("修改成功");
					form.style.display = "none";
				}
				else{
					consequent("修改失败");
				}
			}
		}
	};
	xhr.open('post', 'modImg.php', true);
	xhr.send(new FormData(form));
}