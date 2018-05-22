<?php
   $dbName = getenv('DB_NAME');
   $dbUser = getenv('DB_USER');
   $dbPassword = getenv('DB_PASSWORD');
   $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
   

   if(array_key_exists("nouvgroupe",$_POST) && $_POST['nouvgroupe']){
     $user = $_POST['user'];
     $requete = "SELECT MAX(id_grp) FROM groupe";
     $idgroupe = $connection->prepare($requete);
     $idgroupe->execute();
     $idgroups = $idgroupe->fetch();
     $idgroup = 1;
     if(!isset($idgroups['max'])){
       $idgroup = 1;
     }
     else{
       $idgroup = $idgroups['max'] + 1;
     }
     $groupeplayer="";
     for($j = 0; $j < 5; $j++){
       $joueur = "joueur" . $j;
       $groupeplayer = $_POST[$joueur];
       if(!empty($groupeplayer)){
         $rep = $connection->prepare("INSERT INTO groupe(id_grp,utilisateur_n,solde,balance) VALUES ('$idgroup', '$groupeplayer', '1000', '0');");
         $rep->execute();
       }
     }
     $rep = $connection->prepare("INSERT INTO groupe(id_grp,utilisateur_n,solde,balance) VALUES ('$idgroup', '$user', '1000', '0');");
     $rep->execute();
   }
   
   if(array_key_exists("parier",$_POST) && $_POST['parier']){
     $user = $_POST['user'];
     $grp = $_POST['group'];
     $match = $_POST['match'];
     $mise = 0;
     if(isset($_POST['mise'])){
       $mise = $_POST['mise'];
     }
     $prono = (string) $_POST['prono'];
     $balance = $_POST['balance'] - $mise;
     
     $requete = "SELECT id_grp,mise FROM pronostics WHERE id_grp = '$grp' AND utilisateur_n = '$user' AND match_n = '$match';";
     $rep = $connection->prepare($requete);
     $rep->execute();
     $repon = $rep->fetch();

     $requete = "INSERT INTO pronostics(utilisateur_n,id_grp,match_n,mise,pron) VALUES ('$user','$grp','$match', '$mise', '$prono');";
     if(isset($repon['id_grp'])){
       $requete = "UPDATE pronostics SET pron = '$prono', mise = '$mise' WHERE id_grp = '$grp' AND utilisateur_n = '$user' AND match_n = '$match';";
       $balance = $balance + $repon['mise'];
     }
     $rep = $connection->prepare($requete);
     $rep->execute();
     $requete = "UPDATE groupe SET solde = '$balance' WHERE id_grp = '$grp' AND utilisateur_n = '$user';";
     $rep = $connection->prepare($requete);
     $rep->execute();

   }

   header('Location: membre.php');
   ?>