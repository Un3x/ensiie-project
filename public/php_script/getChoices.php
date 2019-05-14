<?php
	session_start();
	require ('../database_access.php');
	header( 'content-type: text/html; charset=utf-8' );
	
	$link = dbConnect();
	$node = currentNode();
	$userStats = getUserVariables();
	
	/*Fetching of all the existing choices from the current node*/
	$request_choices = "SELECT DISTINCT \"choice\".\"content\", \"next_node\" FROM \"story_node\" JOIN \"choice\" WHERE \"choice\".\"id\" = $node";
	
	
	if(!($result = $link->query($request_choices))){
			echo "Erreur lors de l'exécution de la requête de choix<br />";
			exit();
		}
	
	/*Planning of the requirement recovering request*/
	
	if (!($request_requirements = $link->prepare("SELECT variable, min, max FROM requirement WHERE node_id = ?"))) {
		echo "Echec lors de la préparation : (" . $link->errno . ") " . $link->error;
	}
	
	if (!$request_requirements->bind_param("i", $id)) {
		echo "Echec lors du liage des paramètres : (" . $request_requirements->errno . ") " . $request_requirements->error;
	}

	/*Requirements collection and test*/
	
	while($row = $result->fetch()){
	
		$content = $row['content'];
		$id = $row['next_node'];
		
		if (!$request_requirements->execute()) {
			echo "Echec lors de l'exécution de la requête : (" . $request_requirements->errno . ") " . $request_requirements->error;
			exit();
		}
		
		if (checkRequirement($request_requirements, $userStats)){
			echo "<div class = 'choice' id = \"$id\">
				$content <br />
				</div>
			";
		}
	}
	
?>
