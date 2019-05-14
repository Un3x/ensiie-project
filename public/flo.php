<?php
session_start();
$_SESSION['adresse'] = "flo.php";
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

<style>

h4 {
	color: white; 
}

</style>

<body class= "bgimageFlo">


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

<h1 class="intro"> Blindtest : Gus's Favorites </h1> 
<h4 class= "intro">  Félicitations! Tu as réussi la première étape du test pour rejoindre la Meute. </h4>
<h4 class= "intro"> Il semblerait que ton profil correspond à celui de Gus. Pour réussir cet étape spécialement concoctée par Gus, tu dois trouver au moins 7 bonnes réponses.  </h4>
<form action="blindtest.php" method="post" class= "form">

<h4> Titre n°1</h4>
<audio controls>
	<source src="flo/Nevermind-DennisLloyd.wav"></audio> 
</audio>
<div class="inputGroup">
	<input type="radio" name="Q1" value ="R1" id="A1" class="q" required/><label class="q" for="A1"> FKJ </label>
</div>
<div class="inputGroup">
	<input type="radio" name="Q1" value ="R2" id="B1" class="q" required/><label class="q" for="B1"> Dennis Lloyd </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q1" value ="R3" id="C1" class="q" required/><label class="q" for="C1"> Flume </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q1" value ="R4" id= "D1" class="q" required/><label class="q" for="D1"> Chet Faker </label>
</div>



<h4> Titre n°2</h4>
<audio controls> 
<source src="flo/Paradise-Coldplay.wav"></audio>

<div class="inputGroup">
	<input type="radio" name="Q2" value ="R1" id="A2" class="q" required/><label class="q" for="A2"> One Republic </label>
</div>
</div>
<div class="inputGroup">
	<input type="radio" name="Q2" value ="R2" id="B2" class="q" required/> <label class="q" for="B2"> Coldplay </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q2" value ="R3" id="C2" class="q" required/> <label class="q" for="C2"> The Script </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q2" value ="R4" id= "D2" class="q" required/> <label class="q" for="D2"> Radiohead </label>
</div> 



<h4> Titre n°3</h4>
<audio controls> 
<source src="flo/HallOfFame-TheScript.wav"></audio>
<div class="inputGroup">
	<input type="radio" name="Q3" value ="R1" id="A3" class="q" required/> <label class="q" for="A3"> One Republic </label>
</div>
</div>
<div class="inputGroup">
	<input type="radio" name="Q3" value ="R2" id="B3" class="q" required/> <label class="q" for="B3"> Coldplay </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q3" value ="R3" id="C3" class="q" required/> <label class="q" for="C3"> The Script </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q3" value ="R4" id= "D3" class="q" required/> <label class="q" for="D3"> Radiohead </label>
</div> 


<h4> Titre n°4</h4>
<audio controls> 
<source src="flo/IDFC-Blackbear.wav"> </audio>
<div class="inputGroup">
	<input type="radio" name="Q4" value ="R1" id="A4" class="q" required/><label class="q" for="A4"> Gnash</label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q4" value ="R2" id="B4" class="q" required/> <label class="q" for="B4"> The Weeknd </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q4" value ="R3" id= "C4" class="q" required/> <label class="q" for="C4"> Petit Biscuit </label>
</div> 
<div class= "inputGroup">
<input type="radio" name="Q4" value ="R4" id="D4" class="q" required/> <label class="q" for="D4"> BlackBear </label>
</div>



<h4> Titre n°5</h4>
<audio controls> 
<source src="flo/StressedOut-TwentyOnePilots.wav"></audio>
<div class="inputGroup">
	<input type="radio" name="Q5" value ="R1" id="A5" class="q" required/> <label class="q" for="A5"> Twenty One Pilots </label>
</div>
</div>
<div class="inputGroup">
	<input type="radio" name="Q5" value ="R2" id="B5" class="q" required/> <label class="q" for="B5"> Avicii </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q5" value ="R3" id="C5" class="q" required/> <label class="q" for="C5"> The Chainsmokers </label>
