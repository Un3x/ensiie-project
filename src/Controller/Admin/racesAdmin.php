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
    require('../src/View/Admin/ajoutRaceView.php')

}

function ajoutRace()
{

}