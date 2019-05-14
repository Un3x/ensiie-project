<?php

session_start();
$_SESSION['adresse'] = "aime/comment.php";
if (!isset($_SESSION['authent']) || $_SESSION['authent']==0) header("Location: accueil.php");

require '../../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
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
if (!isset($_SESSION['authent'])) {
  echo "
  <ul class=\"topnav\">
  <li><a class=\"active\" href=\"../accueil.php\">Home</a></li>
  <li><a href=\"../rn_tmp.php\">Rejoins-nous</a></li>
  <li class=\"right\"><button onclick=\"document.getElementById('id01').style.display='block'\" style=\"width:auto;\">Connexion</button></li>
  </ul>";
}
else {
  if ($_SESSION['statut']=='M') {
    echo "
    <ul class=\"topnav\">
    <li><a href=\"../accueil.php\">Home</a></li>
    <li><a href=\"../profil.php\">Profil</a></li>
    <li><a href=\"../pageMembre.php\">Membres</a></li>
    <li><a href=\"../inscrits.php\">Inscrits</a></li>
    <li><a href=\"../nathane/gain.php\">Nathane</a></li>
    <li><a href=\"comment.php\" class=\"active\">Aimé</a></li>
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
}
?>
</nav>

<body>

<h2 class="center">Commentaires laissés</h2>
<?php $req=$connection->query('SELECT * FROM aime_commentaires ORDER BY pseudo'); ?>
<table>
    <tr>
        <th>Pseudo</th>
        <th>Plage</th>
        <th>Femme métisse</th>
        <th>Chocolat</th>
        <th>Van's bleues</th>
        <th>Cocktail</th>
        <th>Chat</th>
        <th>Femme blanche</th>
        <th>Hamburger</th>
        <th>Voiture</th>
        <th>OM</th>
    </tr>
    <?php while ($donnees=$req->fetch()) { ?>
    <tr>
        <td><?php echo $donnees['pseudo']; ?></td>
        <td><?php echo $donnees['plage']; ?></td>
        <td><?php echo $donnees['metisse']; ?></td>
        <td><?php echo $donnees['chocolat']; ?></td>
        <td><?php echo $donnees['vans']; ?></td>
        <td><?php echo $donnees['cocktail']; ?></td>
        <td><?php echo $donnees['chat']; ?></td>
        <td><?php echo $donnees['blanche']; ?></td>
        <td><?php echo $donnees['hamburger']; ?></td>
        <td><?php echo $donnees['voiture']; ?></td>
        <td><?php echo $donnees['om']; ?></td>
    <tr>
    <?php } ?>
</table>

</body>

</html>