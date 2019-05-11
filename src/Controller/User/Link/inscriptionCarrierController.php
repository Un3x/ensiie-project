<?php

require("../src/model/User/VendorManager.class.php");
require("inscriptionClientController.php");

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
        $optionRace = $optionRace . " <option> " . $tabRace[$i]->getNom() . "  </option>";
    }

    $caracRace = "<p> ";
    for ($i = 0; $i < count($tabRace); $i++) {
        $caracRace = $caracRace . '<span class="info" id ='.$i.'> Vitesse : ' . $tabRace[$i]->getVitesse() . '<br\> Nombre maximum : ' . $tabRace[$i]->getnb() . "</span>";
        $caracRace = $caracRace . "</p>";
    }

    require('../src/View/User/Link/inscriptionCarrierView.php');
}




function inscriptionCarrier()
{

    $messageErreur='<span class="warning">';

    $valeurDefaut = initChampsPost();

    if(empty($_POST["mail"]) || empty($_POST["password"]) || empty($_POST["password2"])
        || empty($_POST["prenom"]) || empty($_POST["nom"]) || empty($_POST["age"]))
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
        $vendorManager = new VendorManager(bdd());
        if ($userManager->isUsed($_POST['mail']))
        {
            $messageErreur = $messageErreur . "Cet adresse mail est déjà utilisé. <br/> ";
        }
        if ($messageErreur == '<span class="warning">')
        {
            $vendor = new Vendor();
            $vendor->hydrate( $_POST["prenom"], $_POST["nom"], race, mail, passwod, money, phoneNumer, dateNaissance, 0, description, d, 0, 0, true, -1);
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
        $optionRace = $optionRace . " <option> " . $tabRace[$i]->getNom() . "  </option>";
    }

    $caracRace = "<p> ";
    for ($i = 0; $i < count($tabRace); $i++) {
        $caracRace = $caracRace . '<span class="info" id ='.$i.'> Vitesse : ' . $tabRace[$i]->getVitesse() . '<br\> Nombre maximum : ' . $tabRace[$i]->getnb() . "</span>";
        $caracRace = $caracRace . "</p>";
    }

    require('../src/View/User/Link/inscriptionCarrierView.php');
}