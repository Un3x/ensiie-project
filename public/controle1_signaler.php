<?php
session_start();
require 'controle2_signaler.php';

// connexion à la base de données
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
or die('could not connect to database');

//récupération du signalement
$commentaire=$_GET['commentaire'];
$commentateur=$_GET['commentateur'];
$dat=$_GET['dat'];
$heur=$_GET['heur'];
signaler($commentaire,$commentateur,$dat,$heur);

//redirection vers profil
header("Location: profil.php");

//deconexion base de donnees
$connection=null;

?>
