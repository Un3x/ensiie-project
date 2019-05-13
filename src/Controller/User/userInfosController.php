<?php

require_once("../src/Model/User/ClientManager.class.php");
require_once("../src/Model/User/User.class.php");

if (isset($_GET['userId']) && isset($_GET['userType'])){

    require_once("../src/Model/User/ClientManager.class.php");
    require_once("../src/Model/User/AdminManager.class.php");
    require_once("../src/Model/User/VendorManager.class.php");
    
    switch($_GET['userType']){
        case 'Client':
            $ClientManager = new ClientManager(bdd());
            $userData = $ClientManager->get($_GET['userId']);
            break;

        case 'Vendor':
            $VendorManager = new VendorManager(bdd());
            $userData = $VendorManager->get($_GET['userId']);
            break;

        case 'Admin':
            $AdminManager = new AdminManager(bdd());
            $userData = $AdminManager->get($_GET['userId']);
            break;
        
        default:
            $title="utilisateur non trouvé";
            $content = "Cet utilisateur n'existe pas";
            require('../src/View/template.php');
    }


    $name = $userData->getFirstname().' '.$userData->getSurname();
    $reputation = $userData->getReputation();
    $age = date_diff($userData->getBirthDate(), date_create())->y;
    $description = $userData->getDescription();
    $gender= $userData->getGender();
    $creationDate = $userData->getCreationDate()->format('d/M/Y');

    if($_GET['userType']=='Client') $nbCourses = $userData->getNbClientCourses();

    if($_GET['userType']=='Vendor'){
        $nbCourses = $userData->getNbVendorCourses();
        $race = $userData->getRace()->getName();
        $price = $userData->getPrice();
    }

    require("../src/View/User/userInfosView.php");
    

}
else{
    $title="utilisateur non trouvé";
    $content = "Cet utilisateur n'existe pas";
    require('../src/View/template.php');
}