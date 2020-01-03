// JavaScript Document
/* 鼠标特效 */
	var a_idx = 0; 
	jQuery(document).ready(function($) { 
		"use strict";
		$("body").click(function(e) { 
			var a = new Array("Java", "C", "Python", "C++", "C#", "Visual Basic .NET", "JavaScript", "PHP", "SQL", "Swift", "Ruby", "Delphi/Object Pascal", "Objective-C", "Assembly language", "Go", "R", "MATLAB", "D", "Visual Basic", "Perl", "SAS", "Groovy", "Dart", "PL/SQL", "Scratch", "Scala", "Lisp", "COBOL", "Fortran", "Kotlin", "Rust", "Transact-SQL", "Logo", "ABAP", "Lua", "Ada", "TypeScript", "RPG", "ML", "PowerShell", "Haskell", "LabVIEW", "Julia", "Scheme", "Hack", "OpenEdge ABL", "ActionScript", "LiveCode", "F#", "Prolog");
			//var a = new Array("Benny哥好帅!!!", "Benny哥好厉害!!!", "Benny哥最好了!!!", "Benny哥新年快乐!!!");
			var $i = $("<span/>").text(a[a_idx]); 
			a_idx = (a_idx + 1) % a.length; 
			var x = e.pageX, 
			y = e.pageY; 
			$i.css({ 
				"z-index": 999999999999999999999999999999999999999999999999999999999999999999999, 
				"top": y - 20, 
				"left": x, 
				"position": "absolute", 
				"font-weight": "bold", 
				"font-size": "150%",
				"color": '#'+Math.floor(Math.random()*0xffffff).toString(16)
			}); 
			$("body").append($i); 
			$i.animate({ 
				"top": y - 180, 
				"opacity": 0 
			}, 
			1500, 
			function() { 
				$i.remove(); 
			}); 
		}); 
	}); 

	function consequent(str){
		"use strict";
		var $i = $("<span/>").text(str);
		$i.css({
			"z-index": 3,
			"top": "50%",
			"left": "60%",
			"position": "absolute",
			"font-weight": "bold",
			"font-size": "150%",
			"color": "rgb(196, 215, 0)",
		});
		$("body").append($i);
		$i.animate({ 
			"top": "30%", 
			"opacity": 0 
		}, 
		1500, 
		function() { 
			$i.remove(); 
		});
	}

	function change(k, e, id){
		"use strict";
		if(id === "jia" || id === "jian"){
			e.src = "../image/" + id.toString() + k.toString() + ".png";
		}
		else{
			var img = e.getElementsByTagName('img')[0];
			if(k === 1 && (id === 'cart' || id === 'wallet')){
				img.src = "../image/" + id + "2.png";
			}
			else if(k === 2 && (id === 'cart' || id === 'wallet')){
				img.src = "../image/" + id + "1.png";
			}
			else if(k == 1 && id === 'Favor'){
				img.style.transform = "rotate(360deg)";
			}
			else{
				img.style.transform = "";
			}
		}
	}