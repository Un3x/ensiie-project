<?php
require_once("../Model/db_data.php");
require_once("../Classes/Utilisateur.php");
session_start();
$event = new Evenement(NULL, $_POST['selectType'],$_POST['numero'],$_POST['dateEnd']);

$resAjout = db_addEvenement($event, $_POST['dateStart']);

if($resAjout == TRUE){
	$_SESSION['resAdmin'] = "Evenement bien ajouté à la base de données !";
}else{
	$_SESSION['resAdmin'] = "Problème lors de l'ajout de l'évennement ! Faites attention aux dates qui doivent êtres supérieures au dernier évenement";
}

header ('location: ../admin.php');
?>