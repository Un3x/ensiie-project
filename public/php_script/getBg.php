<?php
	session_start();
	require ('../database_access.php');
	
	$node = currentNode();
	$info = getInfo($node);
	$bg_pic = $info['bg_picture'];
	echo "<img src = \"Visuels/$bg_pic\" />";
	
?>