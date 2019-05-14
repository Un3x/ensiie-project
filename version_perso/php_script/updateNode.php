<?php
	session_start();
	require ('../database_access.php');
	$newNode = $_POST['node'];
	updateNode($newNode);
?>