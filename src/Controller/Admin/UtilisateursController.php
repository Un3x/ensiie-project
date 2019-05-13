<?php

require_once ('../src/Model/User/ClientManager.class.php');
require('../src/Controller/verif.php');
function allClients()
{
    $bdd = bdd();
    $clientManager = new ClientManager($bdd);
    $mesUsers = $clientManager->getList();
    require('../src/View/Admin/utilisateursView.php');
}



function OneClient($id)
{
    $bdd = bdd();
    $clientManager = new ClientManager($bdd);
    if(verifMail($_SESSION["mail"]) && verifBirthDate($_SESSION["birthDate"]) && verifNom($_SESSION["nom"])
    && verifNom($_SESSION["prenom"]) )
    {
        require('../src/View/Admin/utilisateursView.php');
    }


}