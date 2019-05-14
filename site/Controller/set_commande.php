<?php
require_once("../Model/db_data.php");
require_once("../Classes/Utilisateur.php");
session_start();
$commande = new Commande(NULL, $_SESSION['Utilisateur']->getAriseID(), date("Y-m-d H:i:s"), 0, array());
while($element = current($_POST)){
	$cle = key($_POST);
	$typeFoodID = NULL;
	$foodID = NULL;
	$typeSpecialID = NULL;
	$specialItemID = NULL;
	if(sscanf($cle, "%i-%i-%i-%i", $typeFoodID, $foodID, $typeSpecialID, $specialItemID) == 1){
		$idFood = $element;
		if($idFood > 0){
		$commande->addMenus(new Menu(NULL,
									new Nourriture($idFood, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
									array())
							);
		}
	}else{
		$tmp = $commande->getMenus();
		$lastMenu = end($tmp);
		$lastMenu->addSpecial(new Special($specialItemID, $typeSpecialID, NULL, NULL));
		$commande->updateLastMenu($lastMenu);
	}
	next($_POST);
}
if(!empty($commande->getMenus()))
	addCommande($_SESSION['Utilisateur'], $_SESSION['currentEvenement'], $commande);

header ('location: ../index.php');
?>