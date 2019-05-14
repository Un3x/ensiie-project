<?php
session_start();
require '../vendor/autoload.php';

$dbName=getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

if(isset($_POST['bouton1'])) {
   $acourriel = htmlspecialchars($_POST['acourriel']);
   $code = hash('sha256',$_POST['code']);
   $courriel1 = htmlspecialchars($_POST['courriel1']);
   $courriel2 = htmlspecialchars($_POST['courriel2']);
   if (!empty($_POST['acourriel']) AND !empty($_POST['code']) AND !empty($_POST['courriel1']) AND !empty($_POST['courriel2'])) {
        $ureq = $bdd->prepare("SELECT * FROM membres WHERE courriel = ? AND motdepasse = ?");
        $ureq->execute(array($acourriel, $code));
        $uexist = $ureq->rowCount();
        if($uexist == 1) {
            $uinfo = $ureq->fetch();
            $rcourriel = $bdd->prepare("SELECT * FROM membres WHERE courriel = ?");
            $rcourriel->execute(array($courriel1));
            $courrielexist = $rcourriel->rowCount();
            if($courrielexist == 0) {
                if($courriel1 == $courriel2) {
                    $tablembr = $bdd->prepare("UPDATE membres SET courriel=? WHERE ID=?");
                    $tablembr->execute(array($courriel1, $uinfo['ID']));
                    $erreur = "Votre compte a bien été mis à jour !";
                } 
			    else {
                    $erreur = "Vos courriels ne correspondent pas !";
                }
            }
            else {
                $erreur = "Adresse courriel déjà utilisée !";
            }
        } 
        else {
             $erreur = "Courriel ou mot de passe incorrect !";
        }
   } 
   else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}

require "changerCourriel.html";