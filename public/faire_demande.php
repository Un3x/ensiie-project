<?php

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
session_start();
$pseudo=$_SESSION['Pseudo'];
$matiere = $_POST['matiere'];
$jour = $_POST['jour'];
$horaire = $_POST['horaire'];
$connexion->query("INSERT INTO aide(pseudo_aide,pseudo_aidant,aide_matiere,valide,jour,heure,numtel) VALUES('$pseudo', 'NULL', '$matiere', 'false', '$jour', '$horaire', 'NULL');");
header('Location: Demande.html');

?>