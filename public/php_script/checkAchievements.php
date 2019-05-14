<?php
	session_start();
	require ('../database_access.php');
	header( 'content-type: text/html; charset=utf-8' );
	
	
	$node = currentNode();
	$ach = getAchievementNode($node);
	
	
	
	if(($ach != null) && !(hasAchievementUser($ach))){
		addAchievement($ach);
		$achInfo = getInfoAchievement($ach);
		echo json_encode($achInfo);
	}
	
?>