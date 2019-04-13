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
<meta charset="utf-8">
    <title>Editer</title>
    <link rel="stylesheet" href=".css">
     </head>
     <body>
     <!--ALED TODO mettre le logo de sciience comme dans toutes les autres pages ainsi qu\'une petite page de garde sympathique-->
     <h1>Page d\'édition du profil</h1>
     <nav>
         <!-- ALED TODO recopier le nav-->
    </nav>
     <form>
     <input type="text" name="Nouveau prenom"/>
     <input type="text" name="Nouveau nom"/>
     <input type="text" name="Nouveau pseudo"/>
     <input type="text" name="Nouveau mot de passe"/>
     <input type="text" name="Confirmation nouveau mot de passe"/>
     <input type="text" name="Nouvelle date de naissance"/>
     <input type="text" name="Nouvel email"/>
     <input type="submit" name="Envoyer" value="Rendu"/>
     </form>
     </body>
     </html>