<?php

require_once("../src/Model/User/VendorManager.class.php");
require_once("inscriptionClientController.php");

function getListeRace()
{
    $raceManager = new RaceManager( bdd());
    return $raceManager->getList();
}
function inscriptionCarrierDebut()
{

    $messageErreur = "";
    $valeurDefaut = initChamps();
    $valeurDefaut['price'] = "";

    //creer la liste déroulante :

    $tabRace = getListeRace();
    $optionRace = "";
    for ($i = 0; $i < count($tabRace); $i++) {
        $optionRace = $optionRace . " <option value='". $tabRace[$i]->getId()."'> " . $tabRace[$i]->getName() . "  </option>";
    }

    $caracRace = "<p> ";
    for ($i = 0; $i < count($tabRace); $i++) {
        $caracRace = $caracRace . '<span class="info" id='.$i.'> Vitesse : ' . $tabRace[$i]->getSpeed() . '<br\> Nombre maximum : ' . $tabRace[$i]->getCapacity() . "</span>";
        $caracRace = $caracRace . "</p>";
    }

    require('../src/View/User/Link/inscriptionCarrierView.php');
}




function inscriptionCarrier()
{

    $messageErreur='<span class="warning">';


    $valeurDefaut = initChampsPost();
    $valeurDefaut['price'] = $_POST['price'];
    // il faut regenerer la liste des races :

    $tabRace = getListeRace();
    $optionRace = "";
    for ($i = 0; $i < count($tabRace); $i++) {
        $optionRace = $optionRace . " <option value='". $tabRace[$i]->getId()."' > " . $tabRace[$i]->getName() . "  </option>";
    }

    $caracRace = "<p> ";
    for ($i = 0; $i < count($tabRace); $i++) {
        $caracRace = $caracRace . '<span class="info" id='.$i.'> Vitesse : ' . $tabRace[$i]->getSpeed() . '<br\> Nombre maximum : ' . $tabRace[$i]->getCapacity() . "</span>";
        $caracRace = $caracRace . "</p>";
    }


    if(empty($_POST["mail"]) || empty($_POST["password"]) || empty($_POST["password2"])
        || empty($_POST["prenom"]) || empty($_POST["nom"]) || empty($_POST["genre"]) || empty($_POST["phoneNumber"]) || empty($_POST["birthDate"]))
    {

        $messageErreur= $messageErreur."Certains champs necessaires sont vide  <br/>";
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
        $vendorManager = new VendorManager($bdd);
        if ($vendorManager->isUsed($_POST['mail']))
        {
            $messageErreur = $messageErreur . "Cet adresse mail est déjà utilisé. <br/> ";
        }
        if ($messageErreur == '<span class="warning">')
        {
            $vendor = new Vendor();
            $raceManager = new RaceManager($bdd);
            $vendor->hydrate( htmlspecialchars($_POST["prenom"]), htmlspecialchars($_POST["nom"]), ($raceManager->get($_POST['race'])) , htmlspecialchars($_POST['mail']), $_POST['password'], 0, $_POST['phoneNumber'], new DateTime($_POST['birthDate']),0, htmlspecialchars($_POST['description']), $_POST['genre'], 0, 0, true, 0, 5);
            if($vendorManager->add($vendor) != false) {
                require('../src/View/User/Link/inscriptionValideView.php');
            }
            else
            {
                $messageErreur = $messageErreur." Problème rencontré lors de l'inscription. <br/> Veuillez ressayer ultérieurement. <br/> </span> ";
                require("../src/View/User/Link/inscriptionCarrierView.php");
            }
            return;
        }
    }
    $messageErreur=$messageErreur." </span>";




    require('../src/View/User/Link/inscriptionCarrierView.php');
}