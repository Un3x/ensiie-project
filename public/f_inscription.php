<!DOCTYPE php>	
<?php
require '../vendor/autoload.php';

$dbName=getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

if(isset($_POST['bouton1'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $courriel = htmlspecialchars($_POST['courriel']);
   $code1 = hash('sha256',$_POST['code1']);
   $code2 = hash('sha256',$_POST['code2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['courriel']) AND !empty($_POST['code1']) AND !empty($_POST['code2'])) {
      $lpseudo = strlen($pseudo);
      if($lpseudo <= 30) {
        if(filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
            $rcourriel = $bdd->prepare("SELECT * FROM membres WHERE courriel = ?");
            $rcourriel->execute(array($courriel));
            $courrielexist = $rcourriel->rowCount();
            if($courrielexist == 0) {
                if($code1 == $code2) {
                  $tablembr = $bdd->prepare("INSERT INTO membres(courriel, pseudo, motdepasse) VALUES(?, ?, ?)");
                  $tablembr->execute(array($courriel, $pseudo, $code1));
                  $erreur = "Votre compte a bien été créé !";
                } 
			    else {
                  $erreur = "Vos mots de passe ne correspondent pas !";
                }
            } 
			else {
              $erreur = "Adresse courriel déjà utilisée !";
            }
        } 
		else {
            $erreur = "Votre adresse courriel n'est pas valide !";
        }
      } 
	  else {
         $erreur = "Votre pseudo ne doit pas dépasser 30 caractères !";
      }
   } 
   else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}

require "f_inscription.html";
?>