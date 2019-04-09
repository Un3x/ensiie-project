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
    <title>Reservation</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
    <h1> Reservation de livre</h1>
    <p>Attention une réservation n\'équivaut pas à un emprunt</p>
    <nav>
         <!-- TODO recopier le nav>
    </nav>
    <h2>Réservation</h2>
    <form>
         <!--Un seul champ nécessaire : complétion automatique des autres-->
         <!--TODO proposition de complétion-->
         <input type="text" size="20" maxlength=”18” name="Titre_livre" />
         <input type="text" size="20" maxlength=”18” name="Auteur_livre" />
         <input type="Date"  name="Publication_livre" />
         <input type="text" size="20" maxlength=”18” name="Edition_livre" />
         <input type="hidden" size="20" maxlength=”18” name="Pseudo_reservation" />
         <input type="hidden" size="20" maxlength=”18” name="Nom_reservation" />
         <input type="hidden" size="20" maxlength=”18” name="Prénom_reservation" />    
         <input type="hidden" name="Date" />
         <input type="submit" value="Réserver" name="sub" />
    </form>
    <!--TODO mettre à jour "Réservation" -->
</body>