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
$auteurRepository = new \Auteur\AuteurRepository($connection);
$auteurs = $auteurRepository->fetchAll();
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Recherche</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
    <h1> Recherche de livre</h1>
    <nav>
         <!-- TODO recopier le nav-->
    </nav>
    <h2>Recherche</h2>
    <form>
         <!--Un seul champ nécessaire : complétion automatique des autres-->
         <!--TODO proposition de complétion-->
         <input type="text" size="20" maxlength=”18” name="Titre_livre" />
         <input type="text" size="20" maxlength=”18” name="Auteur_livre" />
         <input type="Date"  name="Publication_livre" />
         <input type="text" size="20" maxlength=”18” name="Edition_livre" />
         <label for="d">Disponible</label>
         <input type="checkbox" value="d" name="Dispo"/>
         <input type="number"  name="note"/>
         <input type="submit" value="Rechercher" name="sub" />
    </form>
   
</body>