<?php
require_once('../src/Model/User/ClientManager.class.php');
require_once('../src/Model/User/VendorManager.class.php');
require_once('../src/Model/User/AdminManager.class.php');


function connexionDebut()
{
    $messageErreur = " ";
    require('../src/View/User/Link/connexionView.php');
}

function tentativeConnexion()
{
    $ClientManager = new ClientManager(bdd());
    $AdminManager = new AdminManager(bdd());
    $VendorManager = new VendorManager(bdd());
    if(filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
    {
        if(!$user = $ClientManager->get2($_POST['login'],$_POST['password']))
        if(!$user = $AdminManager->get2($_POST['login'],$_POST['password']))
        $user = $VendorManager->get2($_POST['login'],$_POST['password']);

        if($user != false)
        {
            $_SESSION['userId'] =  $user->getId();
            $_SESSION['userType'] = get_class($user);
            $GLOBALS['user']=$user;
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