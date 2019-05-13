<!DOCTYPE html>
<?php include_once("navbar.phtml"); ?>

<html>
<head>
    <title> S'inscrire </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="res/css/inscription.css" />
</head>
<body>
    <div class="inscrip" >
        <h1>Inscription</h1>
        <form action="inscription.php" method = "POST">
            <p> Pseudo </p>
            <input type="text" name="pseudo">
            <p> Email </p>
            <input type="text" name="email">
            <p> Nom </p>
            <input type="text" name="nom">
            <p> Prénom </p>
            <input type="text" name="prenom">
            <p> Date de naissance </p>
            <input type="date" name="date">
            <p> Mot de passe </p>
            <input type="password" name="mdp">
            <p><input type="submit"></p>
        </form>
    </div>
</body>
</html>
