<?php

require_once("../src/Model/User/ClientManager.class.php");

require_once("../src/Model/City/CityManager.class.php");

require_once("../src/Model/User/User.class.php");


function initChamps()
{
    //initialisation des champs avec la BDD
    $user = $GLOBALS['user'];
    $valeurDefaut['prenom'] = $user->getFirstName();
    $valeurDefaut['nom'] = $user->getSurname();
    $valeurDefaut['description'] = $user->getDescription();
    $valeurDefaut['note'] = $user->getReputation();
    $valeurDefaut['phoneNumber'] = $user->getPhoneNumber();
    $valeurDefaut['position'] = "";
    if($_SESSION["userType"] == "Vendor")
    {
        $cityManager = new CityManager(bdd());
        $valeurDefaut['price'] = $user->getPrice();
        $a = $cityManager->get($user->getPosition());
        if($a == false) {
            $valeurDefaut['position'] = "Inconnu"; }
        else
        {
            $valeurDefaut['position'] = $a->getName();
        }

    }


    return $valeurDefaut;
}

function initRace($fixe)
{

    $raceManager = new RaceManager( bdd());
    $tabRace = $raceManager->getList();
    if($raceManager == false || $tabRace == false)
    {
        return "<span class='warning'> Erreur de connexion <br/> </span> ";
    }

    $optionRace = "<select id='race' name='race'";
    if($fixe)
        $optionRace = $optionRace." readonly";
    $optionRace = $optionRace.">";

    if($fixe) {
        $race = $GLOBALS["user"]->getRace();
        $optionRace = $optionRace."  <option> ".$race->getName()." </option>";
        $optionRace = $optionRace." <select>";
        $caracRace = " <span class='info'> Vitesse ".$race->getSpeed()." <br/> Capacité : ".$race->getCapacity()." </span>";
        return $optionRace.$caracRace;
    }
    else {

        for ($i = 0; $i < count($tabRace); $i++) {
            $optionRace = $optionRace . " <option  value='" . $tabRace[$i]->getId() . "'> " . $tabRace[$i]->getName() . "  </option>";
        }
        $optionRace = $optionRace . " <select>";

        $caracRace = "<p> ";
        for ($i = 0; $i < count($tabRace); $i++) {
            $caracRace = $caracRace . '<span class="info" id= '.$i.' > Vitesse : ' . $tabRace[$i]->getSpeed() . '<br\> Nombre maximum : ' . $tabRace[$i]->getCapacity() . "</span>";
            $caracRace = $caracRace . "</p>";
        }

        return $optionRace . $caracRace;
    }
}


function profilDebut()
{
    $modif = false;
    $message = "";
    $valeurDefaut = initChamps();
    if($_SESSION["userType"] == "Vendor")
    {
        $race = initRace(true);
    }
    else
    {
        $race = "";
    }

    require("../src/View/User/Profil/profilView.php");
}

function profilModifEnCours()
{
    $modif = true;
    $message = "";
    $valeurDefaut = initChamps();
    if($_SESSION["userType"] == "Vendor")
    {
        $race = initRace(false);
    }
    else
    {
        $race = "";
    }
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

    $cityManager = new CityManager(bdd());
    if( $_POST["position"] == "Inconnu"  ||  $cityManager->get2($_POST["position"]) == false )
    {
        $message = $message." La position entrée ne correspond à aucune ville connue de nos base de données. <br/>";
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
    $user = $GLOBALS["user"];
    if( $_SESSION['userType'] == "Vendor")
    {
        $userManager = new VendorManager($bdd);
        $user->setPrice($_POST['price']);
        $raceManager = new RaceManager($bdd);
        $user->setRace($raceManager->get($_POST['race']));
    }
    if( $_SESSION['userType'] == "Admin")
        $userManager = new AdminManager($bdd);
    if( $_SESSION['userType'] == "Client")
        $userManager = new ClientManager($bdd);


    $user->setFirstname($_POST["prenom"]);
    $user->setSurname($_POST["nom"]);
    $user->setPhoneNumber($_POST['phoneNumber']);
    $user->setDescription($_POST['description']);
    // changer le reste
    if($userManager->update($user) == false)
    {
        $message = $message." Erreur lors de la modification de la base de donnée. Veuillez ressayer ultérieurment. <br/> </span";

        $valeurDefaut=initChamps();
        if($_SESSION["userType"] == "Vendor")
        {
            $race = initRace(true);
        }
        else
        {
            $race = "";
        }
        require('../src/View/User/Profil/profilView.php');
        return;
    }


    $message = "<span class='information'> Les informations que vous avez saisi ont bien été validé";

    $valeurDefaut=initChamps();
    if($_SESSION["userType"] == "Vendor")
    {
        $race = initRace(true);
    }
    else
    {
        $race = "";
    }
    require('../src/View/User/Profil/profilView.php');
}