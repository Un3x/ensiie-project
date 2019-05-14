<?php
session_start();
$_SESSION['adresse']="nathane/2.php";
if (!isset($_SESSION['authent']) || $_SESSION['authent']==0) header("Location: accueil.php");
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
  <li><a href=\"gain.php\">Nathane</a></li>
  <li><a href=\"../aime/comment.php\">Aimé</a></li>
  <li class=\"right\"><a href=\"../deconnexion.php\">Déconnexion</a></li>
  </ul>";
}
else {
  echo "
  <ul class=\"topnav\">
  <li><a href=\"../accueil.php\">Home</a></li>
  <li><a href=\"../profil.php\">Profil</a></li>
  <li><a href=\"../rn_tmp.php\">Rejoins-nous</a></li>
  <li class=\"right\"><a href=\"../deconnexion.php\">Déconnexion</a></li></ul>";
}
?>
</nav>

            <body>
            <h1 id="citations">Grondement</h1>
            <section class="center">
            <p>Pour expliquer cette merveilleuse citation:<br/>
      <strong>On n'essaye pas d'acheter un ours encore en vie cela peut être très dangereux.
      </strong>.<br/>
      <img src='ours.jpg' width=400 heigt=400>
      <img src='piece.jpeg' >
      <h3 id="citation1">Il ne faut pa acheter la peau d'un ours avant de l'avoir tuer TGV</h3>                                              
</section>                                                       
</body>                                                                                          
</html>   