<?php

require_once('../src/model/User/ClientManager.class.php');


function initChampsPost()
{
    $valeurDefaut['prenom'] = $_POST['prenom'];
    $valeurDefaut['nom'] = $_POST['nom'];
    $valeurDefaut['mail'] = $_POST['mail'];
    $valeurDefaut['password'] = $_POST['password'];
    $valeurDefaut['password2'] = $_POST['password2'];
    $valeurDefaut['description'] = $_POST['description'];
    $valeurDefaut['birthDate'] = $_POST['birthDate'];
    return $valeurDefaut;
}

function initChamps()
{
    $valeurDefaut['prenom'] = "";
    $valeurDefaut['nom'] = "";
    $valeurDefaut['password'] = "";
    $valeurDefaut['password2'] = "";
    $valeurDefaut['mail'] ="";
    $valeurDefaut['description'] ="";
    $valeurDefaut['birthDate'] = "";
    return $valeurDefaut;
}


function inscriptionClientDebut()
{
    $messageErreur= "";
    $valeurDefaut=initChamps();

    require('../src/View/User/Link/inscriptionClientView.php');
}

function inscriptionClient()
{

    $messageErreur =  '<span class="warning">';
    $valeurDefaut=initChampsPost();


    if(empty($_POST["mail"]) || empty($_POST["password"]) || empty($_POST["password2"])
        || empty($_POST["prenom"]) || empty($_POST["nom"]) || empty($_POST["phoneNumber"]) || empty($_POST["birthDate"])
        || empty($_POST["genre"]))
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
            if(!preg_match("#^(\d){10}$#", $_POST["phoneNumber"]))
            {
                $messageErreur = $messageErreur . " Le numéro de téléphone n'est pas au bon format. <br/>";

            }
            if(!preg_match("#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#", $_POST["birthDate"]))
            {
                $messageErreur = $messageErreur . " La date de naissance n'est pas au bon format ( AAAA-MM-JJ). <br/>";
            }

            // vérifier que le pseudo n'est pas déja dans la base
            $bdd = bdd();
            $userManager = new ClientManager($bdd);
            if ($userManager->isUsed($_POST['mail']))
            {
                $messageErreur = $messageErreur . "Cet adresse mail est déjà utilisé pour un compte.<br/>
                L'usage de compte multiple est interdit. <br/>";
            }

            /*
            if($_POST['age'] < 0)
            {
                $messageErreur = $messageErreur . " Vous n'êtes pas encore née. Vous n'avez donc pas l'age requis <br/>";
            }
            */

            if ($messageErreur == '<span class="warning">')
            {
                $user = new Client;
                $a = 'Client';
                if($user instanceof $a)
                {
                    echo "BBB";
                }
                $raceManager = new RaceManager($bdd);
                $user->hydrate($_POST['nom'],$_POST["prenom"],($raceManager->getList())[0],$_POST['mail'],$_POST['password'],0,$_POST['phoneNumber'],new DateTime($_POST['birthDate']),-1,$_POST['description'],$_POST["genre"],0);
                if($userManager->add($user) != false) {
                    require('../src/View/User/Link/inscriptionValideView.php');
                }
                else
                {
                    $messageErreur = $messageErreur." Problème rencontré lors de l'inscription. <br/> Veuillez ressayer ultérieurement. <br/> </span> ";
                    require("../src/View/User/Link/inscriptionClientView.php");
                }
                return;
            }
        }
    $messageErreur=$messageErreur." <br/> <br/> </span>";

    require('../src/View/User/Link/inscriptionClientView.php');

}