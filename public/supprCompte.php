<?php include ('view.php');
require '../vendor/autoload.php';

//postgres connexion
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$userRepository = new \User\UserRepository($connection);
$user = new \User\User();

session_start();
$user = $userRepository->fetchOneByMail($_SESSION['mail']);
$userRepository->supprUser($user);
unset($_SESSION['mail']);
header('location:index.php');


?>