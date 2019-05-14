<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" style="height:100%; width:100%">
<head>
    <meta charset="UTF-8">
    <title>ManAdvisor</title>
    <link rel="stylesheet" href="prrr.css">
</head>



<body style="height:100%; width:100%">

<header>
    ManAdvisor
</header>

<nav>
    | <a href="connexion.php" class='nv'>Authentification</a> | <a href="index.php" class="nv">Accueil</a> |
</nav>

<?php

if($_SESSION['pseudo'] !== "") {
    $pseudo = $_SESSION['pseudo'];
    echo "<h1 style='text-align:center; color: darkcyan'>Bravo $pseudo !</h1>". " <script src='animations.js'></script>";
    echo"<img id='img_bienvenue' src ='welcome2.webp'\>";
}
$_SESSION = array(); //Ecrasement du tableau de session
session_unset();  //Destruction de toutes les variables de la session en cours
session_destroy();//Destruction de la session en cours
?>
