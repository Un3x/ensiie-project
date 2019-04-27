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
    <h2>Review</h2>
    <nav>
         <!-- TODO recopier le nav-->
    </nav>
    <div class="container">
    <h2>liste des review</h2>
    <form>
         <!--Un seul champ nécessaire : complétion automatique des autres-->
         <!--TODO proposition de complétion en fonction de ce l\'utilisateur a emprunté-->
         <input type="text" size="20" maxlength=”18” name="Titre_livre" />
         <input type="text" size="20" maxlength=”18” name="Auteur_livre" />
         <input type="Date"  name="Publication_livre" />
         <input type="text" size="20" maxlength=”18” name="Edition_livre" />
         <input type="text" size="20" maxlength=”500” name="Commentaire_livre" />
         <input type="number" name="Note" />
         <input type="hidden" size="20" maxlength=”18” name="Pseudo_reservation" />
         <input type="hidden" size="20" maxlength=”18” name="Nom_reservation" />
         <input type="hidden" size="20" maxlength=”18” name="Prénom_reservation" />    
         <input type="hidden" name="Date" />
         <input type="submit" value="Poster" name="sub" />
    </form>
</div>
    <!--TODO mettre à jour "Review" -->
</body>