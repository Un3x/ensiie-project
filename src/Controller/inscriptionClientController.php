<?php

function inscriptionClientDebut()
{
    $messageErreur= "";
    require('../View/inscriptionClient.php');
}

function inscriptionClient()
{
    $message['mail'] = "";
    $messageErreur =  '< span class="warning">';

    if(empty($_GET["mail"]))
    {
        $messageErreur += 'L\'adresse mail est vide  <br/>';
    }
    else
    {
        require('../View/inscriptionValideView.php');
        return;
    }


    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $messageErreur += 'L\'adresse mail n\'est pas valide <br/>';
    }
    else
    {
        require('../View/inscriptionValideView.php');
        return;
    }

    if($_GET['password'] != $_GET['password2'])
    {
        $messageErreur += "Les deux mots de passe donnés ne correspondent 
        pas <br/>";
    }
    else
    {
        require('../View/inscriptionValideView.php');
        return;
    }

    // vérifier que le pseudo n'est pas déja dans la base
    $bdd = new PDO( null, null, null, null);
    $userManager = new UserManager($bdd);
    if($userManager->existe($_GET['pseudo']))
    {
        $messageErreur += "Un tel pseudo existe déjà. <br/> ";
    }
    else
    {
        require('../View/inscriptionValideView.php');
        return;
    }


    $messageErreur+= " </span>";

    require('../View/inscriptionClientView.php');
}