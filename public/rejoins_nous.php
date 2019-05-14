<?php session_start(); 
$_SESSION['adresse'] = "rejoins_nous.php";
?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Firewolf</title>
<link rel="icon" type="image/png" href="logo.png" id="im" />
<link rel="stylesheet" href="style.css"/>
</head>

<body>

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
    <li><a href=\"pageMembre.php\">Membres</a></li>
    <li><a href=\"rn_tmp.php\" class=\"active\">Rejoins-nous</a></li>
    <li class=\"right\"><a href=\"deconnexion.php\">Déconnexion</a></li></ul>";
}
?>
</nav>
<h1>Rejoins-nous !</h1>


<form action="rn_traitement.php" method="post" class="form">
<h3>Qui est le chef de meute légitime ? </h3>
<div class="inputGroup">
    <input type="radio" name="Q1" value ="N" id="N" class="q" required/><label class="q" for="N">Nathane</label>
</div>
<div class="inputGroup">
    <input type="radio" name="Q1" value ="L"  id="L" class="q" required/><label class="q" for="L">Louis</label> 
</div>
<div class="inputGroup">
    <input type="radio" name="Q1" value ="H" id="H" class="q" required/><label class="q" for="H">Hugo</label>
</div>
<div class="inputGroup">
    <input type="radio" name="Q1" value ="A" id="A" class="q" required/><label class="q" for="A">Aimé</label>
</div>
<div class="inputGroup">
    <input type="radio" name="Q1" value ="F" id="F" class="q" required/><label class="q" for="F">Florence</label>
</div>
<h3>Quel est ton plus gros défaut ? </h3>
<div class="inputGroup">
    <input type="radio" name="Q2" value ="A" id="A2" class="q" required/><label class="q" for="A2">Ton manque d'humour</label>
</div>
<div class="inputGroup">
    <input type="radio" name="Q2" value ="L" id="L2" class="q" required/><label class="q" for="L2">Ton manque de communication</label>
</div>
<div class="inputGroup">
    <input type="radio" name="Q2" value ="N" id="N2" class="q" required/><label class="q" for="N2">Ton côté dramaturge</label>
</div>
<div class="inputGroup">
    <input type="radio" name="Q2" value ="H" id="H2" class="q" required/><label class="q" for="H2">Ton racisme</label>
</div>
<div class="inputGroup">
    <input type="radio" name="Q2" value ="F" id="F2" class="q" required/><label class="q" for="F2">Tu es naïf</label>
</div>
<h3>Quelle est ta série préférée ? </h3>
<div class="inputGroup">
<input type="radio" name="Q3" value ="A" id="A3" class="q" required/><label class="q" for="A3">Spartacus</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q3" value ="L" id="L3" class="q" required/><label class="q" for="L3">Hannibal</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q3" value ="F" id="F3" class="q" required/><label class="q" for="F3">The 100</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q3" value ="N" id="N3" class="q" required/><label class="q" for="N3">Les Marseillais</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q3" value ="H" id="H3" class="q" required/><label class="q" for="H3">Breaking Bad</label>
</div>
<h3>Quelle est ta matière de prédilection ? </h3>
<div class="inputGroup">
<input type="radio" name="Q4" value ="H" id="H4" class="q" required/><label class="q" for="H4">Informatique</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q4" value ="A" id="A4" class="q" required/><label class="q" for="A4">Mathématiques</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q4" value ="F" id="F4" class="q" required/><label class="q" for="F4">Chinois</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q4" value ="N" id="N4" class="q" required/><label class="q" for="N4">Sport</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q4" value ="L" id="L4" class="q" required/><label class="q" for="L4">Toutes</label>
</div>
<h3>Quel est ton plat préféré ? </h3>
<div class="inputGroup">
<input type="radio" name="Q5" value ="F" id="F5" class="q" required/><label class="q" for="F5">Entrecôte avec sauce forestière</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q5" value ="H" id="H5" class="q" required/><label class="q" for="H5">Magret de canard</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q5" value ="A" id="A5" class="q" required/><label class="q" for="A5">Bokit</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q5" value ="N" id="N5" class="q" required/><label class="q" for="N5">Lait & Kellogg's</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q5" value ="L" id="L5" class="q" required/><label class="q" for="L5">Pâtes carbonara</label>
</div>
<h3>Quel est ton sport favoris ? </h3>
<div class="inputGroup">
<input type="radio" name="Q6" value ="N" id="N6" class="q" required/><label class="q" for="N6">Football</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q6" value ="A" id="A6" class="q" required/><label class="q" for="A6">Zouk</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q6" value ="H" id="H6" class="q" class="q" required/><label class="q" for="H6">Hip-Hop</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q6" value ="F" id="F6" class="q" required/><label class="q" for="F6">Badminton</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q6" value ="L" id="L6" class="q" required/><label class="q" for="L6">Natation</label>
</div>
<h3>Quel est ton style vestimentaire ? </h3>
<div class="inputGroup">
<input type="radio" name="Q7" value ="L" id="L7" class="q" required/><label class="q" for="L7">Class</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q7" value ="F" id="F7" class="q" required/><label class="q" for="F7">Unisex</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q7" value ="H" id="H7" class="q" required/><label class="q" for="H7">Casual</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q7" value ="N" id="N7" class="q" required/><label class="q" for="N7">Street</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q7" value ="A" id="A7" class="q" required/><label class="q" for="A7">Trop décontracté</label>
</div>
<h3>Comment juges-tu ta présence en cours ? </h3>
<div class="inputGroup">
<input type="radio" name="Q8" value ="A" id="A8" class="q" required/><label class="q" for="A8">Toujours en retard</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q8" value ="H" id="H8" class="q" required/><label class="q" for="H8">Toujours présent</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q8" value ="L" id="L8" class="q" required/><label class="q" for="L8">Quasiment toujours présent</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q8" value ="F" id="F8" class="q" required/><label class="q" for="F8">Variable</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q8" value ="N" id="N8" class="q" required/><label class="q" for="N8">Jamais là</label>
</div>
<h3>Type de soirée idéale ? </h3>
<div class="inputGroup">
<input type="radio" name="Q9" value ="H" id="H9" class="q" required/><label class="q" for="H9">Soirée karaoké</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q9" value ="N" id="N9" class="q" required/><label class="q" for="N9">Soirée monopoly</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q9" value ="L" id="L9" class="q" required/><label class="q" for="L9">Soirée Netflix</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q9" value ="A" id="A9" class="q" required/><label class="q" for="A9">Soirée belote</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q9" value ="F" id="F9" class="q" required/><label class="q" for="F9">Soirée cinéma</label>
</div>
<h3>Ta destination de rêve ? </h3>
<div class="inputGroup">
<input type="radio" name="Q10" value ="H" id="H10" class="q" required/><label class="q" for="H10">Los Angeles</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q10" value ="N" id="N10" class="q" required/><label class="q" for="N10">Las Vegas</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q10" value ="A" id="A10" class="q" required/><label class="q" for="A10">Punta Cana</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q10" value ="F" id="F10" class="q" required/><label class="q" for="F10">Norvège</label>
</div>
<div class="inputGroup">
<input type="radio" name="Q10" value ="L" id="L10" class="q" required/><label class="q" for="L10">Canada</label>
</div>
<div>
<input type="submit" value="Envoyer" class="send"/> <input type="reset" value="Annuler" class="cancel"/>
</div>
</form>

</body>

</html>