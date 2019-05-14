<?php
	session_start();
	require ('../database_access.php');
	header( 'content-type: text/html; charset=utf-8' );
	
	$node = currentNode();
	$info = getInfo($node);
	$fg_pic = $info['fg_picture'];
	echo "<img src = \"Visuels/$fg_pic\" />";
	
?>