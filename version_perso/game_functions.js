
function actualizeFront(){
	$(document).ready(function(){
		$.getJSON("php_script/getBg.php", 
		function(info){
			$("#visuel").html("<img id = \"bg_picture\" src = \"Visuels/" + info.bg_picture + "\"/>");
			if(info.fg_picture != null){
				$("#visuel").append("<div id = \"fg\"><img src = \"Visuels/" + info.fg_picture + "\"/></div>");
			}
			$("#visuel").append("<div id = \"step_text\"><p class = \"grey\">" + info.content + "</p></div>");
		});
		
	
		$.post("php_script/getChoices.php", 
		function(result){
			if(result == ""){
				$("#choices").html("<div class = \"logout_button\" id = \"end_button\">Finir l'histoire</div>");
			}
			else{
			$("#choices").html(result);
			}
		});
		$.getJSON("php_script/getStats.php", 
		function(data){
			$("#diese").css("width", data.diese + "%");
			$("#baka").css("width", data.baka + "%");
			$("#bar").css("width", data.bar + "%");
			if(data.is_bar == 1){
				$("#is_bar").css("opacity", "1");
			}
			else{
				$("#is_bar").css("opacity", "0.4");
			}
			if(data.is_diese == 1){
				$("#is_diese").css("opacity", "1");
			}
			else{
				$("#is_diese").css("opacity", "0.4");
			}
			if(data.is_baka == 1){
				$("#is_baka").css("opacity", "1");
			}
			else{
				$("#is_baka").css("opacity", "0.4");
			}
		});
		
	});
}




function actualizeBack(obj){
	
	var id = $(obj).attr("id");
	
	$.post("php_script/updateNode.php",
			{node: id},
			function(){
				$.post("php_script/updateStats.php", function(){
					actualizeFront();
				});
			});
	
	}
	
function printEnd(){
	$("#visuel").append("<div class = \"round_rect\" id = \"end_stats\"> </div>");
	$("#end_stats").load("php_script/endStats.txt");
	$.getJSON("php_script/getEnd.php", function(end){
		$("#end_title").html(end.title);	
	});
	$.getJSON("php_script/endStats.php",
		function(stats){
			$.post("php_script/updateEnd.php");
			$("#stat_al").prepend(stats.alcohol);
			$("#stat_go").prepend(stats.ghost);
			$("#stat_at").prepend(stats.attendance);
			$("#end_stats").fadeTo(700, 1, function(){
				$("#end_title").fadeTo(700, 1, function(){
						$("#stat_al").delay("slow").fadeTo(700, 1, function(){
							$("#stat_go").fadeTo(700, 1, function(){
								$("#stat_at").fadeTo(700, 1);
							});
						});
					});
				});
		});
}

function initNewStory(story){
	$.post("php_script/initNewStory.php", 
		{storyId: story},
		function (){
		location.reload();
	});
}

function showPopup(){
	document.getElementById("pseudo_modif").style.display = "block";
	document.getElementById("pseudo_modif").style.opacity = "1";
}

function hidePopup(){
	
	document.getElementById("pseudo_modif").style.opacity = "0";
	document.getElementById("pseudo_modif").style.display = "none";
}


