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
$historiqueRepository = new \Historique\HistoriqueRepository($connection);
$historiques = $historiqueRepository($connection);
$livreRepository = new \Livre\LivreRepository($connection);
$livres = $livreRepository->fetchAll();
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Validation de rendu</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
    <h1> Page de rendu  des livres</h1>
    <p>Cette page est réservé aux administrateurs de la bibliothèque de ScIIEnce, si vous ne l\'êtes pas merci de quitter cette page</p>
    <nav>
         <!-- TODO recopier le nav>
    </nav>
    <h2>Rendu des livres</h2>
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
         <label for="N">Neuf</label>
         <input type="radio" name="Etat" value="N"/>
         <label for="B">Bon</label>
         <input type="radio" name="Etat" value="B"/>
         <label for="M">Moyen</label>
         <input type="radio" name="Etat" value="M"/>
         <label for="Ma">Mauvais</label>
         <input type="radio" name="Etat" value="Ma" />
         <label for="I">Inutilisable</label>
         <input type="radio" name="Etat" value="I" />
    
         <input type="hidden" name="Date" />
         <input type="hidden" name="Pseudo_Admin" />
         <input type="submit" value="Rendu" name="sub" />
    </form>
    <!--TODO mettre à jour "livre emprunt", "histo", "Livre", "User"-->
</body>
