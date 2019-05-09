
function actualizeFront(){
	$(document).ready(function(){
		$.post("php_script/getBg.php", 
		function(truc){
			$("#visuel").html(truc);
		});
	
		$.post("php_script/getChoices.php", 
		function(result){
			$("#choices").html(result);
		});
	});
}

function actualizeBack(obj){
	var id = $(obj).attr("id");
	
	$.post("php_script/updateNode.php",
			{node: id},
			function(){
				actualizeFront();
			});
}



