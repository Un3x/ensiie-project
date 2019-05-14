<?php
session_start();
$_SESSION['adresse'] = "succeed.php";
if (!isset($_SESSION['authent']) || $_SESSION['authent']==0 || !isset($_POST['premier'])) header("Location: accueil.php");
require '../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$i=0;
if ($_POST['premier']=="honnêteté" || $_POST['premier']=="espoir" || $_POST['premier']=="entraide" || $_POST['premier']=="effort") $i++;
if ($_POST['second']=="honnêteté" || $_POST['second']=="espoir" || $_POST['second']=="entraide" || $_POST['second']=="effort") $i++;
if ($_POST['troisieme']=="honnêteté" || $_POST['troisieme']=="espoir" || $_POST['troisieme']=="entraide" || $_POST['troisieme']=="effort") $i++;
if ($_POST['dernier']=="honnêteté" || $_POST['dernier']=="espoir" || $_POST['dernier']=="entraide" || $_POST['dernier']=="effort") $i++;
if ($i==4) {
    $requete=$connection->prepare('UPDATE membres SET statut=\'M\' WHERE pseudo=:pseudo;');
    $requete->execute(array(
        'pseudo' => $_SESSION['pseudo']
    ));
    $req=$connection->prepare('DELETE FROM reponses WHERE pseudo=:pseudo;');
    $_SESSION['statut']='M';
    $req->execute(array(
        'pseudo' => $_SESSION['pseudo']
    ));
}
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
  <?php
if ($_SESSION['statut']=='M') {
    echo "
    <ul class=\"topnav\">
    <li><a href=\"accueil.php\">Home</a></li>
    <li><a href=\"profil.php\">Profil</a></li>
    <li><a href=\"pageMembre.php\">Membres</a></li>
    <li><a href=\"inscrits.php\">Inscrits</a></li>
    <li><a href=\"nathane/gain.php\">Nathane</a></li>
    <li><a href=\"aime/comment.php\">Aimé</a></li>
    <li class=\"right\"><a href=\"deconnexion.php\">Déconnexion</a></li>
    </ul>";
}
else {
    echo "
    <ul class=\"topnav\">
    <li><a href=\"accueil.php\">Home</a></li>
    <li><a href=\"profil.php\">Profil</a></li>
    <li><a href=\"rn_tmp.php\">Rejoins-nous</a></li>
    <li class=\"right\"><a href=\"deconnexion.php\">Déconnexion</a></li></ul>";
}
?>
</nav>

</html>

<?php
if ($i==4) echo "<h1>Félicitations ! Vous êtes maintenant membre de la meute</h1>";
else echo "<h1>Mauvaise réponse</h1>"
?>