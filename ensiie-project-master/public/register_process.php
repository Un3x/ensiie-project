<?php

	require '../vendor/autoload.php';

	//postgres
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

	$userRepository = new \User\UserRepository($connection);
	$users = $userRepository->fetchAll();

	if (isset($_POST['email']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['tel']) && isset($_POST['sport']) && isset($_POST['genre']) && isset($_POST['pwd'])) {

		$nid = "10";
		$nnom = $_POST['nom'];
		$nprenom = $_POST['prenom'];
		$nemail = $_POST['email'];
		$npassword = $_POST['pwd'];
		$ntel = $_POST['tel'];
		$ngenre = $_POST['genre'];
		$nsport = $_POST['sport'];
		$sql = 'INSERT INTO Utilisateur (id, nom, prenom, email, password, tel, genre, sport) VALUES (:nid, :nnom, :nprenom, :nemail, :npassword, :ntel, :ngenre, :nsport)';
		$succes = $connection->prepare($sql)->execute(array('nid'=>$nid, 'nnom'=>$nnom, 'nprenom'=>$nprenom, 'nemail'=>$nemail, 'npassword'=>$npassword, 'ntel'=>$ntel, 'ngenre'=>$ngenre, 'nsport'=>$nsport));  /*TODO*/


		if ($succes) {
			header ('Location: index.php');
		}
		else {
			echo '<body onLoad="alert(\'Vous êtes déjà inscrit.\')">';
			echo '<meta http-equiv="refresh" content="0;URL=index.php">';
		}
	}
	else {
		echo 'Il vous faut remplir tous les champs.';
	}

?>