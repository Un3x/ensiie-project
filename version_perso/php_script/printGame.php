<?php
	require ('../print_functions.php');
	$story = $_POST['story'];
	if($story == 1){
		printGame();
	}
	else{
		printStoryChoice();
	}
?>