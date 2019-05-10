<?php

function initChamps()
{
    //initialisation des champs avec la BDD
    /*
    $valeurDefaut['age'] = $user->getAge();
    $valeurDefaut['prenom'] = $user->getPrenom();
    $valeurDefaut['nom'] = $user->getNom();
    $valeurDefaut['description'] = "ab";
    */
    $valeurDefaut['age'] = 20;
    $valeurDefaut['prenom'] = "Azathot";
    $valeurDefaut['nom'] = "Le néant";
    $valeurDefaut['description'] =  " ab ab";
    $valeurDefaut['note'] = 2.5;

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
    if(! preg_match("#^\w{1,15}$#"   ,$_POST['prenom']))
    {
        $message = $message."Le prenom doit être composé de caractère standard.";
    }
    if(! preg_match("#^\w{1,15}$#"   ,$_POST['enom']))
    {
        $message = $message."Le nom doit être composé de caractère standard.";
    }

    //verification des données

    // modification des données

    $message = $message." </span>";


    //$message = "<span class='information'> Les informations que vous avez saisi ont bien été validé";
    $modif=false;

    require('../src/View/User/Profil/profilView.php');
}