<?php

require_once ('../src/Model/Race/RaceManager.class.php');

function allRaces()
{
    $bdd = bdd();
    $raceManager = new RaceManager($bdd);
    $mesRaces = $raceManager->getList();
    require('../src/View/Admin/listeRaceView.php');
}


function ajoutRaceDebut()
{
    require('../src/View/Admin/ajoutRaceView.php');

}

function ajoutRace()
{
    if( !empty($_POST['vitesse']) &&!empty($_POST['nom']) && !empty($_POST['capacite']) && $_POST['vitesse'] > 0 && $_POST['capacite'] > 0)
    {
        $bdd= bdd();
        $raceManager = new RaceManager($bdd);
        $race = new Race();
        $race->hydrate(htmlspecialchars($_POST['nom']),$_POST['vitesse'], $_POST['capacite']);
        if($raceManager->add($race) != false)
        {
            $title = "Accès Admin !";
            $content = " <p> La race a bien été ajouté ! </p>";
            require("../src/View/template.php");
        }
        else
        {
            $title = "Accès Admin !";
            $content = " <p> Erreur lors de l'ajout de la race ! </p>";
            require("../src/View/template.php");
        }
        return;
    }
    else
    {
        $title = "Accès Admin !";
        $content = " <p> Les données ne sont pas dans un format valide. </p>";
        require("../src/View/template.php");
        return;
    }

}