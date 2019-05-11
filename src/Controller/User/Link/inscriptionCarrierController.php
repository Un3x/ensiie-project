<?php

require_once('test.php');
require("inscriptionClientController.php");
function getListeRace()
{
    $bdd = 0;
    $raceManager = new RaceManager($bdd);
    return $raceManager->getRace();
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
        $bdd = 0;
        $userManager = new UserManager($bdd);
        if ($userManager->existe($_POST['mail']))
        {
            $messageErreur = $messageErreur . "Cet adresse mail est déjà utilisé. <br/> ";
        }
        if ($messageErreur == '<span class="warning">')
        {
            require('../src/View/User/Link/inscriptionValideView.php');
            return;
        }
    }
    $messageErreur=$messageErreur." </span>";

    // il faut re-generer la liste des races :

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