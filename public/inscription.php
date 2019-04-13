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
     <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href=".css">
     </head>
     <body>
     <!--ALED TODO mettre le logo de sciience comme dans toutes les autres pages ainsi qu\'une petite page de garde sympathique-->
     <h1>Page d\'inscription</h1>
     <nav>
         <!-- TODO recopier le nav-->
    </nav>
     <form>
     <input type="text" name="Prenom"/>
     <input type="text" name="Nom"/>
     <input type="text" name="Pseudo"/>
     <input type="text" name="Mot de passe"/>
     <input type="text" name="Confirmation mot de passe"/>
     <input type="text" name="Date de naissance"/>
     <input type="text" name="Email"/>
     <input type="submit" name="Envoyer" value="Rendu"/>
     </form>
     </body>
     </html>