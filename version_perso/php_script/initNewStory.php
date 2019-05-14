<?php
	session_start();
	require ('../database_access.php');
	header( 'content-type: text/html; charset=utf-8' );
	
	$node = $_POST['nodeId'];
	if(getInfo($node) != null){
		newStory($node);
	}
?>