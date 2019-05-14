<?php
	session_start();
	require ('../database_access.php');
	header( 'content-type: text/html; charset=utf-8' );
	
	$pseudo = $_SESSION['name'];
	
	if($pseudo == "DonaldTrump"){
		pressBigRedButton();
	}
	
?>