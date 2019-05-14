<?php
session_start();
require 'controle2_suppression_by_admin.php';
$autre_pseudo=$_GET['autre_pseudo'];
// connexion à la base de données
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
or die('could not connect to database');

//suppression de toutes les informations
supprimer_by_admin($autre_pseudo);

//redirection vers la page d'administrateur
header("Location: compte_admin.php");

//fermeture de la connexion à la base de données
$connection=null;

?>
