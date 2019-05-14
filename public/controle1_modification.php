<?php
session_start();

// connexion à la base de données
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
or die('could not connect to database');

if(isset($_POST['nnom'])) {
    $nnom=$_POST['nnom']; // si un nom est entré, il est récupéré
}
else {
    $nnom=""; // si aucun nom entré, on prend la chaine vide. pareil pour toute la suite!
}
if(isset($_POST['nprenom'])) {
    $nprenom=$_POST['nprenom'];
}
else {
    $nprenom="";
}
if(isset($_POST['nville'])) {
    $nville=$_POST['nville'];
}
else {
    $nville="";
}
if(isset($_POST['nregion'])) {
    $nregion=$_POST['nregion'];
}
else {
    $nregion="";
}
if(isset($_POST['nphrase'])) {
    $nphrase=$_POST['nphrase'];
}
else {
    $nphrase="";
}
if(isset($_POST['nmdp'])) {
    $nmdp=$_POST['nmdp'];
}
else {
    $mdp="";
}
header("Location: modification.php?arg1=$nnom&arg2=$nprenom&arg3=$nville&arg4=$nregion&arg5=$nmdp&arg6=$nphrase");
?>
