<?php
session_start();

// connexion à la base de données
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
or die('could not connect to database');

if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher")
{
    $_GET["terme"] = htmlspecialchars($_GET["terme"]); //pour sécuriser le formulaire contre les intrusions html
    $terme = $_GET["terme"];
    $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
    $terme = strip_tags($terme); //pour supprimer les balises html dans la requête

    if (isset($terme)) {
      header("Location: recherche.php?arg1=$terme"); // on renvoie $terme pour pouvoir faire la requete
     }
 else
 {
     $message="Vous devez entrer tout ou partie d'un pseudo, nom ou prénom!";
     header("Location: recherche.php?arg2=$message");
 }
}

$connection=null;
?>
