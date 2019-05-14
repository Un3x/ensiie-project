<?php
session_start();
$_SESSION['adresse'] = "blindtest.php";
if (!isset($_SESSION['authent']) || $_SESSION['authent']==0 || !isset($_POST['Q1'])) header("Location: accueil.php");
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

<style>
body,h1 {
  font-family: "Raleway", sans-serif
}
body, html {height: 100%}
.bgimage {
  background-image: url("artistbg.PNG");
  min-height: 100%;
  background-position: center;
  background-size: cover;
}

.display-container{position:relative}

.text-white{color:#fff!important}


.display-middle{position:absolute;top:47%;left:50%;transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%)}
.display-text{positition: absolute; top: 60%; left:30%}
.jumbo{
  font-size:64px!important; 
  color: white; 
}

.border-grey{border-color:#9e9e9e!important}

.large{font-size:20px!important}
.center{text-align:center!important}

input[type=submit].next {
  width: 100%;
  background-color: midnightblue;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.display-next{
  position:absolute;top:95%;left:75%;
}

.display-quit{
  position:absolute;top:95%;left:75%;
}

</style>


<?php

$point=0;

if ($_POST['Q1']=='R2') $point++;
if ($_POST['Q2']=='R2') $point++;
if ($_POST['Q3']=='R3') $point++;
if ($_POST['Q4']=='R4') $point++;
if ($_POST['Q5']=='R1') $point++;
if ($_POST['Q6']=='R4') $point++;
if ($_POST['Q7']=='R1') $point++;
if ($_POST['Q8']=='R2') $point++;
if ($_POST['Q9']=='R4') $point++;
if ($_POST['Q10']=='R1') $point++;



if ($point>6)  {
   
    echo "
    <div class=\"bgimage display-container text-white\">
      <div class=\"display-middle\">
        <h1 class=\"jumbo\">Félicitations </h1>
        <hr class=\"border-grey\" style=\"margin:auto;width:40%\">
        <p class=\"large center\"> Tu as trouvé $point bonnes réponses !</p> 
        <p > Clique sur Suivant pour accéder à la dernière étape. </p> 
        <form action=finalPage.php class=\"display-next\">
        <input type=\"submit\" value=\"Suivant\" class=\"next\"/>
      </form>
      </div>
      
  </div> ";
  
}

else{
    echo "
    <div class=\"bgimage display-container text-white\">
      <div class=\"display-middle\">
        <h1 class=\"jumbo\"> Dommage... </h1>
        <hr class=\"border-grey\" style=\"margin:auto;width:40%\">
        <p class=\"large center\"> Tu n'as trouvé que $point bonnes réponses.</p> 
        <p class=\" center\"> Ce n'est pas suffisant pour intégrer la Meute.</p> 
       
        <form action=accueil.php class=\"display-quit\">
        <input type=\"submit\" value=\"Abandonner\" class=\"next\"/>
      </form>
       
       
       
        </div>
        
        
        
      
      
  </div>
   
";
}


?>

</html>