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
?>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href=".css">
</head>
    <body>
    <h1>Bienvenue sur le site de ScIIEnce</h1>
     <img src=""><!--ALED TODO le logo de sciience est le groupe R12 -->
    <nav><!--TODO ALED Les liens sont à ajouter--></nav>
     <p>Voici le site officiel de ScIIEnce, l\'association pour le gens en manque de physique de l\'ENSIIE. Vous pouvez ici réserver un livre de la bibliothèque du savoir de l\'association  afin de l\'emprunter. D\'autres fonctionnalités viendront plus tard mais pour l\'instant, c\'est déja pas mal ...</p>
     <p>Pour vous instruire </p><a href="https://fr.wikipedia.org/wiki/Portail:Sciences">cliquez ici</a>
     <body>
</html>
