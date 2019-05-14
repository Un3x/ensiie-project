<?php

//session_start(); if(isset($_SESSION['login'])) { echo "Your session is running " . $_SESSION['login']; }

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
$classementDuo = $classUtility->fetchClassementDuo();
?>


<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="index.css"> -->
</head>
<body>

<script>
    function clickAction(tableType){
		if(tableType == "Solo"){
			document.getElementById('tableSolo').style.display='table';
			document.getElementById('tableDuo').style.display='none';
		}
		else{
			document.getElementById('tableDuo').style.display='table';
			document.getElementById('tableSolo').style.display='none';			
		}
    }
</script>

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

    <input type="button" value="Solo" onclick="clickAction('Solo')">
    <input type="button" value="Duo" onclick="clickAction('Duo')">


<!-- style="display:none" !-->
<!--
problem
1) getting elo from participant (matching problem)
2) arranging classement 
!-->

    <table class="table table-bordered table-hover table-striped" id="tableSolo"style="display:none" >
        <thead style="font-weight: bold">
            <td>Classement</td>
            <td>Nom</td>
            <td>Elo</td>
        </thead>
        <?php 
        $count = 1;
        foreach ($classementSolo as $cs) : ?>
            <tr>
                <td><?php echo $count?></td>
                <td><?php echo $cs->nom?></td>
                <td><?php echo $cs->elo?></td>
            </tr>
        <?php 
        $count++;
        endforeach; ?>
    </table>
	
	
	<table class="table table-bordered table-hover table-striped" id="tableDuo"style="display:none" >
        <thead style="font-weight: bold">
            <td>Classement</td>
            <td>Equipe</td>
			<td>Joueur 1</td>
			<td>Joueur 2</td>
            <td>Elo</td>
        </thead>
        <?php 
        $count = 1;
        foreach ($classementDuo as $cd) : ?>
            <tr>
                <td><?php echo $count?></td>
                <td><?php echo $cd->nom?></td>
                <td><?php echo $cd->joueur1?></td>
				<td><?php echo $cd->joueur2?></td>
                <td><?php echo $cd->elo?></td>
            </tr>
        <?php 
        $count++;
        endforeach; ?>
    </table>

</div>
</body>
</html>
