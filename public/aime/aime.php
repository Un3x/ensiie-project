<?php
session_start();
$_SESSION['adresse'] = "aime/aime.php";
if (!isset($_SESSION['authent']) || $_SESSION['authent']==0) header("Location: ../accueil.php");
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
if ($_SESSION['statut']=='M') {
    echo "
    <ul class=\"topnav\">
    <li><a href=\"../accueil.php\">Home</a></li>
    <li><a href=\"../profil.php\">Profil</a></li>
    <li><a href=\"../pageMembre.php\">Membres</a></li>
    <li><a href=\"../inscrits.php\">Inscrits</a></li>
    <li><a href=\"../nathane/gain.php\">Nathane</a></li>
    <li><a href=\"comment.php\">Aimé</a></li>
    <li class=\"right\"><a href=\"../deconnexion.php\">Déconnexion</a></li>
    </ul>";
}
else {
    echo "
    <ul class=\"topnav\">
    <li><a href=\"../accueil.php\">Home</a></li>
    <li><a href=\"../profil.php\">Profil</a></li>
    <li><a href=\"../rn_tmp.php\">Rejoins-nous</a></li>
    <li class=\"right\"><a href=\"deconnexion.php\">Déconnexion</a></li></ul>";
}
?>
</nav>

  <body>
      <h1 class="aime">Bienvenue dans le ICM de Aimé</h1>
      <p class="center">Le concept de ce <strong>ICM</strong> (Image à Choix Multiples) est des plus simples.<br/>Imagine toi sur insta et Like ou Dislike celle que tu souhaites, et deviens célèbre !</p>

      
      <form method="post" action="resultatAime.php">
      <p class="center">
          <img class="Plage"
     src="plage-paradisiaque-maldives.jpg"
     alt="Plage" /> <br/>
           Do you like this beach ?
<input type="radio" name="plage" value="Like" required/>Like
<input type="radio" name="plage" value="Dislike" required/>Dislike
      <br/> Commentary <br/>
      <textarea name="cplage" id="cplage" rows="3" cols="69">
</textarea>    
      </p>

      <p class="center">
          <img class="Femme_metisse"
     src="femme_metisse.jpg"
     alt="Femme_metisse"/> <br/>
           Do you like this beach ?
<input type="radio" name="femme_metisse" value="Like" required/>Like
<input type="radio" name="femme_metisse" value="Dislike" required/>Dislike
      <br/> Commentary <br/>
      <textarea name="cmetisse" rows="3" cols="69">
</textarea>   
      </p>

      <p class="center">
          <img class="Chocolat"
     src="chocolat.jpg"
     alt="chocolat"/> <br/>
           Do you like this bûche ?
<input type="radio" name="chocolat" value="Like" required/>Like
<input type="radio" name="chocolat" value="Dislike" required/>Dislike
      <br/> Commentary <br/>
      <textarea name="cchocolat" rows="3" cols="69">
</textarea>   
      </p>

      <p class="center">
          <img class="Vans_bleue"
     src="Vans_bleue.jpg"
     alt="Vans_bleue"/> <br/>
           Do you like these shoes ?
<input type="radio" name="Vans" value="Like" required/>Like
<input type="radio" name="Vans" value="Dislike" required/>Dislike
      <br/> Commentary <br/>
      <textarea name="cvans" rows="3" cols="69">
</textarea>   
      </p>

      <p class="center">
          <img class="coktail"
     src="coktail.jpg"
     alt="coktail"/> <br/>
           Do you like this cocktail ?
<input type="radio" name="coktail" value="Like" required/>Like
<input type="radio" name="coktail" value="Dislike" required/>Dislike
      <br/> Commentary <br/>
      <textarea name="ccocktail" rows="3" cols="69">
</textarea>   
      </p>

       <p class="center">
          <img class="chat"
     src="chat.png"
     alt="chat"/> <br/>
           Do you like this cat ?
<input type="radio" name="chat" value="Like" required/>Like
<input type="radio" name="chat" value="Dislike" required/>Dislike
      <br/> Commentary <br/>
      <textarea name="cchat" rows="3" cols="69">
</textarea>   
      </p>


      <p class="center">
          <img class="Femme_Blanche"
     src="Femme_Blanche.jpg"
     alt="Femme_Blanche"/> <br/>
           Do you like this beach ?
<input type="radio" name="Femme_Blanche" value="Like" required/>Like
<input type="radio" name="Femme_Blanche" value="Dislike" required/>Dislike
      <br/> Commentary <br/>
      <textarea name="cblanche" rows="3" cols="69">
</textarea>   
      </p>

      <p class="center">
          <img class="hamburger"
     src="hamburger.jpg"
     alt="hamburger"/> <br/>
           Do you like this hamburger ?
<input type="radio" name="hamburger" value="Like" required/>Like
<input type="radio" name="hamburger" value="Dislike"required/>Dislike
      <br/> Commentary <br/>
      <textarea name="chamburger" rows="3" cols="69">
</textarea>   
      </p>

       <p class="center">
          <img class="voiture"
     src="voiture.jpg"
     alt="voiture"/> <br/>
           Do you like this car ?
<input type="radio" name="voiture" value="Like" required/>Like
<input type="radio" name="voiture" value="Dislike" required/>Dislike
      <br/> Commentary <br/>
      <textarea name="cvoiture" rows="3" cols="69">
</textarea>   
      </p>

      <p class="center">
          <img class="OM"
     src="OM.jpg"
     alt="OM"/> <br/>
           Do you like this team ?
<input type="radio" name="OM" value="Like" required/>Like
<input type="radio" name="OM" value="Dislike" required/>Dislike
      <br/> Commentary <br/>
      <textarea name="com" rows="3" cols="69">
</textarea> <br/><br/>
<input type="submit" value="Envoyer"/> <input type="reset" value="Annuler"/>  
      </p>

      </form>
  </body>
    
</html>