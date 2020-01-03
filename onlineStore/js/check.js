// JavaScript Document
function checkLogin(){
	"use strict";
	var form1 = document.getElementById('loginForm');
	if(form1.userName.value == "")
	{
		document.getElementById('user_ID').innerHTML = "用户名不能为空！！";
		form1.userName.focus();
		return false;
	}
	if(form1.userPW.value == "")
	{
		document.getElementById('user_PW').innerHTML = "用户密码不能为空！！";
		form1.userPW.focus();
		return false;
	}
	form1.submit();
}
function checkRegis(){
	"use strict";
	var form = document.getElementById('regisForm');
	if(form.rname.value == ""){
		document.getElementById('rname').innerHTML = "用户名不能为空！！";
		return false;
	} 
	else if(form.rname.value.length > 6){
		document.getElementById('rname').innerHTML = "用户名长度不能超过6位！！";
		return false;
	}
	if(form.rpw.value == ""){
		document.getElementById('rpw').innerHTML = "用户密码不能为空！！";
		return false;
	}
	else if(form.rpw.value.length > 12){
		document.getElementById('rpw').innerHTML = "用户密码不能超过12位！！";
		return false;
	}
	else if(form.rpw.value != form.confirmPw.value){
		document.getElementById('confirmPw').innerHTML = "两次密码输入不一致！！";
		return false;
	}
	form.submit();
}

function checkModi(){
	"use strict";
	var userNameInputID = 'userName';
	var userPWInputID = 'userPW';
	var uNSpanID = 'user_ID';
	var uPSpanID = 'user_PW';
	var uNSpan = document.getElementById(uNSpanID);
	var uPSpan = document.getElementById(uPSpanID);
	var userName = document.getElementById(userNameInputID).value;
	var userPW = document.getElementById(userPWInputID).value;
	if(userName.length > 6){
		uNSpan.innerHTML = '用户名长度不能超过6位！！';
		return false;
	}
	if(userPW.length > 12){
		uPSpan.innerHTML = '用户密码不能超过12位！！';
		return false;
	}
	return true;
}

function hide(){
	"use strict";
	var spans = document.getElementsByTagName('span');
	for(var i = 0; i < spans.length; i++){
		if(spans[i].className === 'status' && spans[i].id !== 'exist_status'){
			spans[i].innerHTML = "";
		}
	}
}
function checkSex(k){
	"use strict";
	var id;
	switch(k){
		case '男' : id = 'man'; break;
		case '女' : id = 'woman'; break;
		default : id = 'unknow'; break;
	}
	document.getElementById(id).checked = 'true';
}

function show(k){
	"use strict";
	var tdid = "", inputid = "", hid = "";
	if(k === 1){
		tdid = 'userName2';
		inputid = 'userName';
		hid = 'userName3';
	}
	else if(k === 2){
		tdid = 'userPW2';
		inputid = 'userPW';
		hid = 'userPW3';
	}
	var td = document.getElementById(tdid);
	var input = document.getElementById(inputid);
	var h = document.getElementById(hid);
	if(input.style.display === 'inline'){//隐藏输入框
		input.style.display = 'none';
		if((k === 1 && input.value.length <= 6) || 
		   (k === 2 && input.value.length <= 12)){
			td.firstChild.nodeValue = input.value;
		}
		else{
			checkModi();
			input.value = h.value;
			td.firstChild.nodeValue = input.value;
		}
	}
	else{//显示输入框
		hide();
		input.style.display = 'inline';
		input.value = td.firstChild.nodeValue;
		input.focus();
		td.firstChild.nodeValue = '';
		h.value = input.value;
	}
	
	//Asynchronous JavaScript And XHTML
	
}

function checkWidth(){
	"use strict";
	var k = document.querySelectorAll("td.cname");
	var g = document.querySelectorAll("td.cprice");
	var mw = 0, pricemw = 0, i = 0;
	for(i = 0; i < k.length; i++){
		mw = Math.max(mw, k[i].offsetWidth);
	}
	for(i = 0; i < g.length; i++){
		pricemw = Math.max(pricemw, g[i].offsetWidth);
	}
	for(i = 0; i < k.length; i++){
		k[i].style.width = mw + "px";
	}
	for(i = 0; i < g.length; i++){
		g[i].style.width = pricemw + "px";
	}
	
	var couW = document.querySelector('#counterMSG table').offsetWidth;
	var ori = document.getElementById('cbutton').parentNode;
	ori.style.marginLeft = couW - ori.offsetWidth + "px";
}

