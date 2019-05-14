<?php
session_start();

require '../vendor/autoload.php';

require '../src/Achievements/Achievements.php';
require '../src/Achievements/AchievementsRepository.php';

require '../src/Achievements_participants/Achievements_participants.php';
require '../src/Achievements_participants/Achievements_participantsRepository.php';

require '../src/Duo/Duo.php';
require '../src/Duo/DuoRepository.php';

require '../src/Joueur/Joueur.php';
require '../src/Joueur/JoueurRepository.php';

require '../src/Matchs/Matchs.php';
require '../src/Matchs/MatchsRepository.php';

require '../src/Participants/Participants.php';
require '../src/Participants/ParticipantsRepository.php';

require '../src/Score/Score.php';
require '../src/Score/ScoreRepository.php';

require '../src/Tournoi/Tournoi.php';
require '../src/Tournoi/TournoiRepository.php';

require '../src/Utility.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$achievementsRepository = new Achievements\AchievementsRepository($connection);
$achievements = $achievementsRepository->fetchAll();

$participantsRepository = new Participants\ParticipantsRepository($connection);
$participants = $participantsRepository->fetchAll();

$joueurRepository = new Joueur\JoueurRepository($connection);
$joueurs = $joueurRepository->fetchAll();

$duoRepository = new Duo\DuoRepository($connection);
$duos = $duoRepository->fetchAll();

$classUtility = new Utility\Utility($connection);
$classementSolo = $classUtility->fetchClassementSolo();

function deconnect()
{

    echo "Déconnexion";
    session_destroy();
    
    echo '<script>location.href="connexion.php?verifReussi=2"</script>';
}

?>


<!--<script>
    function deco()
    {
        "<?php /*deconnect();*/?>";
    }
</script>-->


<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="index.css"> -->
</head>
<body>

<div class="container">
            <h1><a href="index.php">BabIIE-Foot</a></h1>

            <nav>
                <h3>
                <a href="classements.php">Classement général</a></br>
                <a href="tournoi.php">Tournois</a></br>
                <a href="modification.php">Rentrer un match</a></br>
                <a href="duos.php">Créer un duo</a></br>
                <a href="achievements.php">Liste des achievements</a></br>
                <a href="profil.php">Profil</a></br>
                <a href="connexion.php?verifReussi=2">Connexion/Inscription</a></br>
                </h3>
            </nav>

    <?php
    $verifReussi = $_GET["verifReussi"];
    if ($verifReussi==0)
    {
        echo "Mot de passe incorrect";
    }

    if(!isset($_SESSION['login']))
    {
        echo '</br><h3>Connexion :</h3>
            <form method="POST" action="index.php">
            <label for="identifiant">Identifiant : </label>
            <input type="text" size="20" maxlength="30" name="identifiant" id="identifiant"/>
            </br>
            <label for="mdp">Mot de passe : </label>
            <input type="password" size="20" maxlength="30" name="mdp" id="mdp"/>

            <input type="submit" value="Connexion">
        </form>';


        if ($verifReussi==1)
        {
            echo "Cet identifiant est déjà pris";
        }

        echo '
            </br><h3>Inscription :</h3>
            <form method="POST" action="index.php">
            <label for="idInsc">Identifiant : </label>
            <input type="text" size="20" maxlength="30" name="idInsc" id="idInsc"/>
            </br>
            <label for="prom">Promotion : </label>
            <input type="text" size="20" maxlength="30" name="prom" id="prom"/>
            </br>
            <label for="pwInsc">Mot de passe : </label>
            <input type="password" size="20" maxlength="30" name="pwInsc" id="pwInsc"/>

            <input type="submit" value="Inscription">
        </form>';
        //$req=INSERT INTO Joueur VALUES ('identifiant','Novice','Promotion','')
    }

    else
    {
        echo '<form method="post"> <input type="submit" name="test" id="test" value="Déconnexion" /><br/> </form>';

        if(array_key_exists('test',$_POST)){ deconnect(); }
        //echo "<input type='button' value='Déconnexion' onclick='deco()' ";
    }
    
?>



</div>
</body>
</html>
