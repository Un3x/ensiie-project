<?php
	session_start();
	require ('../database_access.php');
	header( 'content-type: text/html; charset=utf-8' );
	
	$end = getEndInfo();
	
	$jsonEnd = json_encode($end);
	echo $jsonEnd;
?>