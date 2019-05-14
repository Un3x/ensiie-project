<?php
session_start();
$_SESSION['adresse'] = "resultatAime.php";
if (!isset($_SESSION['authent']) || $_SESSION['authent']==0) header("Location: accueil.php");

require '../../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$succeed=0;

$cplage = isset($_POST['cplage']) ? $_POST['cplage'] : NULL;
$cmetisse = isset($_POST['cmetisse']) ? $_POST['cmetisse'] : NULL;
$cchocolat = isset($_POST['cchocolat']) ? $_POST['cchocolat'] : NULL;
$cvans = isset($_POST['cvans']) ? $_POST['cvans'] : NULL;
$ccocktail = isset($_POST['ccocktail']) ? $_POST['ccocktail'] : NULL;
$cchat = isset($_POST['cchat']) ? $_POST['cchat'] : NULL;
$cblanche = isset($_POST['cblanche']) ? $_POST['cblanche'] : NULL;
$chamburger = isset($_POST['chamburger']) ? $_POST['chamburger'] : NULL;
$cvoiture = isset($_POST['cvoiture']) ? $_POST['cvoiture'] : NULL;
$com = isset($_POST['com']) ? $_POST['com'] : NULL;


$already_in = 0;
$requete=$connection->query('SELECT pseudo FROM aime_commentaires');
while ($donnees = $requete->fetch()) {
    if ($donnees['pseudo']==$_SESSION['pseudo']) {
        $already_in = 1;
        $requete2 = $connection->prepare('UPDATE aime_commentaires 
        SET plage=:plage, metisse=:metisse, chocolat=:chocolat, vans=:vans, cocktail=:cocktail, chat=:chat,
        blanche=:blanche, hamburger=:hamburger, voiture=:voiture, om=:om WHERE pseudo=:pseudo;');
        $requete2->execute(array(
        'pseudo' => $_SESSION['pseudo'],
        'plage' => $cplage,
        'metisse' => $cmetisse,
        'chocolat' => $cchocolat,
        'vans' => $cvans,
        'cocktail' => $ccocktail,
        'chat' => $cchat,
        'blanche' => $cblanche,
        'hamburger' => $chamburger,
        'voiture' => $cvoiture,
        'om' => $com
        ));
    }
}

if ($already_in==0) {
$requete3 = $connection->prepare('INSERT INTO aime_commentaires (pseudo,plage,metisse,chocolat,vans,cocktail,chat,blanche,hamburger,voiture,om) 
VALUES (:pseudo, :plage, :metisse, :chocolat, :vans, :cocktail, :chat,
        :blanche, :hamburger, :voiture, :om);');
$requete3->execute(array(
  'pseudo' => $_SESSION['pseudo'],
  'plage' => $cplage,
  'metisse' => $cmetisse,
  'chocolat' => $cchocolat,
  'vans' => $cvans,
  'cocktail' => $ccocktail,
  'chat' => $cchat,
  'blanche' => $cblanche,
  'hamburger' => $chamburger,
  'voiture' => $cvoiture,
  'om' => $com
));
}

if ($_POST['plage']=="Dislike" && $_POST['femme_metisse']=="Like" &&
    $_POST['chocolat']=="Dislike" && $_POST['Vans']=="Dislike" &&
    $_POST['coktail']=="Like" && $_POST['chat']=="Like" &&
    $_POST['Femme_Blanche']=="Dislike" && $_POST['hamburger']=="Like" &&
    $_POST['voiture']=="Dislike" && $_POST['OM']=="Like") $succeed=1;
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
    <li class=\"right\"><a href=\"../deconnexion.php\">Déconnexion</a></li></ul>";
}
?>
</nav>

<body>
<?php if ($succeed==1) { ?>
<h1 class="aime">Vous avez réussi l'épreuve d'Aimé, vous pouvez donc continuer vers la suite !</h1>
<form action="../finalPage.php" class="center">
<button type="submit">Étape suivante</button>
</form><br/>
<?php } 
else { ?>
<h1 class="aime"><h3>Merci d'avoir participé, malheuresement vous n'avez pas réussi l'épreuve</h1>
<?php } ?>

</body>
</html>