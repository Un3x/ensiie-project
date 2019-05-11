<?php
require('../src/model/User/UserManager.class.php');
require('../verif.php');

function connexionDebut()
{
    $messageErreur = " ";
    require('../src/View/User/Link/connexionView.php');
}

function tentativeConnexion()
{
    $userManager = new UserManager(bdd());
    if(filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
    {
        $user = $userManager->get2($_POST['login'], hasherPassword($_POST['password']));
        if($user != false)
        {
            $_SESSION['id_utilisateur'] = $id;
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
            Il ne s'agit pas d'une adresse mail  <br/>
             </div>";

        require("../src/View/User/Link/connexionView.php");
    }
}