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
    <title>Emprunt</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
    <h1> Emprunt de livre</h1>
        <p>Cette page est réservé aux administrateurs de la bibliothèque de ScIIEnce, si vous ne l\'êtes pas merci de quitter cette page</p>
    <nav>
         <!-- TODO recopier le nav>
    </nav>
    <h2>Emprunt</h2>
    <form>
         <!--Un seul champ nécessaire : complétion automatique des autres-->
         <!--TODO proposition de complétion-->
         <input type="text" size="20" maxlength=”18” name="Titre_livre" />
         <input type="text" size="20" maxlength=”18” name="Auteur_livre" />
         <input type="Date"  name="Publication_livre" />
         <input type="text" size="20" maxlength=”18” name="Edition_livre" />
         <input type="text" size="20" maxlength=”18” name="Pseudo_emprunteur" />
         <input type="text" size="20" maxlength=”18” name="Nom_emprunteur" />
         <input type="text" size="20" maxlength=”18” name="Prénom_emprunteur" />
         <input type="hidden" name="Date" />
         <input type="hidden" name="Pseudo_Admin" />
         <input type="submit" value="Emprunté" name="sub" />
    </form>
   <!--TODO mettre à jour "livre emprunt", "Livre", "User"-->
</body>