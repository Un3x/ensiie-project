<!DOCTYPE html>
<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
$livreRepository = new \Livre\LivreRepository($connection);
$livres = $livreRepository->fetchAll();
?>
<html>
<head>
	<meta charset="utf-8">
    <title>Bilbiothèque</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
	<h1>Bilbiothèque</h1>
	<nav>
       <!-- ALED TODO recopier le nav-->
       </nav>
       <p>Vous pouvez parcourir notre bilbiothèque</p>
   </body>
</html>