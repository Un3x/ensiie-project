<?php
require '../vendor/autoload.php';
include 'Vue.php';
include("Modele.php");

//verif_authent();
enTete2("Selectionnez votre lieu.");
vue_lieu();
retour_menu();
echo '<p></p>';
connexion_link();
echo '<p></p>';
create_account_link();

pied();
?>
