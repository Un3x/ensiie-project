<?php
	function dbConnect(){
		$servername = "localhost";
		$username = "ensiie";
		$password = "ensiie";
		$database = "ensiie";
		// Create connection
    $link = new PDO("pgsql:host=postgres dbname=ensiie user=ensiie password=ensiie");
    if(!$link)
    {
			printf("Échec de la connexion\n");
			exit();
		}
		return $link;
	}

	function fetchPassword(){

		$link = dbConnect();
		$pseudo = $_POST['pseudo'];
		$fetchRequest = "SELECT hash_bis FROM \"user_bis\" AS u WHERE u.\"pseudo\" = '$pseudo'";
		if(!($result = $link->query($fetchRequest))){
			echo "Erreur lors de l'exécution de la requête<br />";
		}
		else if(!$result){
			return NULL;
		}
		else{
			$row = $result->fetch();
			return $row['hash_bis'];
		}
	}

	function checkUser(){

		$result = fetchPassword();
		if ($result == NULL || $_POST['password'] != $result){
			printf("Mot de passe ou nom d'utilisateur erroné \n");
			return 0;
		}
		else{
			$_SESSION["name"] = $_POST["pseudo"];
			return 1;
		}
	}

	function currentNode(){

		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$fetchRequest = "SELECT step FROM \"current_story\" WHERE pseudo = '$pseudo'";

		if(!($result = $link->query($fetchRequest))){
			echo "Erreur lors de l'exécution de la requête<br />";
			return NULL;
		}
		else if(!$result){
			echo "Pas de node courant <br />";
			return -1;
		}
		else if(!$result){
			echo "Erreur : plusieurs histoires en cours<br />";
			return NULL;
		}
		else{
			$row = $result->fetch();
			return $row['step'];
		}
	}

	function newStory(){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$date = date("Y-m-d");
		$createStory = "INSERT INTO \"current_story\"(\"pseudo\", \"step\", \"date_current\", \"ghost\", \"alcohol\", \"attendance\", \"bar\", \"baka\", \"diese\", \"is_bar\", \"is_baka\", \"is_diese\") VALUES ('$pseudo', 1, '2019-04-28', 50, 50, 50, 50, 50, 50, 0, 0, 0)";
		if(!$link->query($createStory)){
			echo "Erreur lors de la création de la nouvelle histoire <br />";
			exit();
		}
	}

	function getInfo($node){
		$link = dbConnect();
		$request = "SELECT \"content\", \"bg_picture\", \"fg_picture\" FROM \"story_node\" WHERE id = $node";

		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}

		if(!$result){
			echo "Impossible de trouver cette étape dans la base de données <br />";
			exit();
		}
		else{
			$nodeInfo = $result->fetch();
			return $nodeInfo;
		}
	}

	function getUserVariables(){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$request = "SELECT ghost, alcohol, attendance, bar, baka, diese, is_bar, is_baka, is_diese FROM \"current_story\" WHERE pseudo = '$pseudo'";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}

		if(!$result){
			echo "L'utilisateur n'existe pas ou n'a pas d'histoire en cours <br />";
			exit();
		}
		else{
			$userVariables = $result->fetch();
			return $userVariables;
		}
	}

	/*Check is the user has the required stats to pass a requirement.
		Returns TRUE if they do, else FALSE*/

	function checkRequirement($request, $userStats){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];

    $request->bindColumn(1, $variable);
    $request->bindColumn(2, $min);
    $request->bindColumn(3, $max);

		while($request->fetch()){
			$userStat = $userStats["$variable"];
			if(($min != NULL && $min > $userStat) || ($max != NULL &&$max < $userStat)){
				return 0;
			}
		}

		return 1;

	}

	function updateNode($newNode){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$request = "UPDATE \"current_story\" SET \"step\"= $newNode WHERE pseudo = '$pseudo'";
		echo "$request <br />";

		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
	}
