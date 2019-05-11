<?php

require_once('test.php');

function inscriptionClientDebut()
{
    $messageErreur= "";

    require('../src/View/User/Link/inscriptionClientView.php');
}

function inscriptionClient()
{
    $messageErreur =  '<span class="warning">';
    if(empty($_POST["mail"]) || empty($_POST["password"]) || empty($_POST["password2"])
        || empty($_POST["prenom"]) || empty($_POST["nom"]) || empty($_POST["age"]))
    {

        $messageErreur= $messageErreur."Certains champs indispensable sont vide  <br/>";
    }
    else
        {
            if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL))
            {
                $messageErreur = $messageErreur . 'L\'adresse mail n\'est pas valide <br/>';
            }
            if ($_POST['password'] != $_POST['password2'])
            {
                $messageErreur = $messageErreur . "Les deux mots de passe donnés ne correspondent 
            pas <br/>";
            }

            // vérifier que le pseudo n'est pas déja dans la base
            $bdd = 0;
            $userManager = new UserManager($bdd);
            if ($userManager->existe($_POST['mail']))
            {
                $messageErreur = $messageErreur . "Cet adresse mail est déjà utilisé pour un compte.<br/>
                L'usage de compte multiple est interdit.";
            }
            if($_POST['age'] < 0)
            {
                $messageErreur = $messageErreur . " Vous n'êtes pas encore née. Vous n'avez donc pas l'age requis <br/>";
            }

            if ($messageErreur == '<span class="warning">')
            {
                require('../src/View/User/Link/inscriptionValideView.php');
                return;
            }

        }
    $messageErreur=$messageErreur." </span>";

    require('../src/View/User/Link/inscriptionClientView.php');

}