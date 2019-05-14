<?php
session_start();
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
$classementTournoi = $classUtility->fetchClassementTournoi();

$matchsRepository = new Matchs\MatchsRepository($connection);
$matchs = $matchsRepository->fetchAll();

$tournoisRepository = new Tournoi\TournoiRepository($connection);
$tournois = $tournoisRepository->fetchAll();

$scoreRepository = new Score\ScoreRepository($connection);
$scores = $scoreRepository->fetchAll();
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
        var x = document.getElementsByName('tableClassement');
        var y = document.getElementsByName('tableMatchs');
        var i;
		if(tableType == "Classement"){
            for(i = 0; i < x.length; i++){
                x[i].style.display='table';
                y[i].style.display='none';
            }
		}
		else{
            for(i = 0; i < x.length; i++){
                x[i].style.display='none';
                y[i].style.display='table';
            }	
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


    <?php

    if (isset($_POST['tournoiInscr']) && $_POST['tournoiInscr']!='')
    {
        $tournoiInscr = $_POST['tournoiInscr'];

        $verifTournoi = 0;
        foreach ($tournois as $t)
        {
            if ($t->getNom()==$tournoiInscr)
            {
                $verifTournoi = 1;
                break;
            }
        }


        if ($verifTournoi==1)
        {
            $verifDoublon = 0;
            $nom = $_SESSION['login'];
            
            foreach ($scores as $s)
            {
                if ($s->getParticipant()==$nom && $s->getTournoi()==$tournoiInscr)
                {
                    $verifDoublon = 1;
                    break;
                }
            }


            if ($verifDoublon==0)
            {
                $req = "INSERT INTO Score(participant,tournoi,score) VALUES (?,?,?)";
                $tmp = $connection->prepare($req);
                $tmp->execute([$nom, $tournoiInscr, 1000]);
                //print_r($tmp->errorInfo());
                echo "L'inscription a bien été effectuée";

                $scores = $scoreRepository->fetchAll();
                $tournois = $tournoisRepository->fetchAll();
                $classementTournoi = $classUtility->fetchClassementTournoi();
            }

            else echo "Vous êtes déjà inscrit à ce tournoi.</br>";
        }

        else echo "Impossible de s'inscrire au tournoi $tournoiInscr car il n'existe pas.</br>";
    }


    if ( isset($_POST['tournoiSuppr']) && $_POST['tournoiSuppr']!='' )
    {
        $tournoiSuppr = $_POST['tournoiSuppr'];

        $req = "DELETE FROM Tournoi WHERE nom= :a";
        $tmp = $connection->prepare($req);
        $tmp->bindParam(':a', $tournoiSuppr, PDO::PARAM_STR);
        $tmp->execute();
        //print_r($tmp->errorInfo());
        $tournois = $tournoisRepository->fetchAll();

        echo "Le tournoi $tournoiSuppr a bien été suppprimé</br>";
    }


    if ( isset($_POST['tournoiCre']) && $_POST['tournoiCre']!='' )
    {
        $tournoiCre = $_POST['tournoiCre'];

        $req = "INSERT INTO Tournoi(nom,date_debut) VALUES (?,?)";
        $tmp = $connection->prepare($req);
        $date = date("m-d-Y");
        $tmp->execute([$tournoiCre, $date]);
        //print_r($tmp->errorInfo());
        
        /*foreach($participants as $p)
        {
            $nom = $p->getNom();
            if ($nom!='Admin')
            {
                $req = "INSERT INTO Score(participant,tournoi,score) VALUES (?,?,?)";
                $tmp = $connection->prepare($req);
                $tmp->execute([$nom, $tournoiCre, 1000]);
                //print_r($tmp->errorInfo());
            }
        }
        $scores = $scoreRepository->fetchAll();
        $tournois = $tournoisRepository->fetchAll();
        $classementTournoi = $classUtility->fetchClassementTournoi();*/

        echo "Le tournoi $tournoiCre a bien été ajouté</br>";
    }


    if ( isset($_SESSION['login']) && $_SESSION['login']=='Admin' )
    { ?>
        <form method="POST" action="tournoi.php">
            <label for="suppr">Supprimer un tournoi : </label>
            <input type="text" size="20" maxlength="30" name="tournoiSuppr" id="tournoiSuppr"/>
            <input type="submit" value="Supprimer">
            </br>
            <label for="suppr">Créer un tournoi : </label>
            <input type="text" size="20" maxlength="30" name="tournoiCre" id="tournoiCre"/>
            <input type="submit" value="Créer">
        </form>
    <?php
    }


    if (isset($_SESSION['login']))
    { ?>
        <form method="POST" action="tournoi.php">
            <label for="suppr">S'inscrire à un tournoi : </label>
            <input type="text" size="20" maxlength="30" name="tournoiInscr" id="tournoiInscr"/>
            <input type="submit" value="Inscription">
        </form>
    <?php
    }


    ?>

    

    <input type="button" value="Classement" onclick="clickAction('Classement')">
    <input type="button" value="Matchs" onclick="clickAction('Matchs')">


<!-- style="display:none" !-->
<!--
problem
1) getting elo from participant (matching problem)
2) arranging classement 
!-->
    <?php //$compteur = 0;
    foreach ($tournois as $t) :?>

        <h4><?php echo $t->getNom();?></h4>

        <!--<?php /*echo '<table class="table table-bordered table-hover table-striped" id="tableClassement';
              echo $count;
              echo '"style="display:none" >'; */?>-->

        <table class="table table-bordered table-hover table-striped" name="tableClassement"style="display:none" >
            <thead style="font-weight: bold">
                <td>Classement</td>
                <td>Nom</td>
                <td>Score</td>
            </thead>
            <?php 
            $count = 1;
            foreach ($classementTournoi as $s) : 
                if ($t->getNom()==$s->tournoi)
                {?>
                    <tr>
                        <td><?php echo $count?></td>
                        <td><?php echo $s->participant?></td>
                        <td><?php echo $s->score?></td>
                    </tr>
                    <?php $count++;
                }
                
            endforeach; ?>
        </table>
    	
    	<!-- <table class="table table-bordered table-hover table-striped" id="tableMatchs"style="display:none" > -->
    	<table class="table table-bordered table-hover table-striped" name="tableMatchs"  style="display:none">
            <thead style="font-weight: bold">
                <td>Équipe 1</td>
                <td>Score</td>
                <td>Équipe 2</td>
            </thead>
            <?php 
            foreach ($matchs as $m) :
                if ($t->getNom()==$m->getTournoi())
                {?>
                    <tr>
                    <td><?php echo $m->getParticipant1()?></td>
                    <td><?php echo $m->getScore1(); echo " - "; echo $m-> getScore2(); ?></td>
                    <td><?php echo $m->getParticipant2()?></td>
                    </tr><?php
                }
            endforeach; ?>
        </table>

    <?php endforeach;?>

</div>
</body>
</html>
