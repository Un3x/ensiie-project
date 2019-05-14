<?php
include("Modele.php");
include 'vue.php';

$psd = $_POST['psd']; //pseudo 
$mdp = $_POST['mdp']; //mot de passe
$city_id = $_POST['city_id']; //pseudo 

if(account_creation($psd, $mdp, $city_id)){
	affiche_info('Reussi.');
	affiche_info('Veuillez-essayer de connecxion <a href="Connexion.php">ici</a>.');
}
else{
	enTete('Account Creation');

	affiche_erreur("Le city_id doit être numeric.");
	affiche_info('Veuillez-essayer de nouveau <a href="Creation.php">ici</a>.');
}
//pied();
?>