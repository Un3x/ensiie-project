<?php
session_start();
if (!isset($_SESSION['nom'])){
    header('Location: index.php');
    exit();
}
$nom = $_SESSION['nom'];
$user = $nom;
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$matchlist = $connection->prepare("SELECT nom_match,resultat FROM matchs;");
$matchlist->execute();
$matchlist = $matchlist->fetchAll();
$admini = $connection->prepare("SELECT administrateur FROM utilisateur WHERE nom = '$user';");
$admini->execute();
$admin = $admini->fetch();
$reqeq = "SELECT e_fav FROM utilisateur WHERE nom='$nom';";
$reqsc = "SELECT score FROM utilisateur WHERE nom='$nom';";
$reqdesc = "SELECT description FROM utilisateur WHERE nom='$nom';";
$repeq = $connection->prepare($reqeq);
$repsc = $connection->prepare($reqsc);
$repdesc = $connection->prepare($reqdesc);
$repeq->execute();
$repequ = $repeq->fetch();
$repequi = $repequ['e_fav'];
$reqeq2 = "SELECT lien_ecusson FROM equipe WHERE nom='$repequi';";
$repeq2 = $connection->prepare($reqeq2);
$repeq2->execute();
$repequ2 = $repeq2->fetch();
$repequ2 = $repequ2['lien_ecusson'];
$repsc->execute();
$repsco = $repsc->fetch();
$repdesc->execute();
$repdescr = $repdesc->fetch();
?>

<html>
<link rel="stylesheet" href="css.css" />
<head> 
  <title>Espace membre</title>
</head>

<body>

<p class="profil">
Bienvenue <?php echo $nom ?> !<br/>
Equipe favorite: <?php echo $repequ['e_fav'] ?>
<?php
echo "<img src='" . $repequ2 . "' style='width: 50px' alt='logo de mon équipe favorite' /> <br/>";
?>
Score actuel: <?php echo $repsco['score'] ?> <br/>
Description: <?php echo $repdescr['description'] ?> <br />
<a href = "modif.php">Modifier mes informations</a>
<a href = "deconnexion.php">Déconnexion</a>
</p>


