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

if(isset($_SESSION['id']))
{
    $requser = $connection->prepare("SELECT * FROM membres WHERE id_personne = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if(isset($_POST['newplateforme'])){
        $insertplateforme = $connection->prepare("UPDATE interet SET plateforme = ? WHERE id_personne = ?");
        $insertplateforme->execute(array($_POST['newplateforme'],$_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newtypeJeux'])) {
        $insertTypeJeu = $connection->prepare("UPDATE interet SET type_jeu = ? WHERE id_personne = ?");
        $insertTypeJeu->execute(array($_POST['newtypeJeux'], $_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newsportIndividuel'])) {
        $insertSportIndividuel = $connection->prepare("UPDATE interet SET Individuel = ? WHERE id_personne = ?");
        $insertSportIndividuel->execute(array($_POST['newsportIndividuel'], $_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newsportCollectif'])) {
        $insertSportCo = $connection->prepare("UPDATE interet SET Collectif = ? WHERE id_personne = ?");
        $insertSportCo->execute(array($_POST['newsportCollectif'], $_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newcategorieFilm'])) {
        $insertfilm = $connection->prepare("UPDATE interet SET categorieFilm = ? WHERE id_personne = ?");
        $insertfilm->execute(array($_POST['newcategorieFilm'], $_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newgenreLitteraire'])) {
        $insertlivre = $connection->prepare("UPDATE interet SET genreLitteraire = ? WHERE id_personne = ?");
        $insertlivre->execute(array($_POST['newgenreLitteraire'], $_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newgenreMusical'])) {
        $insertmusique = $connection->prepare("UPDATE interet SET genreMusical = ? WHERE id_personne = ?");
        $insertmusique->execute(array($_POST['newgenreMusical'], $_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newinstrument'])) {
        $insertinstru = $connection->prepare("UPDATE interet SET Instrument = ? WHERE id_personne = ?");
        $insertinstru->execute(array($_POST['newinstrument'], $_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newreligion'])) {
        $insertreligion = $connection->prepare("UPDATE interet SET Religion = ? WHERE id_personne = ?");
        $insertreligion->execute(array($_POST['newreligion'], $_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newregimeAlimentaire'])) {
        $insertmanger = $connection->prepare("UPDATE interet SET regimeAlimentaire = ? WHERE id_personne = ?");
        $insertmanger->execute(array($_POST['newregimeAlimentaire'], $_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newalcool'])) {
        $insertalcool = $connection->prepare("UPDATE interet SET Alcool = ? WHERE id_personne = ?");
        $insertalcool->execute(array($_POST['newalcool'], $_SESSION['id']));
        header("Location:profil.php?id=".$_SESSION['id']);
    }


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
    <form name="formulaire2" method="POST" action="">
        <fieldset>
            <legend>intérêts</legend>

            <label for="newplateforme"> Plateforme préférée </label>
            <i class="fas fa-desktop"></i>
            <input type="radio" name="newplateforme" value ="PC"/>
            <i class="fas fa-gamepad"></i>
            <input type="radio" name="newplateforme" value="console"/>
            <i class="fas fa-mobile-alt"></i>
            <input type="radio" name="newplateforme" value="mobile"/>
            <i class="fas fa-times"></i>
            <input type="radio" name="newplateforme" value="aucunePlateforme"/>
            <br/><br/>

            <label for="newtypeJeux"> Type de jeux</label>
            <select name="newtypeJeux" id="typeJeux">
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


            <label for="newsportIndividuel"> Sport individuel </label>
            <select name="newsportIndividuel" id="sportIndividuel">
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

            <label for="newsportCollectif">Sport collectif</label>
            <select name="newsportCollectif" id="sportCollectif">
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

            <label for="newcategorieFilm"> Catégorie de films </label>
            <select name="newcategorieFilm" id="categorieFilm">
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

            <label for="newgenreLitteraire"> Genre littéraire </label>
            <select name="newgenreLitteraire" id="genreLitteraire">
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

            <label for="newgenreMusical"> Genre musical </label>
            <select name="newgenreMusical" id="genreMusical">
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

            <label for="newinstrument"> Instrument </label>
            <select name="newinstrument" id="instrument">
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

            <label for="newreligion"> Religion </label>
            <select name="newreligion" id="religion">
                <option value="catholique"> Catholique </option>
                <option value="protestant"> Protestant </option>
                <option value="musulman"> Musulman </option>
                <option value="juif"> Juif </option>
                <option value="hindouiste"> Hindouiste </option>
                <option value="athee"> Athée </option>
                <option value="agnostique"> Agnostique </option>
                <option value="autreReligion"> Autre </option>
            </select><br/><br/>

            <label for="newregimeAlimentaire"> Régime Alimentaire </label>
            <select name="newregimeAlimentaire" id="regimeAlimentaire">
                <option value="hallal"> Hallal </option>
                <option value="kasher"> Kasher </option>
                <option value="sansGluten"> Sans Gluten </option>
                <option value="vegetarien"> Vegetarien </option>
                <option value="vegan"> Vegan </option>
                <option value="carnivore"> Carnivore </option>
                <option value="autreRegime"> Autre </option>
                <option value="aucunRegime"> Aucun régime particulier</option>
            </select><br/><br/>

            <label for="newalcool"> Alcool préféré </label>
            <select name="newalcool" id="alcool">
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
    </body>

<?php
}
else {
    header("Location:connexion.php");
}
?>