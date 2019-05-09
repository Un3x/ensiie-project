<?php
echo"
	actualizeFront();
	$(document).ready(function(){
		$(\"#choices\").click(function(){
			console.log('Cliqué : ' + $(this).html());
		});
	}); ";
?>
