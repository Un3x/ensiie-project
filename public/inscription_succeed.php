<?php
session_start();
$_SESSION['adresse'] = "inscription_succeed.php";
?>

<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Firewolf</title>
<link rel="icon" type="image/png" href="logo.png" id="im" />
<link rel="stylesheet" href="style.css"/>
</head>

<nav>
<ul class="topnav">
<li><a href="accueil.php">Home</a></li>
<li><a href="profil.php">Profil</a></li>
<li><a href="pageMembre.php">Membres</a></li>
<li><a href="rejoins_nous.php">Rejoins-nous</a></li>
<li class="right"><a href="deconnexion.php">Déconnexion</a></li>
</ul>
</nav>

<body>
<h1>Inscription réussie, vous êtes maintenant officiellement candidat pour rejoindre la meute !</h1>