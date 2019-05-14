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
     | <a href="index.php" class="nv">Accueil</a> |
</nav>

<?php

if($_SESSION['pseudo'] !== "") {
    $pseudo = $_SESSION['pseudo'];
    echo "<h1 style='text-align:center; color: darkcyan'>Au revoir $pseudo ! Merci d'avoir été menbre!</h1>". " <script src='animations.js'></script>";
    echo"<img id='img_aurevoir' src ='aurevoir.gif'\>";
}
$_SESSION = array(); //Ecrasement du tableau de session
session_unset();  //Destruction de toutes les variables de la session en cours
session_destroy();//Destruction de la session en cours
?>
