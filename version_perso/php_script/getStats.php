<?php
	session_start();
	require ('../database_access.php');

	$stats = getUserVariables();
	$jsonStats = json_encode($stats);
	
	echo $jsonStats;
?>