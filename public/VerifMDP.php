<?php

include("Vue.php");
include("Modele.php");

$psd = $_POST['psd']; //pseudo 
$mdp = $_POST['mdp']; //mot de passe

if(getPassword($psd, $mdp)){
  $GLOBALS['AUTHENT'] = 1;
  header('Location: connect_index.php');
}
enTete('Vérification du mot de passe');

affiche_erreur("Le mot de passe entré est eronné.");
affiche_info('Veuillez-essayer de nouveau <a href="Connexion.php">ici</a>.');

pied();
?>