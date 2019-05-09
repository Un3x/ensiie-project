<?php
	session_start();
	require ('../database_access.php');
	$newNode = $_POST['node'];
	echo "Id = $newNode <br />";
	updateNode($newNode);
?>