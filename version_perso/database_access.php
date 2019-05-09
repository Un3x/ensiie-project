<?php

	function dbConnect(){
		$servername = "mysql.iiens.net";
		$username = "e_hovi2018";
		$password = "8ZgW1XnSSppPxKaHLNqBIxXpdxzOPg";
		$database = "e_hovi2018";
		// Create connection
		$link = mysqli_connect($servername, $username, $password, $database);
		if(mysqli_connect_errno()){
			printf("Échec de la connexion : %s\n", mysqli_connect_error());
			exit();
		}
		return $link;
	}
	
	function fetchPassword(){
		
		$link = dbConnect();
		$pseudo = $_POST['pseudo'];
		
		$fetchRequest = "SELECT pseudo, hash_bis FROM `user_bis` WHERE pseudo = '$pseudo'";
		if(!($result = mysqli_query($link, $fetchRequest))){
			echo "Erreur lors de l'exécution de la requête<br />";
		}
		else if(mysqli_num_rows($result) != 1){
			return NULL;
		}
		else{
			$row = $result->fetch_assoc();
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
		$fetchRequest = "SELECT step FROM `current_story` WHERE pseudo = '$pseudo'";
		
		if(!($result = mysqli_query($link, $fetchRequest))){
			echo "Erreur lors de l'exécution de la requête<br />";
			return NULL;
		}
		else if(mysqli_num_rows($result) == 0){
			echo "Pas de node courant <br />";
			return -1;
		}
		else if(mysqli_num_rows($result) != 1){
			echo "Erreur : plusieurs histoires en cours<br />";
			return NULL;
		}
		else{
			$row = $result->fetch_assoc();
			return $row['step'];
		}
	}
	
	function newStory(){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$date = date("Y-m-d");
		$createStory = "INSERT INTO `current_story`(`pseudo`, `step`, `date_current`, `ghost`, `alcohol`, `attendance`, `bar`, `baka`, `diese`, `is_bar`, `is_baka`, `is_diese`) VALUES ('$pseudo', 1, '2019-04-28', 50, 50, 50, 50, 50, 50, 0, 0, 0)";	
		
		if(mysqli_query($link, $createStory) === FALSE){
			echo "Erreur lors de la création de la nouvelle histoire <br />";
			exit();
		}
	}

	function getInfo($node){
		$link = dbConnect();
		$request = "SELECT `content`, `bg_picture`, `fg_picture` FROM `story_node` WHERE id = $node";
		
		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
		
		if(mysqli_num_rows($result) == 0){
			echo "Impossible de trouver cette étape dans la base de données <br />";
			exit();
		}
		else{
			$nodeInfo = $result->fetch_assoc();
			return $nodeInfo;
		}
	}
	
	function getUserVariables(){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$request = "SELECT ghost, alcohol, attendance, bar, baka, diese, is_bar, is_baka, is_diese FROM `current_story` WHERE pseudo = '$pseudo'";
		
		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
		
		if(mysqli_num_rows($result) == 0){
			echo "L'utilisateur n'existe pas ou n'a pas d'histoire en cours <br />";
			exit();
		}
		else{
			$userVariables = $result->fetch_assoc();
			return $userVariables;
		}
	}
	
	/*Check is the user has the required stats to pass a requirement.
		Returns TRUE if they do, else FALSE*/
		
	function checkRequirement($request, $userStats){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		
		$request->bind_result($variable, $min, $max);
		
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
		$request = "UPDATE `current_story` SET `step`= $newNode WHERE pseudo = '$pseudo'";
		echo "$request <br />";
	
		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
	}
?>