<?php

require("../src/Model/User/ClientManager.class.php");
require("../src/Model/User/AdminManager.class.php");
require("../src/Model/User/VendorManager.class.php");

$modeDemo = true; //rajoute automatiquement des carriers quand on fait des recherches de trajets, évite de devoir remplir à la main la bdd de plein de carriers à des endroits différents

function bdd()
{
    try{
        //postgres
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        $a = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        return $a;
    }
    catch (PDOException $e) {
        
    }

    try {
        $a = new PDO('pgsql:host=localhost', "Lucas","");
        return $a;
    }
    catch (PDOException $e) {
        
    }
    return $a;
}



if(isset($_SESSION["userId"])&&isset($_SESSION["userType"]))
{
    $ClientManager = new ClientManager(bdd());
    $AdminManager = new AdminManager(bdd());
    $VendorManager = new VendorManager(bdd());

    if($_SESSION["userType"]=="Client") $user = $ClientManager->get($_SESSION["userId"]);
    if($_SESSION["userType"]=="Admin") $user = $AdminManager->get($_SESSION["userId"]);
    if($_SESSION["userType"]=="Vendor") $user = $VendorManager->get($_SESSION["userId"]);

    $GLOBALS['user'] = $user;
}
else{
    $GLOBALS['user'] = null;
}

