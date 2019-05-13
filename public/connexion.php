<?php include_once("navbar.phtml"); ?>

<!DOCTYPE html>
<html>
<head>
    <title> S'inscrire </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/res/css/login.css" />
</head>

<body>
    <div class="login">
        <h1>Connexion</h1>
        <form action="connexion.php" method = "POST">
            <p> Email </p>
            <input type="text" name="email">
            <p> Mot de passe </p>
            <input type="password" name="mdp">
            <p><input type="submit"></p>
        </form>
    </div>
</body>