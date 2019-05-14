<?php
session_start();
$_SESSION['adresse']="nathane/1.php";
if (!isset($_SESSION['authent']) || $_SESSION['authent']==0) header("Location: accueil.php");
?>

<!DOCTYPE html>


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
      <h1 id="citations">TCHOU-TCHOU</h1>
      <section class="center">
      <p>Pour expliquer cette merveilleuse citation:<br/>
      <strong>On modifie la vitesse grand V par une vitesse encore plus importante, celle du TGV</strong>.<br/>
    <img src='images2.jpeg' >
     <h3 id="citation1">J'avance à vitesse TGV</h3>
     </section>
</body>
</html>
      
      