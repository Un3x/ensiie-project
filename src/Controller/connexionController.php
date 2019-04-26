<?php 

function connexionDebut()
{
    $messageErreur ="";
    require("connexionView.php");
}

function tentativeConnexion()
{
    $bdd = PDO(null, null, null, null);
    $userManager = new UserMangager($bdd);
    if(filter_var($_GET['login'], FILTER_VALIDATE_EMAIL))
    {
        $_SESSION['id_utilisateur'] = $userManager->tryConnect($_GET['login'], $_GET['password']);

        if($_SESSION['id_utilisateur'] != 0)
        {
            //appeler plutôt le contrôleur correspondant ou header en repassant par index.php
            require('profilView.php');

        }
        else
        {
            $messageErreur = "<div class='warning'> 
            Erreur de connexion. <br/>
            Le login ou le mot de passe est incorrecte </div>";
            require("connexionView.php");
        }
    }
}