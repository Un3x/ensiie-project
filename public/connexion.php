<!DOCTYPE html>
<html>
<head>
    <title> S'inscrire </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../public/res/css/main.css" />
</head>
<?php include_once("navbar.phtml"); ?>
<body>
    <form action="connexion.php" method = "POST">
        <p> Email </p>
        <input type="text" name="email">
        <p> Mot de passe </p>
        <input type="text" name="mdp">
        </form>
</body>