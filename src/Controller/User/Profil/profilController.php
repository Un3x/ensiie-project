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
    $valeurDefaut['phoneNumber'] = $user->getPhoneNumber();

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
    $modif=false;
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
    if(!preg_match("#^(\d){10}$#", $_POST["phoneNumber"]))
    {
        $message = $message." Le numéro de téléphone n'est pas au bon format. <br/>";
        $erreur=true;
    }

    if($erreur)
    {
        $message = $message." </span>";
        require('../src/View/User/Profil/profilView.php');
        return;
    }

    // modification des données
    $bdd = bdd();

    $clientManager = new ClientManager($bdd);
    $user = $GLOBALS["user"];
    $user->setFirstname($_POST["prenom"]);
    $user->setSurname($_POST["nom"]);
    $user->setPhoneNumber($_POST['phoneNumber']);
    $user->setDescription($_POST['description']);
    // changer le reste

    if($clientManager->update($user) == false)
    {
        $message = $message." Erreur lors de la modification de la base de donnée. Veuillez ressayer ultérieurment. <br/> </span";
        require('../src/View/User/Profil/profilView.php');
        return;
    }


    $message = "<span class='information'> Les informations que vous avez saisi ont bien été validé";
    $valeurDefaut=initChamps();
    require('../src/View/User/Profil/profilView.php');
}