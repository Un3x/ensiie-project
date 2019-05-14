<?php
session_start();
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$requser=$connection->prepare("SELECT * FROM interet WHERE id_personne = ?");
$requser->execute(array($id=intval($_GET['id'])));
$userexist=$requser->rowCount();

if($userexist == 0) {
    $id = intval($_GET['id']);
    $typeJeux = $_POST['typeJeux'];
    $sportIndividuel = $_POST['sportIndividuel'];
    $sportCollecif = $_POST['sportCollectif'];
    $categorieFilm = $_POST['categorieFilm'];
    $genreLitteraire = $_POST['genreLitteraire'];
    $genreMusical = $_POST['genreMusical'];
    $instrument = $_POST['instrument'];
    $religion = $_POST['religion'];
    $regimeAlimentaire = $_POST['regimeAlimentaire'];
    $alcool = $_POST['alcool'];
    $req = $connection->prepare('INSERT INTO Interet(id_personne,plateforme,type_jeu,sport_individuel,sport_collectif,categorie_film,genre_litteraire,genre_musical,instrument,religion,regime_alimentaire,alcool) VALUES(:id_personne,:plateforme,:type_jeu,:sport_individuel,:sport_collectif,:categorie_film,:genre_litteraire,:genre_musical,:instrument,:religion,:regime_alimentaire,:alcool)');
    $req->execute(array(
        'id_personne' => $id,
        'plateforme' => 'PC',
        'type_jeu' => $typeJeux,
        'sport_individuel' => $sportIndividuel,
        'sport_collectif' => $sportCollecif,
        'categorie_film' => $categorieFilm,
        'genre_litteraire' => $genreLitteraire,
        'genre_musical' => $genreMusical,
        'instrument' => $instrument,
        'religion' => $religion,
        'regime_alimentaire' => $regimeAlimentaire,
        'alcool' => $alcool
    ));
}

if(isset($_GET['id']) AND $_GET['id']>=0){
    $getid=intval($_GET['id']);
    $requser=$connection->prepare('SELECT * FROM membres WHERE id_personne =?');
    $requser->execute(array($getid));
    $userinfo=$requser->fetch();
    $requser2=$connection->prepare('SELECT * FROM membres NATURAL JOIN interet NATURAL JOIN Person NATURAL JOIN Sexe WHERE id_personne=?');
    $requser2->execute(array($getid));
    $userinfo2=$requser2->fetch();
}

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FRIIENDS</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="pagedebut.php">FRIIENDS</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Liste_membres.php">Inscrits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">A propos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/home-bg.png')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>FRIIENDS</h1>
                    <span class="subheading">Trouvez celle ou celui qui vous ressemble</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div align="center">
    <h2>Profil de <?php echo $userinfo2['pseudo']; ?> </h2>
    <br/><br/>
    <br/>
    Prénom:<?php echo $userinfo2['prenom'];?>
    <br/>
    Nom:<?php echo $userinfo2['nom'];?>
    <br/>
    Sexe : <?php echo $userinfo2['genre'];?>
    <br/>
    Age : <?php echo $userinfo2['age'];?>
    <br/>
    <br/>
    <?php
    if(isset($_SESSION['id']) AND $userinfo2['id']==$_SESSION['id'])
    {
    ?>

        Plateforme : <?php echo $userinfo2['plateforme'];?>
        <br/>
        Type de jeu : <?php echo $userinfo2['type_jeu'];?>
        <br/>
        Sport individuel: <?php echo $userinfo2['sport_individuel'];?>
        <br/>
        Sport Colletif : <?php echo $userinfo2['sport_collectif'];?>
        <br/>
        Catégorie de films : <?php echo $userinfo2['categorie_film'];?>
        <br/>
        Genre littéraire : <?php echo $userinfo2['genre_litteraire'];?>
        <br/>
        Genre Musical : <?php echo $userinfo2['genre_musical'];?>
        <br/>
        Instrument : <?php echo $userinfo2['instrument'];?>
        <br/>
        Religion: <?php echo $userinfo2['religion'];?>
        <br/>
        Régime Alimentaire : <?php echo $userinfo2['regime_alimentaire'];?>
        <br/>
        Alcool : <?php echo $userinfo2['alcool'];?>
        <br/>
        <a href="editionprofil.php">Editer mon profil </a>
        <br/>
        <a href="deconnexion.php">Se déconnecter</a>
        <br/>
        <a href="match.php?id=<?php echo $_GET['id']?>">Lancer mon match!</a>
        <?php
    }
    ?>

</div>
</body>
</html>
