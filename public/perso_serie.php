<?php
session_start();
$_SESSION['adresse'] = "perso_serie.php";
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

<body>
<br/>

<?php
$B=0; $H=0; $L=0; $A=0; $C=0; $S=0;

if ($_POST['Q1']=='B') $B++;
if ($_POST['Q1']=='H') $H++;
if ($_POST['Q1']=='L') $L++;
if ($_POST['Q1']=='A') $A++;
if ($_POST['Q1']=='C') $C++;
if ($_POST['Q1']=='S') $S++;

if ($_POST['Q2']=='B') $B++;
if ($_POST['Q2']=='H') $H++;
if ($_POST['Q2']=='L') $L++;
if ($_POST['Q2']=='A') $A++;
if ($_POST['Q2']=='C') $C++;
if ($_POST['Q2']=='S') $S++;

if ($_POST['Q3']=='B') $B++;
if ($_POST['Q3']=='H') $H++;
if ($_POST['Q3']=='L') $L++;
if ($_POST['Q3']=='A') $A++;
if ($_POST['Q3']=='C') $C++;
if ($_POST['Q3']=='S') $S++;

if ($_POST['Q4']=='B') $B++;
if ($_POST['Q4']=='H') $H++;
if ($_POST['Q4']=='L') $L++;
if ($_POST['Q4']=='A') $A++;
if ($_POST['Q4']=='C') $C++;
if ($_POST['Q4']=='S') $S++;

if ($_POST['Q5']=='B') $B++;
if ($_POST['Q5']=='H') $H++;
if ($_POST['Q5']=='L') $L++;
if ($_POST['Q5']=='A') $A++;
if ($_POST['Q5']=='C') $C++;
if ($_POST['Q5']=='S') $S++;

if ($_POST['Q6']=='B') $B++;
if ($_POST['Q6']=='H') $H++;
if ($_POST['Q6']=='L') $L++;
if ($_POST['Q6']=='A') $A++;
if ($_POST['Q6']=='C') $C++;
if ($_POST['Q6']=='S') $S++;

if ($_POST['Q7']=='B') $B++;
if ($_POST['Q7']=='H') $H++;
if ($_POST['Q7']=='L') $L++;
if ($_POST['Q7']=='A') $A++;
if ($_POST['Q7']=='C') $C++;
if ($_POST['Q7']=='S') $S++;

if ($_POST['Q8']=='B') $B++;
if ($_POST['Q8']=='H') $H++;
if ($_POST['Q8']=='L') $L++;
if ($_POST['Q8']=='A') $A++;
if ($_POST['Q8']=='C') $C++;
if ($_POST['Q8']=='S') $S++;

$max = max($B,$H,$L,$A,$C,$S);

if ($B==$max) {
    echo "<div class=\"center\"><img src=\"louis/barney_stinson.jpg\" alt=\"Barney Stinson\" height=\"350\" width=\"400\"/></div>";
    echo "<br/><h2 class=\"center\">Barney Stinson</h2>
    <h3 class=\"center\">How I met your mother</h3>
    <p class=\"center\">Grand dragueur et homme de goût, tu es prêt à tout pour obtenir ce que tu veux.</p><br/>"; 
}
if ($L==$max) {
    echo "<div class=\"center\"><img src=\"louis/lydia_martin.jpg\" alt=\"Lydia Martin\" height=\"350\" width=\"400\"/></div>";
    echo "</br><h2 class=\"center\">Lydia Martin</h2>
    <h3 class=\"center\">Teen Wolf</h3>
    <p class=\"center\">Séduisante et vive d'esprit, tu n'as pas froid aux yeux et ne rechignes jamais à faire la fête.</p><br/>";
}
if ($A==$max) {
    echo "<div class=\"center\"><img src=\"louis/alan_harper.jpg\" alt=\"Alan Harper\" height=\"450\" width=\"350\"/></div>";
    echo "<br/><h2 class=\"center\">Alan Harper</h2>
    <h3 class=\"center\">Two and a Half Men</h3>
    <p class=\"center\">Incapable de gérer ta vie, tu sautes sur la première occasion de profiter de quelqu'un.</p><br/>";
}
if ($C==$max) {
    echo "<div class=\"center\"><img src=\"louis/cassidy.jpg\" alt=\"Cassidy Proinsias\" class=\"center\" height=\"350\" width=\"450\"/></div>";
    echo "<br/><h2 class=\"center\">Cassidy Proinsias</h2>
    <h3 class=\"center\">The Preacher</h3>
    <p class=\"center\">Excentrique et plein d'humour, tu n'aimes pas voir le fond de la bouteille et es prêt à tout pour tes amis.</p><br/>";
}
if ($S==$max) {
    echo "<div class=\"center\"><img src=\"louis/sakura_haruno.jpg\" alt=\"Sakura Haruno\" height=\"400\" width=\"350\"/></div>";
    echo "<br/><h2 class=\"center\">Sakura Haruno</h2>
    <h3 class=\"center\">Naruto</h3>
    <p class=\"center\">Peu utile et invisible, tu ne te fais remarquer que par tes larmes qui ne cessent de couler.</p><br/>";
}
if ($H==$max) {
    echo "<div class=\"center\"><img src=\"louis/hannibal_lecter.jpg\" alt=\"Hannibal Lecter\" height=\"350\" width=\"400\"/></div>";
    echo "</br><h2 class=\"center\">Hannibal Lecter</h2>
    <h3 class=\"center\">Hannibal</h3>
    <p class=\"center\">Esprit clairvoyant et manipulateur, tu es un grand amateur de cuisine raffinée.</p><br/>";
}
if ($H==$max && $S!=$max && $A!=$max && $B!=$max && $C!=$max && $L!=$max) {
    echo "<h2 class=\"center\">Congratulations you passed</h2>
    <form action=\"finalPage.php\" class=\"center\">
    <button type=\"submit\">Étape suivante</button>
    </form><br/>";
}
else echo "<h2 class=\"center\">You failed this test !</h2>";

?>

</body>
</html>