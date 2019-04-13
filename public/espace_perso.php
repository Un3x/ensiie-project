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
     <h2>Vous pouvez ici consulter votre espace perso au cas où vous auriez oublié votre nom,prenom ou autre.</h2>
     <p> Nom:<br/>
Prenom:<br/>
     Email:<br/>
     Photo de profil:<br/>
     Photo de face:<br/>
     Photo de dos:<br/>
     Photo de couverture:</br>
     </p>
     </body>
     </html>
     
     