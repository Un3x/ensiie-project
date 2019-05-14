<?php
session_start();
$_SESSION['adresse'] = "finalPage.php";
if (!isset($_SESSION['authent']) || $_SESSION['authent']==0) header("Location: accueil.php");
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


<body class="bgimage">
<h1 class="title">Question finale</h1>
<h3 class="second">Quels sont les 4 mots composants la devise da la meute ? </h3>

<div class="container">
<form action="succeed.php" method="post" class="form" >

<b class="fp">Premier</b><br/>
<input type="password" name="premier" id="premier" size="20" class="log" required/><br/><br/>
<b class="fp">Second</b><br/>
<input type="password" name="second" id="second" size="20" class="log" required/><br/><br/>
<b class="fp">Troisième</b><br/>
<input type="password" name="troisieme" id="troisieme" size="20" class="log" required/><br/><br/>
<b class="fp">Dernier</b><br/>
<input type="password" name="dernier" id="dernier" size="20" class="log" required/><br/><br/>
<input type="submit" value="Envoyer" class="send"/> <input type="reset" value="Annuler" class="cancel"/>

</form>
</div>



</body>
</html>