</div>

<div class="inputGroup">
<input type="radio" name="Q5" value ="R4" id= "D5" class="q" required/> <label class="q" for="D5"> Maroon 5 </label>
</div> 


<h4> Titre n°6</h4>
<audio controls> 
<source src="flo/BadGuy-BillieEilish.wav"></audio>

<div class="inputGroup">
	<input type="radio" name="Q6" value ="R1" id="A6" class="q" required/><label class="q" for="A6"> Lorde </label>
</div>
</div>
<div class="inputGroup">
	<input type="radio" name="Q6" value ="R2" id="B6" class="q" required/><label class="q" for="B6"> Troye Sivan </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q6" value ="R3" id="C6" class="q" required/> <label class="q" for="C6"> Khalid </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q6" value ="R4" id= "D6" class="q" required/> <label class="q"  for="D6"> Billie Eilish </label>
</div> 



<h4> Titre n°7</h4>
<audio controls> 
<source src="flo/Tadow-FKJ.wav"> </audio>
<div class="inputGroup">
	<input type="radio" name="Q7" value ="R1" id="A7" class="q" required/><label  class="q" for="A7"> FKJ </label>
</div>
<div class="inputGroup">
	<input type="radio" name="Q7" value ="R2" id="B7" class="q" required/> <label  class="q" for="B7"> Dennis Lloyd </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q7" value ="R3" id="C7" class="q" required/><label class="q" for="C7"> Flume </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q7" value ="R4" id= "D7" class="q" required/><label class="q" for="D7"> Chet Faker </label>
</div> 



<h4> Titre n°8</h4>
<audio controls> 
<source src="flo/River-BishopBriggs.wav"></audio>

<div class="inputGroup">
	<input type="radio" name="Q8" value ="R1" id="A8" class="q" required/><label class="q" for="A8"> Vérité </label>
</div>
</div>
<div class="inputGroup">
	<input type="radio" name="Q8" value ="R2" id="B8"  class="q" required/><label class="q" for="B8"> Bishop Briggs </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q8" value ="R3" id="C8" class="q" required/> <label class="q" for="C8"> Halsey </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q8" value ="R4" id= "D8" class="q" required/> <label class="q" for="D8"> Bea Miller </label>
</div> 
 




<h4> Titre n°9</h4>
<audio controls> 
<source src="flo/TaMariniere-Hoshi.wav"> </audio>
<div class="inputGroup">
	<input type="radio" name="Q9" value ="R1" id="A9" class="q" required/> <label class="q" for="A9"> Zaz </label>
</div>
<div class="inputGroup">
	<input type="radio" name="Q9" value ="R2" id="B9" class="q" required/> <label class="q" for="B9"> L.E.J </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q9" value ="R3" id="C9" class="q" required/><label class="q" for="C9"> Angele </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q9" value ="R4" id= "D9" class="q" required/><label class="q" for="D9"> Hoshi </label>
</div> 


<h4> Titre n°10</h4>
<audio controls> 
<source src="flo/SurLaLune-BigfloEtOli.wav"> </audio>
<div class="inputGroup">
	<input type="radio" name="Q10" value ="R1" id="A10" class="q" required/> <label class="q" for="A10"> BigFlo & Oli </label>
</div>
</div>
<div class="inputGroup">
	<input type="radio" name="Q10" value ="R2" id="B10" class="q" required/> <label class="q" for="B10"> Orelsan </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q10" value ="R3" id="C10"  class="q" required/> <label class="q" for="C10"> Nekfeu </label>
</div>

<div class="inputGroup">
	<input type="radio" name="Q10" value ="R4" id= "D10" class="q" required/> <label class="q" for="D10"> Eddy de Pretto </label>
	
</div> 


<input type="submit" value="Valider" name="valider" class="send"/>
 <input type="reset" value="Annuler" class="cancel"/>



</form>

</body>

</html>