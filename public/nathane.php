<?php
session_start();
$_SESSION['adresse'] = "nathane.php";
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

<script>
function variable(url)
{
    window.location=url;
}
function hasardlivre()
{
    var a;
           a = 1+Math.round(Math.random()*11);
           if (a==1)
               variable("nathane/1.php");
           if (a==2)
               variable("nathane/2.php");
           if (a==3)
               variable("nathane/3.php");
           if (a==4)
               variable("nathane/4.php");
           if (a==5)
               variable("nathane/5.php");
           if (a==6)
               variable("nathane/6.php");
           if (a==7)
               variable("nathane/7.php");
           if (a==8)
               variable("nathane/8.php");
           if (a==9)
               variable("nathane/9.php");
           if (a==10)
               variable("nathane/10.php");
           if (a==11)
               variable("nathane/gain.php");
       }
</script>

<body>   
<h1> Bienvenue sur la page personnel de Nathane le chef de La Meute </h1>
<p> Pour nous rejoindre rien de plus simple, il faut être tout aussi joueur que moi, cliquez sur la case chance et vous aurez une chance sur dix de nous rejoindre, dans les neufs autres cas vous ne repartirez pas bredouille puisqu'une citations tout droit dema tête vous serez présentée.</p>



<p class="center"><a onClick="hasardlivre()" href="#"><img width="240" height="120" title="découvre une citation au hasard"  alt="plateau_monopoly" src="nathane/chance.jpg"/><script type="text/javascript" src="ici l'adresse de mon fichier js externe"></script></p>



</body>

</html>

