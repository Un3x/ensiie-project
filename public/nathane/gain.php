<?php
session_start();
$_SESSION['adresse']="nathane/gain.php";
if (!isset($_SESSION['authent']) || $_SESSION['authent']==0) header("Location: accueil.php");

require '../../vendor/autoload.php';

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$requete=$connection->query('SELECT * FROM "nathane_citations" ORDER BY nombre;');
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firewolf</title>
    <link rel="icon" type="image/png" href="../logo.png" id="im" />
    <link rel="stylesheet" href="../style.css"/>
  </head>

<nav>
<?php
if ($_SESSION['statut']=='M') {
  echo "
  <ul class=\"topnav\">
  <li><a href=\"../accueil.php\">Home</a></li>
  <li><a href=\"../profil.php\">Profil</a></li>
  <li><a href=\"../pageMembre.php\">Membres</a></li>
  <li><a href=\"../inscrits.php\">Inscrits</a></li>
  <li><a href=\"gain.php\" class=\"active\">Nathane</a></li>
  <li><a href=\"../aime/comment.php\">Aimé</a></li>
  <li class=\"right\"><a href=\"../deconnexion.php\">Déconnexion</a></li>
  </ul>";
}
else {
  echo "
  <ul class=\"topnav\">
  <li><a href=\"../accueil.php\">Home</a></li>
  <li><a href=\"../profil.php\">Profil</a></li>
  <li><a href=\"../rn_tmp.php\">Rejoins-nous</a></li>
  <li class=\"right\"><a href=\"../deconnexion.php\">Déconnexion</a></li></ul>";
}
?>
</nav>

<body>
<h1 id="citations">Félicitation</h1>
<section class="center">
<p>Vous venez de remportez le grooooooos lot.<br/>
<strong>Tu peux passez a l'étape suivante dans ta démarche pour rejoindre La Meute. (Et c'est le chef qui te le dit.)                                                        
</strong>.<br/>                                                
<img src="images.jpeg" width="400" />                                          
<h3 id="citation1"></h3>                                                                             
<a href="../finalPage.php">Cliquez-ici </a><br/><br>
Et voici d'autres petites citations pour languir les oreilles ...
<form method="post" action="add_citation.php" class="form">
<table>
  <?php while ($donnees = $requete->fetch()) { ?>
  <tr>
    <th><?php echo $donnees['nombre']; ?></th>
    <th><?php echo $donnees['citation']; ?></th>
  </tr>
  <?php } ?>
</table>
<?php if ($_SESSION['statut']=='M') { ?>
  <b>Modifier une citation</b><br/>
  n° citation <br>
  <input type="number" name="n" min="1" max="20" required/><br/>
  Nouvelle citation<br>
  <input type="text" name="c" class="log" required/>
  <input type="submit" value="Envoyer" class="send"/> <input type="reset" value="Annuler" class="cancel"/>
<?php } ?>

</form>

</section> 
</body>                                                             
</html>
