<?php
	session_start();
	require ('../database_access.php');
	header( 'content-type: text/html; charset=utf-8' );
	
	$users = getAllUsers();
	
	foreach ($users as $value){
		echo $value['pseudo'];
	}
	
?>