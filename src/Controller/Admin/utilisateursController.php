<?php

require_once ('../src/Model/User/ClientManager.class.php');
require_once('../src/Model/User/VendorManager.class.php');
require_once('../src/Model/City/CityManager.class.php');
require_once('../src/Model/Race/RaceManager.class.php');
require('../src/Controller/verif.php');

function allClients()
{
    $bdd = bdd();
    $clientManager = new ClientManager($bdd);
    $mesUsers = $clientManager->getList();
    require('../src/View/Admin/utilisateursView.php');
}


function allVendor()
{
    $bdd = bdd();
    $vendorManager = new VendorManager($bdd);
    $mesUsers = $vendorManager->getList();
    $raceManager = new RaceManager($bdd);
    $cityManager = new CityManager($bdd);
    require('../src/View/Admin/vendeursView.php');
}


function initChampsAdmin($user, $userType)
{

    $valeurDefaut['prenom'] = $user->getFirstName();
    $valeurDefaut['mail'] = $user->getMailAddress();
    $valeurDefaut['nom'] = $user->getSurname();
    $valeurDefaut['description'] = $user->getDescription();
    $valeurDefaut['note'] = $user->getReputation();
    $valeurDefaut['phoneNumber'] = $user->getPhoneNumber();
    $valeurDefaut['birthDate'] = $user->getBirthDate();

    if($userType == "Vendor")
    {
        $raceManager = new RaceManager(bdd());
        $valeurDefaut['price'] = $user->getPrice();
        $valeurDefaut['race'] = $raceManager->get($user->getRace()->getId())->getName();
        $valeurDefaut['position'] = $user->getPosition();
        $valeurDefaut['occupied'] = $user->getOccupied();

    }
    return $valeurDefaut;
}

function destruction($id,$type)
{
    $bdd = bdd();

    if($type == "Vendor")
    {
        $userManager = new VendorManager($bdd);
        $user = $userManager->get($id);
    }
    if($type == "Client")
    {
        $userManager = new ClientManager($bdd);
        $user = $userManager->get($id);
    }
    else
    {
        return;
    }
    $userManager->delete($user);
    require('../src/View/Admin/destructionView.php');

}
function oneUser($id, $type)
{
    $bdd = bdd();
    $message = "";
    // récuperer l'user correspondant :
    if($type == "Vendor")
    {
        $userManager = new VendorManager($bdd);
        $user = $userManager->get($id);
        $vendeur = true;
    }
    elseif($type == "Client")
    {
        $userManager = new ClientManager($bdd);
        $user = $userManager->get($id);
        $vendeur=false;
    }
    else
    {
        require('../src/View/Admin/utilisateurInconnuView.php');
        return;
    }

    if($user==false)
    {
        require('../src/View/Admin/utilisateurInconnuView.php');
        return;
    }


    if(isset($_POST['mail']) && isset($_POST['prenom'])
        && isset($_POST['nom']) && isset($_POST["phoneNumber"]) && isset($_POST["birthDate"])
        && isset($_POST['description']) )
    {
        if(verifMail($_POST["mail"]) && verifBirthDate($_POST["birthDate"]) && verifNom($_POST["nom"])
            && verifNom($_POST["prenom"]) )
        {

            $user->setBirthDate(new DateTime($_POST['birthDate']));
            $user->setMailAddress($_POST['mail']);
            $user->setDescription($_POST['description']);
            $user->setFirstname($_POST['prenom']);
            $user->setSurname($_POST['nom']);
            $user->setPhoneNumber($_POST['phoneNumber']);
            //$user->setGender($_POST['gender']);
            if($type == "Vendor")
            {
                /*
                 $raceManager = new RaceManager($bdd);
                $user->setOccupied(isset($_POST["occupied"]));
                $user->setPrice($_POST['price']);
                $user->setPosition($_POST['position']);
                $user->setRace($_POST['race']);
                */
            }
            if($userManager->update($user) != false)
            {
                $message = "<span class='info'> Les données ont bien été mis à jour. </span>";
                $valeurDefaut = initChampsAdmin($user, $type);
                require("../src/View/Admin/utilisateur1View.php");
                return;
            }
            else
            {
                $message = "<span class='info'> Erreur lors de l'actualisation de la Base de Donnée. </span>";
                $valeurDefaut = initChampsAdmin($user, $type);
                require("../src/View/Admin/utilisateur1View.php");
                return;

            }
        }
        else
        {
            $message = "<span class='info'> Erreur au niveau du format de ses données. </span>";
            $valeurDefaut = initChampsAdmin($user, $type);
            require("../src/View/Admin/utilisateur1View.php");
            return;
        }

    }


    $valeurDefaut = initChampsAdmin($user, $type);
    require("../src/View/Admin/utilisateur1View.php");
    return;

}