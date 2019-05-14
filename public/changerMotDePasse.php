<?php
session_start();
require '../vendor/autoload.php';

$dbName=getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

if(isset($_POST['bouton1'])) {
    $courriel = htmlspecialchars($_POST['courriel']);
   $acode = hash('sha256',$_POST['acode']);
   $code1 = hash('sha256',$_POST['code1']);
   $code2 = hash('sha256',$_POST['code2']);
   if (!empty($_POST['courriel']) AND !empty($_POST['acode']) AND !empty($_POST['code1']) AND !empty($_POST['code2'])) {
        $ureq = $bdd->prepare("SELECT * FROM membres WHERE courriel = ? AND motdepasse = ?");
        $ureq->execute(array($courriel, $acode));
        $uexist = $ureq->rowCount();
        if($uexist == 1) {
            $uinfo = $ureq->fetch();
            if($code1 == $code2) {
                $tablembr = $bdd->prepare("UPDATE membres SET motdepasse=? WHERE courriel=?");
                $tablembr->execute(array($code1, $courriel));
                $erreur = "Votre compte a bien été mis à jour !";
            } 
			else {
                $erreur = "Vos mots de passe ne correspondent pas !";
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

require "changerMotDePasse.html";