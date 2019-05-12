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
            $vendor->hydrate( $_POST["prenom"], $_POST["nom"], ($raceManager->get($_POST['race'])) , $_POST['mail'], $_POST['password'], 0, $_POST['phoneNumber'], new DateTime($_POST['birthDate']),0, $_POST['description'], $_POST['genre'], 0, 0, true, 0);
            //$_POST["password"],$_POST["mail"], $_POST[""], 0, $_POST["phoneNumber"], $_POST[""], )
            $vendorManager->add($vendor);
            require('../src/View/User/Link/inscriptionValideView.php');
            return;
        }
    }
    $messageErreur=$messageErreur." </span>";

    // il faut regenerer la liste des races :

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