<?php
require_once('test.php');

function connexionDebut()
{
    $messageErreur = " ";
    require('../src/View/User/Link/connexionView.php');
}

function tentativeConnexion()
{

    $bdd = 0;
    $userManager = new UserManager($bdd);
    if(filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
    {
        $id = $userManager->tryConnect($_POST['login'], $_POST['password']);
        if($id != 0)
        {
            $_SESSION['id_utilisateur'] = $id;
            //appeler plutôt le contrôleur correspondant ou header en repassant par index.php
            $connecte=true;
            //conexion/
            require("../src/Controller/User/Profil/profilController.php");
            profilDebut();
        }
        else
        {
            $messageErreur =  "<div class='warning'>
            Erreur de connexion. <br/>
            Le login ou le mot de passe est incorrecte </div>";
            require("../src/View/User/Profil/profilView.php");
        }
    }
    else
    {
        $messageErreur =  "<div class='warning'>
            Il ne s'agit pas d'une adresse mail  <br/>
             </div>";

        require("../src/View/User/Link/connexionView.php");
    }
}