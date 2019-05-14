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

	function hasCurrentStory(){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$request = "SELECT * FROM \"current_story\" WHERE \"pseudo\" = '$pseudo'";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request;
			return NULL;
		}
		else if($result){
			return 0;
		}
		else {
			return 1;
		}
	}

	function currentNode(){

		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$fetchRequest = "SELECT \"step\" FROM \"current_story\" WHERE \"pseudo\" = '$pseudo'";

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

	function getAchievementNode($node){
		$link = dbConnect();
		$request = "SELECT \"ach_id\" FROM \"story_node\" WHERE \"id\" = $node";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
		if(mysqli_num_rows($result) == 0){
			return null;
		}
		else{
			$achArray = $result->fetch();
			return $achArray['ach_id'];
		}
	}

	function getInfoAchievement($ach){
		$link = dbConnect();
		$request = "SELECT \"title\", \"text\", \"icon\" FROM \"achievements\" WHERE  \"id\" = '$ach'";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
		$achInfo = $result->fetch();
		return $achInfo;
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

	function getUserAchievements(){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$request = "SELECT \"achievement\" FROM \"link_achievement_user\" WHERE \"pseudo\" = '$pseudo'";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
		if($result->rowCount() == 0){
			return null;
		}
		else{
			while ($row = $result->fetch()) {
				$userAch[] = $row;
			}
			return $userAch;
		}
	}

	function hasAchievementUser($achId){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$request = "SELECT * FROM \"link_achievement_user\" WHERE \"pseudo\" = '$pseudo' AND \"achievement\" = '$achId'";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
		if($result->rowCount() == 0){
			return 0;
		}
		else{
			return 1;
		}
	}

	function addAchievement($achId){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$date = date("Y-m-d");
		$request = "INSERT INTO \"link_achievement_user\"(\"pseudo\", \"achievement\", \"date_acquired\") VALUES ('$pseudo','$achId','$date')";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
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
		if($result->rowCount() == 0){
			echo "L'utilisateur n'existe pas ou n'a pas d'histoire en cours <br />";
			exit();
		}
		else{
			$userVariables = $result->fetch();
			return $userVariables;
		}
	}

	function getEndInfo(){
		$link = dbConnect();
		$node = currentNode();
		$request = "SELECT end_id, title, full_text FROM \"ends\" WHERE \"end_node\" = $node";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
		if($result->rowCount() == 0){
			echo "Ce node ne correspond pas à une fin. <br />";
			exit();
		}
		$endStats = $result->fetch();
		return $endStats;
	}

	function getNodeModifs(){
		$link = dbConnect();
		$node = currentNode();
		$request = "SELECT modif_alcohol, modif_attendance, modif_ghost,
					modif_bar, modif_baka, modif_diese,
					join_bar, join_baka, join_diese
					FROM \"story_node\" WHERE \"id\" = $node";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
		}
		if($result->rowCount() == 0){
			echo "L'utilisateur n'existe pas ou n'a pas d'histoire en cours <br />";
			exit();
		}
		else{
			$nodeModifs = $result->fetch();
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
		$request = "UPDATE \"current_story\" SET \"ghost\"=$newGhost,
					\"alcohol\"=$newAlcohol,\"attendance\"= $newAttendance,\"bar\"=$newBar,
					\"baka\"=$newBaka,\"diese\"=$newDiese,\"is_bar\"=$newIsBar,
					\"is_baka\"=$newIsBaka,\"is_diese\"=$newIsDiese WHERE \"pseudo\" = '$pseudo'";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			exit();
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
		$request = "UPDATE \"current_story\" SET \"step\"= $newNode WHERE \"pseudo\" = '$pseudo'";
		if(!($result = $link->query($request))){
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
		$request = "INSERT INTO \"completed\"(\"pseudo\", \"end_id\", \"ghost\", \"alcohol\",
											\"attendance\", \"bar\", \"baka\", \"diese\", \"is_bar\",
											\"is_baka\", \"is_diese\", \"date_end\")
											VALUES ('$pseudo', $endId, $ghost, $alcohol,
											$attendance, $bar, $baka, $diese,
											$is_bar, $is_baka, $is_diese, '$date')";

		if(!($result = $link->query($request))){
			echo "Erreur lors de l'insertion<br />";
			echo $request;
			exit();
		}
		$request_2 = "DELETE FROM \"current_story\" WHERE \"pseudo\" = '$pseudo'";
		if(!($result_2 = $link->query($request_2))){
			echo "Erreur lors de la suppression<br />";
			echo $request_2;
			exit();
		}
	}

	function getUserInfo(){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$request = "SELECT \"gender\" FROM \"user_bis\" WHERE \"pseudo\" = '$pseudo'";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request;
			exit();
		}
		$fetchGender = $result->fetch();
		$info['gender'] = $fetchGender['gender'];
		$request_2 = "SELECT COUNT(*) AS 'nb' FROM \"completed\" WHERE \"pseudo\" = '$pseudo'";
		if(!($result_2 = $link->query($request_2))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request_2;
			exit();
		}
		$fetchNumber = $result_2->fetch();
		$info['nb'] = $fetchNumber['nb'];
		return $info;
	}

	function updateUserGender($gender){
		$link = dbConnect();
		$pseudo = $_SESSION['name'];
		$request = "UPDATE \"user_bis\" SET \"gender\"='$gender' WHERE \"pseudo\" = '$pseudo'";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request;
			exit();
		}
	}

	function addUser($pseudo, $pw, $pw_check, $gender){
		$link = dbConnect();
		$request = "SELECT * FROM \"user_bis\" WHERE \"pseudo\" = '$pseudo'";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request;
			exit();
		}
		if($result->rowCount() != 0){
			$state['isValid'] = 0;
			$state['message'] = "Pseudo non disponible.";
			return $state;
		}
		if(strlen($pw) < 6){
			$state['isValid'] = 0;
			$state['message'] = "Mot de passe trop court.";
			return $state;
		}
		if($pw != $pw_check){
			$state['isValid'] = 0;
			$state['message'] = "Les mots de passe ne correspondent pas.";
			return $state;
		}
		$request_2 = "INSERT INTO \"user_bis\"(\"pseudo\", \"hash_bis\", \"gender\") VALUES ('$pseudo', '$pw', '$gender')";
		if(!($result_2 = $link->query($request_2))){
			$state['isValid'] = 0;
			$state['message'] = "Une erreur s'est produite. Veuillez entrez de nouveau vos informations.";
			exit();
		}
		$state['isValid'] = 1;
		return $state;
	}

	function pressBigRedButton(){
		$link = dbConnect();
		$request = "SELECT \"pseudo\" FROM \"user_bis\" WHERE \"pseudo\" <>'DonaldTrump'";

		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request;
			exit();
		}

		while($user = $result->fetch()){
			$toDelete = $user['pseudo'];
			$request_2 = "DELETE FROM \"user_bis\" WHERE \"pseudo\" = '$toDelete'";
			if(!($result_2 = $link->query($request_2))){
				echo "Erreur lors de la suppression massive des données";
				echo $request;
				exit();
			}
		}
	}

	function getAllUsers(){
		$link = dbConnect();
		$request = "SELECT \"pseudo\" FROM \"user_bis\" WHERE 1";
		if(!($result = $link->query($request))){
			echo "Erreur lors de l'exécution de la requête<br />";
			echo $request;
			exit();
		}
		while ($row = $result->fetch()) {
				$allUsers[] = $row;
			}
		return $allUsers;
	}
