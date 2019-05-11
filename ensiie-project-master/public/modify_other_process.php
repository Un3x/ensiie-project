<?php

	require '../vendor/autoload.php';

	function tryMod(object $connection, array $users, string $type)
    {
    	foreach ($users as $user) :
			$user_valide = $user->getEmail();
			$id = $user->getId();
			if ($user_valide == $_POST['email']) {
				session_start();
				$user->setPassword($_POST['pwd_modifier']);
				$user->setTel($_POST['tel_modifier']);
				$new_pwd = $user->getPassword();
				$new_tel = $user->getTel();
				$_SESSION['pwd'] = $new_pwd;
				$_SESSION['tel'] = $new_tel;

				$sql ='UPDATE '.$type.' SET tel=:ntel, password=:npwd WHERE id=:nid';
				$connection->prepare($sql)->execute(array('ntel' => ''.$new_tel, 'npwd'=>''.$new_pwd, 'nid'=>''.$id));

				header ('Location: index.php');
				return true;
			}
			else return false;
		endforeach;
    }
	//postgres
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

	$userRepository = new \User\UserRepository($connection);
	$ok = false;

	if (isset($_POST['email']) && isset($_POST['tel_modifier']) && isset($_POST['pwd_modifier'])) {
		$users = $userRepository->fetchAllParticipant();
		$type = "Participant";
		$ok = tryMod($connection, $users, $type);
		if (!$ok) {
			$users = $userRepository->fetchAllJury();
			$type = "Jury";
			tryMod($connection, $users, $type);
		}
		if (!$ok) {
			$type = "Organisateur";
			$users = $userRepository->fetchAllOrganisateur();
			tryMod($connection, $users, $type);
		}
	}
	else {
		echo 'Il vous faut remplir tous les champs.';
	}


	echo '<body onLoad="alert(\'Email ou Type de compte incorrect .\')">';
	echo '<meta http-equiv="refresh" content="0;URL=index.php">';

?>