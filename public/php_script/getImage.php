<?php
	session_start();
	require ('../database_access.php');
	
	$node = currentNode();
	$info = getInfo($node);
	$fg_pic = $info['fg_picture'];
	echo "<img src = \"Visuels/$fg_pic\" />";
	
?>