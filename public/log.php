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
     <!--ALED TODO mettre le logo de sciience comme dans toutes les autres pages ainsi qu\'une petite page de garde sympathique-->
     <h1>Page d\'inscription</h1>
     <nav>
         <!-- ALED TODO recopier le nav-->
    </nav>
     <form>
     <input type="text" name="Email"/>
     <input type="text" name="Mot de passe"/>
     <input type="submit" name="Connexion" value="Rendu"/>
     </form>
     </body>
     </html>