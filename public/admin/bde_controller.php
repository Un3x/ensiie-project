<?php
session_start();
if(empty($_SESSION['login']) || empty($_SESSION['bde'])) 
{
	// Si inexistante ou nulle, on redirige vers le formulaire de login
	header('Location: ../authentification.php');
	exit();
}
require '../../vendor/autoload.php';
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();




//suppression d'un membre du bde
if (array_key_exists('suppr',$_POST)){
	if ($connection->query("select president from associations where name='BDE'")->fetch(\PDO::FETCH_OBJ)->president != $_POST['usertomodif']){
	if ($connection->query("update users set bde=0 where id_user=".$_POST['usertomodif']))	  {
	}	
	}
}

header('Location: ../bde.php')
?>

