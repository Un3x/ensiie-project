<?php

require_once ('../src/Model/User/ClientManager.class.php');

function allClients()
{
    $bdd = bdd();
    $clientManager = new ClientManager($bdd);
    $mesUsers = $clientManager->getList();

}