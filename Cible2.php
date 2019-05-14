<?php
session_start();
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$id=intval($_GET['id']);
$_SESSION['id']=$id;

?>

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
                    <a class="nav-link" href="pagedebut.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Liste_membres.php">Inscrits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">À propos</a>
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
<form name="formulaire2" method="post" action="<?php echo "/profil.php?id=".$_SESSION['id'] ?>"
    <fieldset>
        <legend>intérêts</legend>

        <label for="plateforme"> Plateforme préférée </label>
        <i class="fas fa-desktop"></i>
        <input type="radio" name="plateforme" value ="PC"/>
        <i class="fas fa-gamepad"></i>
        <input type="radio" name="plateforme" value="console"/>
        <i class="fas fa-mobile-alt"></i>
        <input type="radio" name="plateforme" value="mobile"/>
        <i class="fas fa-times"></i>
        <input type="radio" name="plateforme" value="aucunePlateforme"/>
        <br/><br/>

        <label for="typeJeux"> Type de jeux</label>
        <select name="typeJeux" id="typeJeux">
            <option value="moba"> Moba </option>
            <option value="fps"> FPS </option>
            <option value="aventure"> Aventure </option>
            <option value="course"> Course </option>
            <option value="plate-forme"> Plate-Forme </option>
            <option value="independant"> Independant </option>
            <option value="mmorpg"> MMORPG </option>
            <option value="rpg"> RPG </option>
            <option value="gestion-wargames"> Gestion-Wargames </option>
            <option value="autreJeux"> Autre </option>
            <option value="aucunJeux"> Je ne joue pas aux jeux videos </option>
            <i class="fas fa-arrow-down"></i>
        </select><br/><br/>

        <label for="sportIndividuel"> Sport individuel </label>
        <select name="sportIndividuel" id="sportIndividuel">
            <option value="natation"> Natation </option>
            <option value="athlétisme"> Athlétisme </option>
            <option value="escrime"> Escrime </option>
            <option value="tennis"> Tennis </option>
            <option value="tennisDeTable"> Tennis de table </option>
            <option value="sportDeCombat"> Sport de combats </option>
            <option value="gymnastique"> Gymnastique </option>
            <option value="autreIndividuel"> Autre </option>
            <option value="aucuneIndividuel"> Je ne pratique pas de sport individuel </option>
        </select><br/><br/>

        <label for="sportCollectif">Sport collectif</label>
        <select name="sportCollectif" id="sportCollectif">
            <option value="football"> Football </option>
            <option value="basketball"> basketball </option>
            <option value="handball"> Handball </option>
            <option value="volley"> Volley </option>
            <option value="hockey"> Hockey </option>
            <option value="baseball"> Baseball</option>
            <option value="waterpolo"> Waterpolo </option>
            <option value="rugby"> Rugby </option>
            <option value="autreCollectif"> Autre </option>
            <option value="aucunCollectif"> Je ne pratique pas de sport collectif </option>
        </select><br/><br/>

        <label for="categorieFilm"> Catégorie de films </label>
        <select name="categorieFilm" id="categorieFilm">
            <option value="anime"> Anime </option>
            <option value="thriller"> Thriller </option>
            <option value="action"> Action </option>
            <option value="horreur"> Horreur </option>
            <option value="dessinAnime"> Dessin-Animé </option>
            <option value="romantique"> Romantique</option>
            <option value="policier"> Policier </option>
            <option value="western"> Western </option>
            <option value="autreFilm"> Autre </option>
            <option value="aucunePlateforme"> Aucune </option>
        </select><br/><br/>

        <!--Réalisateur: <input type="text" name="realisateur" placeholder="George Lucas"/><br/>
        Acteur: <input type="text" name="acteur" placeholder="Jason Statham"/><br/><br/>-->

        <label for="genreLitteraire"> Genre littéraire </label>
        <select name="genreLitteraire" id="genreLitteraire">
            <option value="thriller"> Thriller </option>
            <option value="policier"> Policier </option>
            <option value="epouvante"> Epouvante </option>
            <option value="historique"> Historique </option>
            <option value="fantastique"> Fantastique </option>
            <option value="bd"> BD </option>
            <option value="manga"> Manga </option>
            <option value="autreLitteraire"> Autre </option>
            <option value="aucunLitteraire"> Je ne lis pas </option>
        </select><br/><br/>

        <label for="genreMusical"> Genre musical </label>
        <select name="genreMusical" id="genreMusical">
            <option value="classique"> Classique </option>
            <option value="hipHop"> Hip Hop </option>
            <option value="rap"> Rap </option>
            <option value="rock"> Rock </option>
            <option value="jazz"> Jazz </option>
            <option value="metal"> Metal </option>
            <option value="trap"> Trap </option>
            <option value="house"> House </option>
            <option value="techno"> Techno </option>
            <option value="electro"> Electro </option>
            <option value="trance"> Trance </option>
            <option value="psyTrance"> Psytrance </option>
            <option value="drumAndBass"> Drum and Bass </option>
            <option value="autreMusique"> Autre </option>
            <option value="aucuneMusique"> Je n'écoute pas de musique </option>
        </select><br/><br/>

        <label for="instrument"> Instrument </label>
        <select name="instrument" id="instrument">
            <option value="guitare"> Guitare </option>
            <option value="piano"> Piano </option>
            <option value="trompette"> Trompette </option>
            <option value="saxophone"> Saxophone </option>
            <option value="violon"> Violon </option>
            <option value="violoncelle"> Violoncelle </option>
            <option value="basse"> Basse </option>
            <option value="batterie"> Batterie </option>
            <option value="flute"> Flûte </option>
            <option value="guitareElectrique"> Guitare électrique </option>
            <option value="autreInstrument"> Autre </option>
            <option value="aucunInstrument"> Je ne joue pas d'instrument </option>
        </select><br/><br/>

        <label for="religion"> Religion </label>
        <select name="religion" id="religion">
            <option value="catholique"> Catholique </option>
            <option value="protestant"> Protestant </option>
            <option value="musulman"> Musulman </option>
            <option value="juif"> Juif </option>
            <option value="hindouiste"> Hindouiste </option>
            <option value="athee"> Athée </option>
            <option value="agnostique"> Agnostique </option>
            <option value="autreReligion"> Autre </option>
        </select><br/><br/>

        <label for="regimeAlimentaire"> Régime Alimentaire </label>
        <select name="regimeAlimentaire" id="regimeAlimentaire">
            <option value="hallal"> Hallal </option>
            <option value="kasher"> Kasher </option>
            <option value="sansGluten"> Sans Gluten </option>
            <option value="vegetarien"> Vegetarien </option>
            <option value="vegan"> Vegan </option>
            <option value="carnivore"> Carnivore </option>
            <option value="autreRegime"> Autre </option>
            <option value="aucunRegime"> Aucun régime particulier</option>
        </select><br/><br/>

        <label for="alcool"> Alcool préféré </label>
        <select name="alcool" id="alcool">
            <option value="biere"> Bière </option>
            <option value="whisky"> Whisky </option>
            <option value="cidre"> Cidre </option>
            <option value="vodka"> Vodka </option>
            <option value="tequila"> Tequila </option>
            <option value="rhum"> Rhum </option>
            <option value="jaeger"> Jaeger </option>
            <option value="gin"> Gin </option>
            <option value="get27"> Get27 </option>
            <option value="pastis"> Pastis </option>
            <option value="vin"> Vin </option>
            <option value="autreAlcool"> Autre </option>
            <option value="aucunAlcool"> Je ne bois pas d'alcool </option>
        </select><br/><br/>
    </fieldset>
    <input type="submit" name="valider" value="Valider"/>
</form>
</div>
</body>

