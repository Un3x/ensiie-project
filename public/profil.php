<?php 
session_start();
$_SESSION['adresse']="profil.php";

require '../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

if (!isset($_SESSION['verif_mdp'])) $_SESSION['verif_mdp']=0;
if (!isset($_SESSION['verif_pseudo'])) $_SESSION['verif_pseudo']=0;
if (!isset($_SESSION['verif_mail'])) $_SESSION['verif_mail']=0;

$requete=$connection->query('SELECT * FROM membres');
while ($donnees = $requete->fetch()) {
  if ($donnees['pseudo']==$_SESSION['pseudo']) {
  $prenom_user = $donnees['prenom'];
  $nom_user = $donnees['nom'];
  $mail_user = $donnees['mail'];
  $statut_user = $donnees['statut'];
  }
}

?>


<script>
function AfficherCacher(texte) {
var test = document.getElementById(texte).style.display;
if (test == "block") document.getElementById(texte).style.display = "none";
else document.getElementById(texte).style.display = "block";
}
</script>

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
    <li><a href=\"profil.php\" class=\"active\">Profil</a></li>
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
    <li><a href=\"profil.php\" class=\"active\">Profil</a></li>
    <li><a href=\"pageMembre.php\">Membres</a></li>
    <li><a href=\"rn_tmp.php\">Rejoins-nous</a></li>
    <li class=\"right\"><a href=\"deconnexion.php\">Déconnexion</a></li></ul>";
  }
?>
</nav>

<h1>Profil</h1>

<body>

<div class="container">
<form action="profil_traitement.php" method="post" class="form">

<h3>Pseudo : <?php echo $_SESSION['pseudo']; ?></h3>
<button onclick='AfficherCacher("pseudo"); return false'>Modifier pseudo</button>
<div id="pseudo" style="display:none">
<?php if ($_SESSION['verif_pseudo']==1) echo "<span class=\"warning\">Pseudo déjà pris</span><br/>"; ?>
<input type="text" name="pseudo" id="pseudo" size="20" class="log"/><br/>
</div>
<h3>Prénom : <?php echo $prenom_user; ?></h3>
<h3>Nom : <?php echo $nom_user; ?></h3>
<h3>Mail : <?php echo $mail_user; ?></h3>
<button onclick='AfficherCacher("mail"); return false'>Modifier adresse mail</button>
<div id="mail" style="display:none">
<?php if ($_SESSION['verif_mail']==1) echo "<span class=\"warning\">Adresse mail déjà utilisée</span><br/>"; ?>
<input type="text" name="mail" id="mail" size="20" class="log"/><br/>
</div>
<h3>Statut : <?php if($statut_user=='V') echo "Visiteur"; else echo "Membre"; ?></h3>


<button onclick='AfficherCacher("mdp"); return false'>Modifier mot de passe</button>
<div id="mdp" style="display:none">
<?php if ($_SESSION['verif_mdp']==1) echo "<span class=\"warning\">Erreur de mot de passe</span><br/>"; ?>
<b>Mot de passe</b><br/>
<input type="password" name="mdp" id="mdp" size="20" class="log"/><br/>
<b>Confirmation mot de passe</b><br/>
<input type="password" name="mdp2" id="mdp2" size="20" class="log"/>
</div><br/><br/>
<button onclick='AfficherCacher("delete"); return false'>Supprimer profil</button>
<div id="delete" style="display:none">
Êtes-vous sûr de vouloir supprimer votre profi ?
Oui <input type=radio name="delete" value="y">
Non <input type=radio name="delete" value="n">
</div>
<br/>
<input type="submit" value="Envoyer" class="send"/> <input type="reset" value="Annuler" class="cancel"/>

</form>
</div>

</body>
</html>