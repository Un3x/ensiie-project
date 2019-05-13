<?php
	header( 'content-type: text/html; charset=utf-8' );

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
		mysqli_set_charset($link,"utf8");
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
	
	function hasCurrentStory(){
		
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		
		$request = "SELECT * FROM `current_story` WHERE pseudo = '$pseudo'";
		
		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request;
			return NULL;
		}
		else if(mysqli_num_rows($result) == 0){
			return 0;
		}
		else { 
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
		$createStory = "INSERT INTO `current_story`(`pseudo`, `step`, `date_current`, `ghost`, `alcohol`, `attendance`, `bar`, `baka`, `diese`, `is_bar`, `is_baka`, `is_diese`) VALUES ('$pseudo', 1, '$date', 50, 50, 50, 50, 50, 50, 0, 0, 0)";	
		
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
			return json_encode($nodeInfo, JSON_UNESCAPED_UNICODE);
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
	
	function getEndInfo(){
		
		$link = dbConnect();
		$node = currentNode();
		
		$request = "SELECT end_id, title, full_text FROM `ends` WHERE `end_node` = $node";
		
		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
		if(mysqli_num_rows($result) == 0){
			echo "Ce node ne correspond pas à une fin. <br />";
			exit();
		}
		$endStats = $result->fetch_assoc();
		return $endStats;
		
	}
	
	function getNodeModifs(){
		$link = dbConnect();
		$node = currentNode();
		$request = "SELECT modif_alcohol, modif_attendance, modif_ghost,
					modif_bar, modif_baka, modif_diese,
					join_bar, join_baka, join_diese
					FROM story_node WHERE id = $node";
		
		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
		
		if(mysqli_num_rows($result) == 0){
			echo "L'utilisateur n'existe pas ou n'a pas d'histoire en cours <br />";
			exit();
		}
		else{
			$nodeModifs = $result->fetch_assoc();
			return $nodeModifs;
		}
	}
	
	function updateStats(){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		
		$currentStats = getUserVariables();
		$statsModif = getNodeModifs();
		
		
		
		$newGhost = $currentStats['ghost'] + $statsModif['modif_ghost'];
		$newAlcohol = $currentStats['alcohol'] + $statsModif['modif_alcohol'];
		$newAttendance = $currentStats['attendance'] + $statsModif['modif_attendance'];
		$newBar = $currentStats['bar'] + $statsModif['modif_bar'];
		$newBaka = $currentStats['baka'] + $statsModif['modif_baka'];
		$newDiese = $currentStats['diese'] + $statsModif['modif_diese'];
		
		if($statsModif['join_bar'] == 1){
			$newIsBar = 1;
		}
		else if($statsModif['join_bar'] == -1){
			$newIsBar = 0;
		}
		else{
			$newIsBar = $currentStats['is_bar'];
		}
		
		if($statsModif['join_baka'] == 1){
			$newIsBaka = 1;
		}
		else if($statsModif['join_baka'] == -1){
			$newIsBaka = 0;
		}
		else{
			$newIsBaka = $currentStats['is_baka'];
		}
		
		if($statsModif['join_diese'] == 1){
			$newIsDiese = 1;
		}
		else if($statsModif['join_diese'] == -1){
			$newIsDiese = 0;
		}
		else{
			$newIsDiese = $currentStats['is_diese'];
		}
		
		$request = "UPDATE `current_story` SET `ghost`=$newGhost,
					`alcohol`=$newAlcohol,`attendance`= $newAttendance,`bar`=$newBar,
					`baka`=$newBaka,`diese`=$newDiese,`is_bar`=$newIsBar,
					`is_baka`=$newIsBaka,`is_diese`=$newIsDiese WHERE `pseudo` = '$pseudo'";
		
		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
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
	
		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
	}
	
	function insertEnd(){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		
		$end = getEndInfo();
		$endId = $end['end_id'];

		$stats = getUserVariables();
		$ghost = $stats['ghost'];
		$alcohol = $stats['alcohol'];
		$attendance = $stats['attendance'];
		$bar = $stats['bar'];
		$baka = $stats['baka'];
		$diese = $stats['diese'];
		$is_bar = $stats['is_bar'];
		$is_baka = $stats['is_baka'];
		$is_diese = $stats['is_diese'];
		
		$date = date("Y-m-d");
		/*
		$request = "INSERT INTO `completed`(`pseudo`, `end_id`, `ghost`, `alcohol`,
											`attendance`, `bar`, `baka`, `diese`, `is_bar`, 
											`is_baka`, `is_diese`, `date_end`) 
											VALUES ('$pseudo', $endId, $ghost, $alcohol,
											$attendance, $bar, $baka, $diese, 
											$is_bar, $is_baka, $is_diese, '$date')";

		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'insertion<br />";
			echo $request;
			exit();
		}
		*/
		$request_2 = "DELETE FROM `current_story` WHERE `pseudo` = '$pseudo'";
		if(!($result_2 = mysqli_query($link, $request_2))){
			echo "Erreur lors de la suppression<br />";
			echo $request_2;
			exit();
		}		
	}
	
	function getUserInfo(){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		
		$request = "SELECT `gender` FROM `user_bis` WHERE `pseudo` = '$pseudo'";
		
		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request;
			exit();
		}	
		
		$fetchGender = $result->fetch_assoc();
		$info['gender'] = $fetchGender['gender'];
		
		$request_2 = "SELECT COUNT(*) AS 'nb' FROM `completed` WHERE `pseudo` = '$pseudo'";
		
		if(!($result_2 = mysqli_query($link, $request_2))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request_2;
			exit();
		}	
		$fetchNumber = $result_2->fetch_assoc();
		$info['nb'] = $fetchNumber['nb'];
		
		return $info;
		
		
	}
	
	function updateUserGender($gender){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		
		$request = "UPDATE `user_bis` SET `gender`='$gender' WHERE `pseudo` = '$pseudo'";
		
		if(!($result = mysqli_query($link, $request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request;
			exit();
		}	
		
	}
	
?>