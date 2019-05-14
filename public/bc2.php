<?php
   $dbName=getenv('DB_NAME');
   $dbUser = getenv('DB_USER');
   $dbPassword = getenv('DB_PASSWORD');

$bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
session_start();

if (isset($_POST['validc'])) {
   $courrielc = htmlspecialchars($_POST['courrielc']);
   $mdpc = hash('sha256',$_POST['mdpc']);
   if(!empty($courrielc) AND !empty($mdpc)) {
      $ureq = $bdd->prepare("SELECT * FROM membres LEFT OUTER JOIN admins ON membres.courriel=admins.courriel WHERE membres.courriel = ? AND motdepasse = ?");
      $ureq->execute(array($courrielc, $mdpc));
      $uexist = $ureq->rowCount();
      if($uexist == 1) {
         $uinfo = $ureq->fetch();
         $_SESSION['courriel'] = $uinfo['courriel'];
		   $_SESSION['pseudo'] = $uinfo['pseudo'];
         $_SESSION['admin'] = $uinfo['lvl'];
         header("Location: main.php");
      } else {
         $erreur = "Courriel ou mot de passe incorrect !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}

require "bc2.html";
?>