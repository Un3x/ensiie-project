<?php
include("../src/User/UserRepository.php");

function verif_authent() {
    $GLOBALS['AUTHENT'] = 0;
}

function getPassword($psd, $mdp){
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
	$userRepository = new \User\UserRepository($connection);

	return $mdp = $userRepository->getPassword($psd);
}
?>