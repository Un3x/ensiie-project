<?php
session_start();
require 'controle2_avatar.php';
$pseudo=$_SESSION['pseudo'];
$choix=$_GET['choix']; // récupérartion du choix
// connexion à la base de données
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
or die('could not connect to database');


entrer_avatar($choix);
header("Location: image_profil.php?avatar=1");
$connection=null;

?>
