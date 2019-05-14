<?php 
session_start();
if (!isset($_SESSION['authent'])) {
  $_SESSION['authent'] = 0; }
$_SESSION['adresse'] = "accueil.php";

require("connexion.php");
?>


<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Firewolf</title>
<link rel="icon" type="image/png" href="logo.png" id="im" />
<link rel="stylesheet" href="style.css"/>
</head>


<style>
[class*="col-"] {
  float: left;
  padding: 15px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #333;
  color: #ffffff;
  box-shadow: 0 1px 1px midnightblue, 0 1px 1px midnightblue;
}

.menu li:hover {
  background-color: midnightblue;
}

.aside {
  background-color: #333;
  padding: 15px;
  color: #ffffff;
  text-align: justify;
  font-size: 14px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

/* For desktop: */

.col-2 {width: 30%;}
.col-1 {width: 70%;}


@media only screen and (max-width: 800px) {
  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }
}
</style>

<body>
<nav>
<?php
if ($_SESSION['authent']==0) {
  echo "
  <ul class=\"topnav\">
  <li><a class=\"active\" href=\"accueil.php\">Home</a></li>
  <li><a href=\"pageMembre.php\">Membres</a></li>
  <li><a href=\"rn_tmp.php\">Rejoins-nous</a></li>
  <li class=\"right\"><a onclick=\"document.getElementById('id01').style.display='block'\">Connexion</a></li>
  </ul>";
}
else {
  if ($_SESSION['statut']=='M') {
    echo "
    <ul class=\"topnav\">
    <li><a class=\"active\" href=\"accueil.php\">Home</a></li>
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
    <li><a class=\"active\" href=\"accueil.php\">Home</a></li>
    <li><a href=\"profil.php\">Profil</a></li>
    <li><a href=\"pageMembre.php\">Membres</a></li>
    <li><a href=\"rn_tmp.php\">Rejoins-nous</a></li>
    <li class=\"right\"><a href=\"deconnexion.php\">Déconnexion</a></li></ul>";
  }
}


?>

</nav>



<?php
if (isset($_SESSION['try_rn']) && $_SESSION['try_rn']==1) {
  echo "<span class=\"warning\">Pour nous rejoindre, tu dois d'abord te connecter.</span></br>";
  $_SESSION['try_rn'] = 0;
}
if (isset($_SESSION['fail_connect'])) {
  if ($_SESSION['fail_connect']==1) {
    echo "<span class=\"warning\">Pseudo ou mot de passe incorrect.</span></br>";
    $_SESSION['fail_connect'] = 0;
  }
}
?>

<div class="col-1" >
<header>
<h1>Bienvenue sur le site de la meute !</h1>
</header>
  <h1 id="histoire">Histoire</h1>
      <p>Il était une fois à Evry, loin, très loin de Paris (RER D tout ça tu connaîs), quatre jeunes <strong>louveteaux</strong>.<br/> <b class="acc">Nathane</b> le louveteau se pensant dominant eu l'idée de créer et de manigancer un stratagème afin de mettre fin à la suprématie des <em>geeks</em> !<br />Afin de mener son projet à bien il définit des rôles à chacun de ses <em>compatriotes</em> : <br /></p>
   <ul>
      <li> <b class="acc">Hugzer </b> <em>le vice président</em> </li>
      <li> <b class="acc">Gohan</b> <em>le directeur artistique</em> </li>
      <li> <b class="acc">El Patron </b><em>l'agent secret</em> </li>
      </ul>
      <p>A la suite d'un èvenement <strong>irréversible</strong> la meute décida de s'expanser afin d'éradiquer un noyau dur de <em>bouffons</em>.<br />Des candidats se présentèrent ... <br/>
Une jeune loupiote répondant au nom de <b class="acc">Gus</b> sortait du lot grâce notamment à sa carrure, sa force, et son humour (plus élevés que certains loups de la meute). Une épreuve l'attendait avant d'intégrer complètement la meute : </br>
il lui fallait passer <em><strong>le</strong> casting</em>.</p>
<p  class="center"><img src="Membres/meute.jpeg" alt="La meute" height="400"/></p>
  </div>


<div class="col-2">
    <div class="aside">
   
    <h3>Actualités</h3>
<?php $req=$connection->query('SELECT * FROM actualite'); ?>
<div class="menu">
  <ul>
  <?php while($donnees=$req->fetch()) { ?>
  <li><?php if ($donnees['actu']!=NULL) echo $donnees['actu']; ?></li>
  <?php } ?>
 
</ul>
<?php
if (isset($_SESSION['statut'])) {
  if ($_SESSION['statut']=='M') { ?>
  <form method="post" action="actu.php">
  <br/>
      Ajouter une actualité<br/><br/>
      <input type="text" class="inscription" name="add" /><br/><br/><br/>
      Supprimer une actualité<br/><br/>
      <input type="text" class="inscription" name="delete" /><br/><br/>
      <input type="submit" value="Envoyer" class="send"/> <input type="reset" value="Annuler" class="cancel"/>
  </form>
<?php  }
}
?>

</div>
    </div>
  </div>


</body>
</html>
