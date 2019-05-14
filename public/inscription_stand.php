<?php
session_start();
$dbName=getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

if(isset($_POST['bouton1'])) {
    $r=$bdd->prepare("SELECT * FROM stands WHERE courriel=?");
    $r->execute(array($_SESSION['courriel']));
    $rexist=$r->rowCount();
    if($rexist==0){
		$stand = htmlspecialchars($_POST['stand']);
		$respo = htmlspecialchars($_POST['respo']);
		$officielc = htmlspecialchars($_POST['officielc']);
		$web = htmlspecialchars($_POST['web']);
		$tel = htmlspecialchars($_POST['tel']);
		$act = htmlspecialchars($_POST['act']);
		if(!empty($_POST['stand']) AND !empty($_POST['respo']) AND !empty($_POST['officielc']) AND !empty($_POST['tel']) AND !empty($_POST['act'])) {
			if(filter_var($officielc, FILTER_VALIDATE_EMAIL)) {
						$tablembr = $bdd->prepare("INSERT INTO stands(courriel, stand, respo, officielc, web, tel, act) VALUES(?, ?, ?, ?, ?, ?, ?)");
						$tablembr->execute(array($_SESSION['courriel'], $stand, $respo, $officielc, $web, $tel, $act));
						$erreur = "Votre demande a bien été prise en compte, vous recevrez un courriel !";
			} 
			else {
				$erreur = "Votre adresse courriel n'est pas valide !";
			}
		} 
		else {
			$erreur = "Tous les champs (sauf web) doivent être complétés !";
		}
   }
   else {
	   $erreur = "Votre demande est déjà en cours de traitement";
   }
}
require "inscription_stand.html";