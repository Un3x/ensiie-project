<?php
	session_start();
	require ('../database_access.php');

	$link = dbConnect();
	$node = currentNode();
	$userStats = getUserVariables();

	/*Fetching of all the existing choices from the current node*/
  $request_choices = "
    SELECT DISTINCT \"story_node\".\"content\", \"choice\".\"next_node\"
    FROM \"story_node\", \"choice\"
    WHERE \"choice\".\"id\" = $node
    AND \"story_node\".\"id\" = $node";

	if(!($result = $link->query($request_choices))){
			echo "Erreur lors de l'exécution de la requête de choix<br />";
			exit();
		}

	/*Planning of the requirement recovering request*/
	if (!($request_requirements = $link->prepare("SELECT req.\"variable\", req.\"min\", req.\"max\" FROM \"requirement\" AS req WHERE req.\"node_id\" = :id"))) {
		echo "Echec lors de la préparation";
	}
	if (!$request_requirements->bindParam(":id", $id, PDO::PARAM_INT)) {
		echo "Echec lors du liage des paramètres";
	}

	/*Requirements collection and test*/
  while($row = $result->fetch())
  {
		$content = $row['content'];
		$id = $row['next_node'];
		if (!$request_requirements->execute()) {
			echo "Echec lors de l'exécution de la requête";
			exit();
		}
		if (checkRequirement($request_requirements, $userStats)){
			echo "<div class = 'choice' id = \"$id\">
				$content <br />
				</div>
			";
		}
	}
