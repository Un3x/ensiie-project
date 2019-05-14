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

        $entree = 0;

        if( isset($_POST['tournoi']) && isset($_POST['equipe1']) && isset($_POST['score1']) && isset($_POST['equipe2']) && isset($_POST['score2']) )
        {
            $tournoi = $_POST['tournoi'];
            $equipe1 = $_POST['equipe1'];
            $score1 = $_POST['score1'];
            $equipe2 = $_POST['equipe2'];
            $score2 = $_POST['score2'];

            $verifScore = 0;
            foreach ($scores as $s)
            {
                if ($s->getParticipant()==$equipe1 && $s->getTournoi()==$tournoi) $verifScore++;
                if ($s->getParticipant()==$equipe2 && $s->getTournoi()==$tournoi) $verifScore++;
                if ($verifScore==2) break;
            }


            if ($verifScore==2)
            {
                $verifTou = 0;
                $verifDif = 0;
                $verif1 = 0;
                $verif2 = 0;

                foreach ($tournois as $t)
                {
                    if ($t->getNom() == $tournoi)
                    {
                        $verifTou = 1;
                        break;
                    }
                }

                if ($verifTou==1)
                {

                    if ($equipe1!=$equipe2) $verifDif = 1;

                    if ($verifDif==1)
                    {
                        foreach($participants as $p)
                        {
                            if($p->getNom() == $equipe1) $verif1 = 1;

                            if($p->getNom() == $equipe2) $verif2 = 1;

                            if($verif1==1 && $verif2==1) break;
                        }

                        if($verif1==0) echo "L'équipe 1 n'est pas valide </br>";
                        if($verif2==0) echo "L'équipe 2 n'est pas valide </br>";

                        if($verif1==1 && $verif2==1)
                        {
                            $requete = "INSERT INTO Matchs(score1, score2, participant1, participant2, tournoi)
                                        VALUES (?,?,?,?,?)" ;
                            $connection->prepare($requete)->execute([$score1, $score2, $equipe1, $equipe2, $tournoi]);




                            //update_elo($equipe1, $equipe2, $score1, $score2,$participants,$connection);



                            function calcul($elo1 , $elo2, $score1, $score2,$K)
                            {
                                $p=1/(1+10**(($elo1-$elo2)/400));
                                if ($score2>=$score1) return $K*$p;
                                else return $K*(1-$p);
                            }



                            //Changement elo classement général
                            $joueur1;
                            $joueur2;

                            foreach($participants as $p)
                            {
                                if ($equipe1==$p->getNom()) $joueur1=$p;
                                elseif ($equipe2==$p->getNom()) $joueur2=$p;
                            }

                            $elo1 = $joueur1->getElo();
                            $elo2 = $joueur2->getElo();
                            $delta = calcul($elo1,$elo2,$score1,$score2,30);

                            $req1 = "UPDATE Participants SET elo= :a WHERE nom= :b";
                            $tmp = $connection->prepare($req1);
                            $elobis = floor($elo1+$delta);
                            $tmp->bindParam(':a', $elobis, PDO::PARAM_STR);
                            $tmp->bindParam(':b', $equipe1, PDO::PARAM_STR);
                            $tmp->execute();
                            //print_r($tmp->errorInfo());
                            echo "nouveau elo général de $equipe1 : $elobis</br>";

                            $req2 = "UPDATE Participants SET elo= :a WHERE nom= :b";
                            $tmp = $connection->prepare($req1);
                            $elobis = floor($elo2-$delta);
                            $tmp->bindParam(':a', $elobis, PDO::PARAM_STR);
                            $tmp->bindParam(':b', $equipe2, PDO::PARAM_STR);
                            $tmp->execute();
                            //print_r($tmp->errorInfo());
                            echo "nouveau elo général de $equipe2 : $elobis</br>";



                            //Changement elo tournoi
                            $j1;
                            $j2;

                            foreach ($scores as $s)
                            {
                                if ($s->getParticipant()==$equipe1 && $s->getTournoi()==$tournoi) $j1=$s;
                                elseif ($s->getParticipant()==$equipe2 && $s->getTournoi()==$tournoi) $j2=$s;
                            }

                            $elo1 = $j1->getScore();
                            $elo2 = $j2->getScore();
                            $delta = calcul($elo1,$elo2,$score1,$score2,30);

                            $req3 = "UPDATE Score SET score= :a WHERE participant= :b AND tournoi= :c";
                            $tmp = $connection->prepare($req3);
                            $elobis = floor($elo1+$delta);
                            $tmp->bindParam(':a', $elobis, PDO::PARAM_STR);
                            $tmp->bindParam(':b', $equipe1, PDO::PARAM_STR);
                            $tmp->bindParam(':c', $tournoi, PDO::PARAM_STR);
                            $tmp->execute();
                            //print_r($tmp->errorInfo());
                            echo "nouveau elo pour $tournoi de $equipe1 : $elobis</br>";

                            $req4 = "UPDATE Score SET score= :a WHERE participant= :b AND tournoi= :c";
                            $tmp = $connection->prepare($req4);
                            $elobis = floor($elo2-$delta);
                            $tmp->bindParam(':a', $elobis, PDO::PARAM_STR);
                            $tmp->bindParam(':b', $equipe2, PDO::PARAM_STR);
                            $tmp->bindParam(':c', $tournoi, PDO::PARAM_STR);
                            $tmp->execute();
                            //print_r($tmp->errorInfo());
                            echo "nouveau elo pour $tournoi de $equipe2 : $elobis</br>";


                            echo "Le match a bien été rentré</br>";
                        }
                    }

                    else echo "Il faut rentrer deux équipes différentes </br>";

                }

                else echo "Le tournoi n'est pas valide </br>";

            }

            else echo "Une des équipes n'est pas inscrite au tournoi </br>";

        }

        elseif ($entree==1) //mettre $entree à 1 quand l'utilisateur rentre qqchose
        {
            echo 'Veuillez remplir tous les champs </br>';
        }


        ?>


        <form method="POST" action="modification.php">
            <label for="tournoi">Tournoi : </label>
            <input type="text" size="20" maxlength="30" name="tournoi" id="tournoi"/>
            </br>
            <label for="equipe1">Équipe 1 : </label>
            <input type="text" size="20" maxlength="30" name="equipe1" id="equipe1"/>
            <label for="score1">Score : </label>
            <input type="text" size="1" maxlength="3" name="score1" id="score1"/>
            </br>
            <label for="equipe2">Équipe 2 : </label>
            <input type="text" size="20" maxlength="30" name="equipe2" id="equipe2"/>
            <label for="score2">Score : </label>
            <input type="text" size="1" maxlength="3" name="score2" id="score2"/>
            </br>
            <input type="submit" value="Rentrer le match">
        </form>

    </div>
</body>
</html>
