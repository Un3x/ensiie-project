<?php

require_once("../src/Model/User/ClientManager.class.php");
require_once("../src/Model/User/User.class.php");


function initChamps()
{
    //initialisation des champs avec la BDD
    $user = $GLOBALS['user'];
    $valeurDefaut['age'] = 0;
    $valeurDefaut['prenom'] = $user->getFirstName();
    $valeurDefaut['nom'] = $user->getSurname();
    $valeurDefaut['description'] = $user->getDescription();
    $valeurDefaut['note'] = $user->getReputation();

    return $valeurDefaut;
}

function profilDebut()
{
    $modif = false;
    $message = "";
    $valeurDefaut = initChamps();
    require("../src/View/User/Profil/profilView.php");
}

function profilModifEnCours()
{
    $modif = true;
    $message = "";
    $valeurDefaut = initChamps();
    require("../src/View/User/Profil/profilView.php");
}

function validationProfil()
{

    $valeurDefaut=initChamps();
    $message = "<span class='warning' >";
    $erreur = false;
    if(!preg_match("#^\w{1,15}$#"   ,$_POST['prenom']))
    {
        $message = $message."Le prenom doit être composé de caractère standard. <br/> ";
        $erreur = true;
    }
    if(!preg_match("#^\w{1,15}$#"   ,$_POST['nom']))
    {
        $message = $message."Le nom doit être composé de caractère standard.<br/>";
        $erreur=true;
    }
    /*
    if($_POST['age'] >= 0)
    {
        $message = $message."L'age doit être positif.<br/>";
        $erreur=true;
    }
    */

    // modification des données
    $bdd = bdd();

    $clientManager = new ClientManager();
    $user = $_SESSION["user"];
    $user->setFirstname($_POST["prenom"]);
    $clientManager->update($user);

    $message = $message." </span>";


    //$message = "<span class='information'> Les informations que vous avez saisi ont bien été validé";
    $modif=false;

    require('../src/View/User/Profil/profilView.php');
}