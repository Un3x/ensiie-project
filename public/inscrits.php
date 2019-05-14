<?php
session_start();
$_SESSION['adresse']="inscrits.php";
require '../vendor/autoload.php';

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
<link rel="icon" type="image/png" href="logo.png" id="im" />
<link rel="stylesheet" href="style.css"/>
</head>

<nav>
<ul class="topnav">
<li><a href="accueil.php">Home</a></li>
<li><a href="profil.php">Profil</a></li>
<li><a href="pageMembre.php">Membres</a></li>
<li><a href="inscrits.php" class="active">Inscrits</a></li>
<li><a href="nathane/gain.php">Nathane</a></li>
<li><a href="aime/comment.php">Aimé</a></li>
<li class="right"><a href="deconnexion.php">Déconnexion</a></li>
</nav>

<body>

<h1>Personnes inscrites au site</h1>
<?php $requete=$connection->query('SELECT membres.pseudo, membres.prenom, membres.nom, membres.mail,
reponses.un, reponses.deux, reponses.trois, reponses.quatre, reponses.cinq, reponses.six,
reponses.sept, reponses.huit, reponses.neuf, reponses.dix FROM membres LEFT JOIN reponses ON membres.pseudo=reponses.pseudo WHERE membres.statut=\'V\' ORDER BY membres.pseudo')?>
<table>
    <tr>
        <th>Pseudo</th>
        <th>Prenom</th>
        <th>Nom</th>
        <th>Adresse mail</th>
        <th>Réponses au formulaire</th>
    </tr>
    <?php while ($donnees = $requete->fetch()) { ?>
    <tr>
        <td><?php echo $donnees['pseudo']; ?></td>
        <td><?php echo $donnees['prenom']; ?></td>
        <td><?php echo $donnees['nom']; ?></td>
        <td><?php echo $donnees['mail']; ?></td>
        <td><?php echo $donnees['un']; echo $donnees['deux']; echo $donnees['trois']; echo $donnees['quatre']; echo $donnees['cinq']; echo $donnees['six']; echo $donnees['sept']; echo $donnees['huit']; echo $donnees['neuf']; echo $donnees['dix']; ?></th>
    </tr>
    <?php } ?>
</table>
<p>Légende pour les réponses au questionnaire : 
<ul>
<li>N : Nathane</li>
<li>H : Hugo</li>
<li>F : Florence</li>
<li>A : Aimé</li>
<li>L : Louis</li>
</ul></p>
</body>
</html>