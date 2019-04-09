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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Page dajoutdelivre</title>
    </head>
    <body>
    <div class="container">
    <h1>Page d\'ajout de livre \(Réservé aux Admins\)</h1>
    <form>
    <!--ALED TODO completer avec bd-->
    <input type="text" name="Titre Livre"/>
    <input type="text" name="Auteur1"/>
    <input display="none" type="text" name="Auteur2"/>
    <input display="none" type="text" name="Auteur3"/>
    <input type="text" name="DatePublication"/>
    <input type="text" name="Image"/>
    <input type="text" name="Edition"/>
    <input type="submit" value="rendu">
    </body>
    </html>
    
    
    
