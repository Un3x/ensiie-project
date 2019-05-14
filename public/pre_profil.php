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
    | <a href="index.php" class='nv'>Deconnexion</a> | <a href="profil.php" class="nv">Mon Profil</a> | <a href="modification.php" class="nv">Modifier mon Profil</a> | <a href="recherche.php" class="nv">Rechercher</a> |
</nav>

<?php

    if($_SESSION['pseudo'] !== "") {
        $user = $_SESSION['pseudo'];
        echo "<p class='anim'>Salut $user! Vous êtes connectés!</p>";
        echo "<h1 class='ml16'>Man Advisor</h1>". "<h1 class='ml17'>MARK WITH LOVE</h1>". "<h1 class='ml18'>ONE CLIC, ONE MARK</h1>". " <script src='animations.js'></script>";
    }
        ?>
