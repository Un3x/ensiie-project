<?php
require_once('../src/model/User/ClientManager.class.php');


function connexionDebut()
{
    $messageErreur = " ";
    require('../src/View/User/Link/connexionView.php');
}

function tentativeConnexion()
{
    $userManager = new ClientManager(bdd());
    if(filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
    {
        $user = $userManager->get2($_POST['login'],$_POST['password']);
        if($user != false)
        {
            $_SESSION['user'] =  $user;
            //appeler plutôt le contrôleur correspondant ou header en repassant par index.php ?
            $GLOBALS['connecte']=true;
            require("../src/Controller/User/Profil/profilController.php");
            profilDebut();
        }
        else
        {
            $messageErreur =  "<div class='warning'>
            Erreur de connexion. <br/>
            Le login ou le mot de passe est incorrecte </div>";
            require("../src/View/User/Link/connexionView.php");
        }
    }
    else
    {
        $messageErreur =  "<div class='warning'>
            Il ne s'agit même pas d'une adresse mail ! <br/>
             </div>";

        require("../src/View/User/Link/connexionView.php");
    }
}