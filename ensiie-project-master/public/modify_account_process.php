<?php

	require '../vendor/autoload.php';

	//postgres
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

	$userRepository = new \User\UserRepository($connection);
	$users = $userRepository->fetchAll();

	foreach ($users as $user) :
		$pwd_valide = $user->getPassword();
		$id = $user->getId();

		if (isset($_POST['pwd']) && isset($_POST['pwd_modifier']) && isset($_POST['tel_modifier'])) {
			if ($pwd_valide == $_POST['pwd']) {
				session_start();
				$user->setPassword($_POST['pwd_modifier']);
				$user->setTel($_POST['tel_modifier']);
				$new_pwd = $user->getPassword();
				$new_tel = $user->getTel();
				$_SESSION['pwd'] = $_POST['pwd_modifier'];
				$_SESSION['tel'] = $_POST['tel_modifier'];

				$sql ='UPDATE Utilisateur SET tel="'.$_POST['tel_modifier'].'", password="'.$_POST['pwd_modifier'].'" WHERE id="'.$_SESSION['id'].'"';
				$connection->prepare($sql)->execute(); /* TODO */

				
				header ('Location: index.php');
			}
			else {
				echo '<body onLoad="alert(\'Mot de passe incorrect.\')">';
				echo '<meta http-equiv="refresh" content="0;URL=your_account.php">';
			}
		}
		else {
			echo 'Il vous faut remplir tous les champs.';
		}



	endforeach;

?>