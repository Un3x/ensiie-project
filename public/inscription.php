<?php 
session_start();
$_SESSION['adresse']="inscription.php";

require '../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$_SESSION['verif_mdp'] = 0;
$_SESSION['verif_pseudo'] = 0;
$_SESSION['verif_mail']= 0;

$pseudo = isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : NULL;
$mdp = isset($_POST['mdp']) ? htmlspecialchars($_POST['mdp']) : NULL;
$mdp2 = isset($_POST['mdp2']) ? htmlspecialchars($_POST['mdp2']) : NULL;
$prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : NULL;
$nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : NULL;
$mail = isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : NULL;

if ($mdp != $mdp2) {
    $_SESSION['verif_mdp']=1;
}

$requete=$connection->query('SELECT pseudo, mail FROM membres ');
while ($donnees = $requete->fetch()) {
    if ($donnees['pseudo']==$pseudo) $_SESSION['verif_pseudo']=1;
    if ($donnees['mail']==$mail) $_SESSION['verif_mail']=1;
}

if ($pseudo != NULL && $_SESSION['verif_mdp'] == 0 && $_SESSION['verif_pseudo'] == 0) {
    $req = $connection->prepare('INSERT INTO membres (pseudo,mdp,prenom,nom,statut,mail) VALUES (:pseudo,:mdp,:prenom,:nom,\'V\',:mail)');
    $req->execute(array(
        'pseudo' => $pseudo,
        'mdp' => $mdp,
        'prenom' => $prenom,
        'nom' => $nom,
        'mail' => $mail ));
    $_SESSION['authent']=1;
    $_SESSION['statut']='V';
    $_SESSION['pseudo']=$pseudo;
    header("Location: inscription_succeed.php");
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
<ul class="topnav">
<li><a href="accueil.php">Home</a></li>
<li><a href="pageMembre.php">Membres</a>
</ul>
</nav>

<body>

<h1>Inscription</h1>

<div class="container">
<form action="inscription.php" method="post">

<?php if ($_SESSION['verif_pseudo']==1) echo "<span class=\"warning\">Pseudo déjà pris</span><br/>"; ?>
<b>Pseudo</b><br/>
<input type="text" name="pseudo" id="pseudo" size="40" class="log" required/><br/><br/>
<?php if ($_SESSION['verif_mdp']==1) echo "<span class=\"warning\">Erreur de mot de passe</span><br/>"; ?>
<b>Mot de passe</b><br/>
<input type="password" name="mdp" id="mdp" size="40" class="log" required/><br/><br/>
<b>Confirmation mot de passe</b><br/>
<input type="password" name="mdp2" id="mdp2" size="40" class="log" required/><br/><br/>
<b>Prénom</b><br/>
<input type="text" name="prenom" id="prenom" size="40" class="log" required/><br/><br/>
<b>Nom</b><br/>
<input type="text" name="nom" id="nom" size="40" class="log" required/><br/><br/>
<?php if ($_SESSION['verif_mail']==1) echo "<span class=\"warning\">Adresse mail déjà utilisée</span><br/>"; ?>
<b>Adresse mail</b><br/>
<input type="text" name="mail" id="mail" size="40" class="log" required/><br/><br/>
<input type="submit" value="Envoyer" class="send"/> <input type="reset" value="Annuler" class="cancel"/>

</form>
</div>

</body>

</html>