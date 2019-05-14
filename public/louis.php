<?php
session_start();
$_SESSION['adresse'] = "louis.php";
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

<body>

<h3 class="center">Te voilà arrivé sur la page de Louis !</h3>
<h3 class="center">Selon ton résultat, tu auras le droit de continuer ou non donc bonne chance à toi et blessed be the fruit !</h3>
<h1> Quel personnage de série es-tu ?</h1>

<form action="perso_serie.php" method="post" class="form">
<h3>Le chef de meute te vire du groupe WhatsApp, que fais tu ? </h3>
<div class="inputGroup">
<input type="radio" name="Q1" value ="B" id="B1" class="q" required/><label class="q" for="B1">tu vas te plaindre à tes meufs</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q1" value ="H" id="H1" class="q" required/><label class="q" for="H1">tu aiguises tes couteaux</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q1" value ="L" id="L1" class="q" required/><label class="q" for="L1">tu cries pour évacuer ta frustration</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q1" value ="A" id="A1" class="q" required/><label class="q" for="A1">tu rampes pour qu'il te réintègre</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q1" value ="C" id="C1" class="q" required/><label class="q" for="C1">tu en rigoles</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q1" value ="S" id="S1" class="q" required/><label class="q" for="S1">rien</label>
</div>
<h3>La place du vice-président se libère, quel est ton plan d'action ? </h3>
<div class="inputGroup">
<input type="radio" name="Q2" value ="A" id="A2" class="q" required/><label class="q" for="A2">tu menaces de te suicider si tu n'as pas la place</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q2" value ="H" id="H2" class="q" required/><label class="q" for="H2">tu amadoues le chef avec de bons petits plats</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q2" value ="S" id="S2" class="q" required/><label class="q" for="S2">tu n'en as pas</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q2" value ="B" id="B2" class="q" required/><label class="q" for="B2">tu t'habilles comme jaja pour montrer que tu es fait pour ce poste</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q2" value ="L" id="L2" class="q" required/><label class="q" for="L2">tu uses de tes charmes</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q2" value ="C" id="C2" class="q" required/><label class="q" for="C2">tu partages une bonne bouteille d'alcool avec le chef</label>
</div>
<h3>Lors d'une partie de Monopoly, quel type de joueur es-tu ? </h3>
<div class="inputGroup">
<input type="radio" name="Q3" value ="S" id="S3" class="q" required/><label class="q" for="S3">celui qui n'est pas invité</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q3" value ="H" id="H3" class="q" required/><label class="q" for="H3">le manipulateur</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q3" value ="L" id="L3" class="q" required/><label class="q" for="L3">celui qui veut absolument les Champs-Élysées</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q3" value ="C" id="C3" class="q" required/><label class="q" for="C3">celui qui finit tout le temps en prison</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q3" value ="B" id="B3" class="q" required/><label class="q" for="B3">celui qui dépense sans compter</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q3" value ="A" id="A3" class="q" required/><label class="q" for="A3">celui qui dépend d'un autre joueur</label>
</div>
<h3>Quelle place penses-tu que tu occuperais au sein de la meute ? </h3>
<div class="inputGroup">
<input type="radio" name="Q4" value ="C" id="C4" class="q" required/><label class="q" for="C4">le casseur de genoux</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q4" value ="B" id="B4" class="q" required/><label class="q" for="B4">le mec à meufs / la meuf à mecs</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q4" value ="A" id="A4" class="q" required/><label class="q" for="A4">le pot de colle</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q4" value ="L" id="L4" class="q" required/><label class="q" for="L4">la/le bg</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q4" value ="S" id="S4" class="q" required/><label class="q" for="S4">l'inutile</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q4" value ="H" id="H4" class="q" required/><label class="q" for="H4">l'estomac sur pattes</label>
</div>
<h3>Il est 18 h, tu viens de rentrer chez toi et tu allumes la télé, qu'est ce que tu regardes ? </h3>
<div class="inputGroup">
<input type="radio" name="Q5" value ="H" id="H5" class="q" required/><label class="q" for="H5">MasterChef</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q5" value ="S" id="S5" class="q" required/><label class="q" for="S5">Les Feux de l'amour</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q5" value ="L" id="L5" class="q" required/><label class="q" for="L5">Les Reines du shopping</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q5" value ="A" id="A5" class="q" required/><label class="q" for="A5">Chasseurs d'appart'</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q5" value ="B" id="B5" class="q" required/><label class="q" for="B5">Bachelor</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q5" value ="C" id="C5" class="q" required/><label class="q" for="C5">Grey's Anatomy</label>
</div>
<h3>Quelqu'un à la mauvaise idée de te mettre une claque, comment compte tu te venger ? </h3>
<div class="inputGroup">
<input type="radio" name="Q6" value ="C" id="C6" class="q" required/><label class="q" for="C6">tu tues son chat</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q6" value ="B" id="B6" class="q" required/><label class="q" for="B6">tu ne peux pas, ce sont les règles du slapbet</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q6" value ="L" id="L6" class="q" required/><label class="q" for="L6">tu t'attaques à son/sa crush</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q6" value ="A" id="A6" class="q" required/><label class="q" for="A6">tu lui piques son téléphone</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q6" value ="S" id="S6" class="q" required/><label class="q" for="S6">tu as peur des represailles</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q6" value ="H" id="H6" class="q" required/><label class="q" for="H6">la vengeance est un plat qui se mange froid</label>
</div>
<h3>Quel genre de musique t'ambiance ? </h3>
<div class="inputGroup">
<input type="radio" name="Q7" value ="S" id="S7" class="q" required/><label class="q" for="S7">Chant lyrique</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q7" value ="B" id="B7" class="q" required/><label class="q" for="B7">Comédie Musicale</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q7" value ="H" id="H7" class="q" required/><label class="q" for="H7">Classique</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q7" value ="L" id="L7" class="q" required/><label class="q" for="L7">Pop</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q7" value ="A" id="A7" class="q" required/><label class="q" for="A7">Disco</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q7" value ="C" id="C7" class="q" required/><label class="q" for="C7"> Rock'n'roll</label>
</div>
<h3>Un loup de la meute se retrouve en difficulté, que fais tu ? </h3>
<div class="inputGroup">
<input type="radio" name="Q8" value ="C" id="C8" class="q" required/><label class="q" for="C8">tu pars en road-trip avec lui</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q8" value ="B" id="B8" class="q" required/><label class="q" for="B8">tu l'invites dans ton bar préféré</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q8" value ="H" id="H8" class="q" required/><label class="q" for="H8">tu lui conseilles un bon psy</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q8" value ="S" id="S8" class="q" required/><label class="q" for="S8">tu pleures</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q8" value ="L" id="L8" class="q" required/><label class="q" for="L8">tu organises une soirée chez toi pour lui changer les idées</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q8" value ="A" id="A8" class="q" required/><label class="q" for="A8">tu déprimes car il ne va pas s'occuper de tes problèmes du coup</label>
</div>
<br/><input type="submit" value="Envoyer" class="send"/> <input type="reset" value="Annuler" class="cancel"/>
</form>

</body>

</html>