function remove(id){
	"use strict";
	//将商品数量减到0
	//先获取商品目前数量
	var nowComdNum = parseInt(document.querySelector("div#d" + id + " td.cnum").innerHTML);
	changeComNum(id, -nowComdNum);
}

function jump(){
	"use strict";
	var father = document.getElementById('searchBox');
	console.log(father);
	var seid = father.querySelector('input').value.toString();
	if(seid.length == 0){
		console.log("ok");
		return ;
	}
	else{
		//模拟锚点id跳转
		father = document.getElementById('allUser');
		if(!father){
			father = document.getElementById('allCommod');
		}
		
		var trs = father.querySelectorAll('tr');
		console.log(trs.length);
		for(var i = 0; i < trs.length; i++){
			if(trs[i].className != 'adm'){
				trs[i].style.color = "#000";
			}
		}
		
		var tr = father.querySelector('tr#u' + seid.toString());//指定跳转元素
		tr.style.color = "red";
		console.log(tr);
		window.scrollTo(0, tr.offsetTop); 
	}
}

jQuery(document).ready(function($){
	$('#adminiMSG').keypress(function(e){//将事件绑定在用户信息表
		if(e.keyCode == 13){//enter事件
			jump();
		}
	});
});

function select(ch){
	var lis = document.querySelectorAll('#adminChoice li');
	console.log(ch + " " + lis.length);
	for(var i = 0; i < lis.length; i++){
		if(i == ch){
			lis[i].className = 'selected';
		}
		else{
			lis[i].className = '';
		}
	}
}

jQuery(document).ready(function($){
	$("#allCommod td.buttonshadow").click(function(e){
		var td = e.currentTarget;
		//console.log($(td).children("input"))
		var tdc = $(td).children();
		
		var textELE = tdc.eq(0);
		var inputELE = tdc.eq(1);
		
		if(textELE.css("display") == "inline"){
			//元素显示，输入框隐藏时点击
			//把元素文本放入输入框,输入框显示，元素隐藏
			console.log($(textELE)[0].tagName);
			console.log($(inputELE)[0].tagName);
			if($(inputELE)[0].tagName === "textarea"){
				inputELE.text(textELE.text());
			}
			else{
				inputELE.val(textELE.text());
			}
			inputELE.css("display", "inline");
			textELE.css("display", "none");
			inputELE.focus();
		}
		else{
			//元素隐藏，输入框显示时被点击
			console.log($(td).attr('class'));
			var cla = td.className;
			cla = cla.substring(0, cla.indexOf(' '));//类名，属性名
			console.log(cla);
			var cid = td.parentElement.id;
			cid = cid.substring(cid.lastIndexOf('u') + 1);//物品ID
			console.log(cid);
			if($(inputELE)[0].tagName === "textarea"){
				var data = inputELE.text();
			}
			else{
				var data = inputELE.val();
			}
			console.log(data);
			modiCmdy(cid, cla, data, textELE);
			//更改成功时，元素文本改变了
			inputELE.css("display", "none");
			textELE.css("display", "inline");
		}
		
	});
});

jQuery(document).ready(function($){
	$(".picName").click(function(e){
		var picTD = e.currentTarget;//获取被点击的td元素
		//console.log(picTD.parentElement.id);//获取父元素ID
		var cid = picTD.parentElement.id;
		cid = cid.substring(cid.indexOf('u') + 1);
		$("#cid").val(cid);
		console.log($("#cid").val());
		var sta = $("#picForm").css("display");
		//console.log(sta);
		sta = (sta == "none" ? "block" : "none");
		$("#picForm").css({
			"top": e.pageY,
			"left": e.pageX,
			"display": sta
		});
	});
});
