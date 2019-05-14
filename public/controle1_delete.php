<?php
require 'controle2_delete.php';

// connexion à la base de données
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
or die('could not connect to database');

//récupération des valeurs passées par la méthode get via le lien
$auteur=$_GET['auteur'];
$commentaire=$_GET['commentaire'];
$commentateur=$_GET['commentateur'];
$dat=$_GET['dat'];
$heur=$_GET['heur'];

//suppression du commentaire suite à la demande de l'auteur
delete($auteur,$commentaire,$commentateur,$dat,$heur);

//redirection vers la page d'aurevoir
header("Location:admin1.php");

//fermeture de la connexion à la base de données
$connection=null;
?>