<?php
	$requeteid = "SELECT id_grp FROM groupe WHERE utilisateur_n = '$user';";
	$idgrp = $connection->prepare($requeteid);
	$idgrp->execute();
	foreach($idgrp as $temp){
	   $tmp = $temp['id_grp'];
	   if(!empty($tmp)){
	     $requetebal = "SELECT solde FROM groupe WHERE utilisateur_n = '$user' AND id_grp = $tmp";
	     $bal = $connection->prepare($requetebal);
	     $bal->execute();
	     $balance = $bal->fetch();
	     $balance = $balance['solde'];
	     echo "<div class=prono>\n";
	     echo "Solde: " . $balance . "<br />";
	     foreach($matchlist as $match){
	       if(!isset($match['resultat'])){
	       $m = $match['nom_match'];
	       echo $m . " ";
	       $requeteprono = "SELECT mise,pron FROM pronostics WHERE utilisateur_n = '$user' AND id_grp = '$tmp' AND match_n = '$m';";
	       $prono = $connection->prepare($requeteprono);
	       $prono->execute();
	       foreach($prono as $p){
	         echo "pronostic: " . $p['pron'] . " mise: " . $p['mise'] . "\n";
	       }
	       echo "<form action=gestionGroupe.php method=post>\n";
	       echo "Parier:\n";
	       echo "<select name=prono>\n";
	       echo "<option value=1>1</option>\n";
	       echo "<option value=0>0</option>\n";
	       echo "<option value=2>2</option>\n";
	       echo "</select>\n";
	       echo "<input type=number name=mise min=0 max=$balance>\n";
	       echo "<input type=submit value=Parier name=parier >\n";
	       echo "<input type=hidden name=match value='" . $m ."' >\n";
	       echo "<input type=hidden name=group value=$tmp>\n";
	       echo "<input type=hidden name=balance value=$balance>\n";
	       echo "<input type=hidden name=user value='" . $user ."' >\n";
	       echo "</form>\n";
	       echo "<br />";
	     }
	     }
	     
	     $requeteuser = "SELECT utilisateur_n FROM groupe WHERE id_grp = $tmp;";
	     $usernames = $connection->prepare($requeteuser);
	     $usernames->execute();
	     echo "Membres du groupe:";
	     foreach ($usernames as $names){
	       echo $names['utilisateur_n'] . ", ";
	     }
	     echo "</div>";
	  }
	}
	?>
	<div class=addGroupe>
	<form action="gestionGroupe.php" method="post">
	  Creer un groupe:<br />Membres (5 max, vous exclu):<br />
	  <?php
	  for($j = 0;$j < 5;$j++){
	  $joueur = "joueur"  . $j;
	    echo "<input type=text size=20 maxlength=16 name=$joueur /><br />";
	  }
	  echo "<input type=hidden name=user value='" . $user . "' >";
	  ?>
	  <input type="submit" value="Creer" name="nouvgroupe">
	</form>
	</div>


        <?php
	if($admin['administrateur']){
	echo "<div class=admin>\n";
	echo "Gestion des matchs:";
        echo "<form action=gestionAdmin.php method=post>";
	echo "<select name=equipe1>";
	     $requete = "SELECT nom FROM equipe;";
	     $reponse = $connection->prepare($requete);
	     $reponse->execute();
	     foreach($reponse as $nomequipe){
	       $nomeq = $nomequipe['nom'];
	       echo "<option value='" . $nomeq . "'>$nomeq</option>";
	     }
	echo "</select>";
	echo "<select name=equipe2>";
	     $requete = "SELECT nom FROM equipe;";
	     $reponse = $connection->prepare($requete);
	     $reponse->execute();
	     foreach($reponse as $nomequipe){
	       $nomeq = $nomequipe['nom'];
	       echo "<option value='$nomeq'>$nomeq</option>";
	     }
	echo "</select>";
	echo "<input type=date name=matchdate>";
	echo "<input type=submit value=Ajouter name=ajouequip>";
      echo "</form>";
      echo "<form action=gestionAdmin.php method=post>";
	echo "<select name=equipe1>";
	     $requete = "SELECT nom FROM equipe;";
	     $reponse = $connection->prepare($requete);
	     $reponse->execute();
	     foreach($reponse as $nomequipe){
	       $nomeq = $nomequipe['nom'];
	       echo "<option value='$nomeq'>$nomeq</option>";
	     }
	echo "</select>";
	echo "<select name=equipe2>";
	     $requete = "SELECT nom FROM equipe;";
	     $reponse = $connection->prepare($requete);
	     $reponse->execute();
	     foreach($reponse as $nomequipe){
	       $nomeq = $nomequipe['nom'];
	       echo "<option value='$nomeq'>$nomeq</option>";
	     }
	echo "</select>";
	echo "<input type=submit value=Supprimer name=supprequip>";
      echo "</form>";
      echo "Ajouter un score:";
      echo "<form action=gestionAdmin.php method=post>";
        echo "<select name=match>";
	     $requete = "SELECT nom_match FROM matchs;";
	     $reponse = $connection->prepare($requete);
	     $reponse->execute();
	     foreach($reponse as $nommatch){
	       $nomat = $nommatch['nom_match'];
	       echo "<option value='" . $nomat . "'>'" . $nomat . "'</option>";
	     }
	 echo "</select>";
	 echo "<select name=res>";
	   echo "<option value=1>1</option>";
	   echo "<option value=0>0</option>";
	   echo "<option value=2>2</option>";
	 echo "</select>";
	 echo "\n<input type=number step=0.01 min=0 max=20 name=cote1 placeholder='cote_1'>";
	 echo "\n<input type=number step=0.01 min=0 max=20 name=coteN placeholder='cote_N'>";
	 echo "\n<input type=number step=0.01 min=0 max=20 name=cote2 placeholder='cote_2'>";
	 echo "<input type=submit name=score value=Valider>";
      echo "</form>";
      echo "Ban un joueur:";
      echo "<form action=gestionAdmin.php method=post>";
	echo "<input type=text size=20 maxlength=16 name=user />";
	echo "<input type=submit value=Supprimer name=banuser>";
      echo "</form>";
      $requete = "SELECT nom_match FROM matchs;";
      $reponse = $connection->prepare($requete);
      $reponse->execute();
      foreach($reponse as $nomequipe){
          $nomeq = $nomequipe['nom_match'];
	  echo $nomeq;
	  echo "<br />\n";
      }
      echo "</div>";
      }
        ?>

</body>
</html>