<?php
session_start();
require 'controle2_suppression.php';

// connexion à la base de données
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
or die('could not connect to database');

//suppression de toutes les informations
supprimer();

//redirection vers la page d'aurevoir
header("Location: aurevoir.php");

//fermeture de la connexion à la base de données
$connection=null;

?>