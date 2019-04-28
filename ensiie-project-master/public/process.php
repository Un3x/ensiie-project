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
		$login_valide = $user->getEmail();
		$pwd_valide = $user->getPassword();
		$login_valide = stripslashes($login_valide);
		$pwd_valide = stripslashes($pwd_valide);

		if (isset($_POST['login']) && isset($_POST['pwd'])) {
			if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {
				session_start ();
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['pwd'] = $_POST['pwd'];
				header ('Location: index.php');
			}
			else {
				echo '<body onLoad="alert(\'Username ou mot de passe incorrect.\')">';
				echo '<meta http-equiv="refresh" content="0;URL=login.php">';
			}
		}
		else {
			echo 'Probleme : variable(s) non déclaree(s)';
		}



	endforeach;

?>