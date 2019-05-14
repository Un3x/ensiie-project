<?php
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

?>


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


<!-- style="display:none" !-->
<!--
problem
1) getting elo from participant (matching problem)
2) arranging classement 
!-->

    <table class="table table-bordered table-hover table-striped" id="tableAchievements">
        <thead style="font-weight: bold">
            <td>Nom</td>
            <td>Signification</td>
        </thead>
        <?php 
        foreach ($achievements as $a) : ?>
            <tr>
                <td><?php echo $a->getNom()?></td>
                <td><?php echo $a->getSignification()?></td>
            </tr>
        <?php 
        endforeach; ?>
    </table>

</div>
</body>
</html>
