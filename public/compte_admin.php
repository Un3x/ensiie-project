<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" style="height:100%; width:100%">
<head>
    <meta charset="UTF-8">
    <title>Administrateur</title>
    <link rel="stylesheet" href="prrr.css">
</head>



<body style="height:100%; width:100%">

<header>
    ManAdvisor
</header>
<nav>
    | <a href="deconnexion_admin.php" class='nv'>Deconnexion</a> |
</nav>
<h1 style="color: red; text-align: center">Bonjour cher Administrateur!</h1>
<form action="admin1.php">
    <input   type="submit" value="Analyser les signalements">
</form>
<br \>
<form action="admin2.php">
    <input  type="submit" value="Entrer dans des profils">
</form>

