<?php
session_start();

require '../vendor/autoload.php';

require '../src/Achievements/Achievements.php';
require '../src/Achievements/AchievementsRepository.php';

require '../src/Achievements_participants/Achievements_participants.php';
require '../src/Achievements_participants/Achievements_participantsRepository.php';

require '../src/Duo/Duo.php';
require '../src/Duo/DuoRepository.php';

/*
DEJA PRESENTS DANS rang.php
require '../src/Joueur/Joueur.php';
require '../src/Joueur/JoueurRepository.php';*/

require '../src/Matchs/Matchs.php';
require '../src/Matchs/MatchsRepository.php';

require '../src/Participants/Participants.php';
require '../src/Participants/ParticipantsRepository.php';

require '../src/Score/Score.php';
require '../src/Score/ScoreRepository.php';

require '../src/Tournoi/Tournoi.php';
require '../src/Tournoi/TournoiRepository.php';

require '../src/Utility.php';

require 'rang.php';

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

$achPartRepository = new Achievements_participants\Achievements_participantsRepository($connection);
$achPart = $achPartRepository->fetchAll();

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

<?php 

    if(!isset($_SESSION['login']))
    {
        echo 'Veuillez vous connecter.';
    }

    else
    {
        $actuel = $_SESSION['login'];

        if (isset($_POST['nom']) && $_POST['nom']!='')
        {
            $nom = $_POST['nom']; //nouveau
             //$actuel = $_SESSION['login']; ancien
            $boo = 0;

            foreach ($participants as $p)
            {
                if ($p->getNom()==$nom)
                {
                    $boo = 1;
                    $elo = $p->getElo();
                    break;
                }
            }

            if ($boo == 1) echo "Le nom $nom est déjà pris";
            else
            {
                echo "Ancien nom : $actuel</br>";
                echo "Nouveau nom : $nom</br>";
                //$req = "UPDATE Participants SET nom=? WHERE nom=?";
                //$connection->prepare($req)->execute([$nom, $actuel]);
                $req = "UPDATE Participants SET nom= :a WHERE nom= :b";
                $tmp = $connection->prepare($req);
                $tmp->bindParam(':a', $nom, PDO::PARAM_STR);
                $tmp->bindParam(':b', $actuel, PDO::PARAM_STR);
                $tmp->execute();
                //print_r($tmp->errorInfo());
                $_SESSION['login'] = $nom;
                echo 'Changement de nom effectué</br>';

                //foreach ($participants as $p) echo "$p->nom</br>"; endforeach;
            }
        }


        if (isset($_POST['mdp']) && $_POST['mdp']!='')
        {
            $newMdp = $_POST['mdp'];

            $req = "UPDATE Joueur SET password= :a WHERE nom= :b";
            $tmp = $connection->prepare($req);
            $tmp->bindParam(':a', $newMdp, PDO::PARAM_STR);
            $tmp->bindParam(':b', $actuel, PDO::PARAM_STR);
            $tmp->execute();
            //print_r($tmp->errorInfo());

            echo 'Changement de mot de passe effectué</br>';
        }


        foreach ($achievements as $a)
        {
            $nomAch = $a->getNom();
            if (isset($_POST["$nomAch"]))
            {
                $booAch = 0;
                foreach ($achPart as $ap)
                {
                    if ($ap->getParticipant()==$actuel && $ap->getSucces()==$nomAch)
                    {
                        $booAch = 1;
                        break;
                    }
                }

                if ($booAch==0)
                {
                    $req = "INSERT INTO Achievements_participants(participant,succes)
                            VALUES (?,?)";
                    $tmp = $connection->prepare($req);
                    $tmp->execute([$actuel, $nomAch]);
                    echo "Achievement $nomAch rajouté</br>";


                    $jRang;
                    foreach ($joueurs as $j)
                    {
                        if ($j->getNom()==$actuel)
                        {
                            $jRang=$j;
                            break;
                        }
                    }

                    $nbAch = nb_achievements($actuel, $achPart);
                    rank_update($jRang, $nbAch, $connection);
                    $joueurs = $joueurRepository->fetchAll();
                }
            }
        }
        $achPart = $achPartRepository->fetchAll();


        if (isset($_POST['joueurSuppr']) && $_POST['joueurSuppr']!='')
        {
            $joueurSuppr = $_POST['joueurSuppr'];

            $req = "DELETE FROM Participants WHERE nom= :a";
            $tmp = $connection->prepare($req);
            $tmp->bindParam(':a', $joueurSuppr, PDO::PARAM_STR);
            $tmp->execute();
            //print_r($tmp->errorInfo());
            $participants = $participantsRepository->fetchAll();

            echo "Le joueur $joueurSuppr a bien été suppprimé</br>";
        }


        if (isset($_POST['duoSuppr']) && $_POST['duoSuppr']!='')
        {
            $duoSuppr = $_POST['duoSuppr'];

            $req = "DELETE FROM Participants WHERE nom= :a";
            $tmp = $connection->prepare($req);
            $tmp->bindParam(':a', $duoSuppr, PDO::PARAM_STR);
            $tmp->execute();
            //print_r($tmp->errorInfo());
            $participants = $participantsRepository->fetchAll();

            echo "Le duo $duoSuppr a bien été suppprimé</br>";
        }



        //Affichage Ricardo
        if($_SESSION['login'] == 'Ricardo')
        {
            echo '<h1>WelCUM, you have unlocked a special zone</h1>';
            echo '<img src="Ricardo.gif" alt = "Ricardo" height="480" width="352" style="display:block; margin-left: auto; margin-right: auto; width: 50%"></img>';
        }



        //User common affichage infos
        foreach ($joueurs as $j) : 
            if($_SESSION['login'] != 'Admin' && $j->getNom() ==  $_SESSION['login'])
            {
                echo '<h3>Nom : '; echo $j->getNom() ;echo '</h3>';
                echo '<h3>Rang : '; echo $j->getRang() ;echo '</h3>';
                echo '<h3>Promotion : '; echo $j->getPromotion() ;echo '</h3>';
                echo '<h3>Achievements :</h3>';

                foreach ($achPart as $ap)
                {
                    if ($ap->getParticipant()==$j->getNom())
                    {
                        $tmp = $ap->getSucces();
                        echo "$tmp</br>";
                    }
                }
                echo '</br>';

                break;
            }
        endforeach;

        echo "</br></br><h3>Modifications du profil de $actuel :</h3>";
        ?>
        <form method="POST" action="profil.php">

            <?php
            if($_SESSION['login'] != 'Admin')
            {   ?>
                <label for="nom">Nouveau nom : </label>
                <input type="text" size="20" maxlength="30" name="nom" id="nom"/>
                </br>
            <?php
            }
            ?>

            <label for="mdp">Nouveau mot de passe : </label>
            <input type="password" size="20" maxlength="30" name="mdp" id="mdp"/>
            </br>

        <?php

        if($_SESSION['login'] != 'Admin')
        {   ?>

            <label>Nouveaux achievements : </label></br>
            <?php 
            foreach ($achievements as $a):
                $tmp = $a->getNom();
                echo "<input type='checkbox' name=$tmp id=$tmp>";
                echo " $tmp</br> ";
            endforeach; ?>
            </br>
        
        <?php
        }
        ?>

        <input type='submit' value=Modifier>
        </form>


        <?php
        if ( isset($_SESSION['login']) && $_SESSION['login']=='Admin' )
        { ?>
            </br><h3>Supprimer un profil :</h3>
            <form method="POST" action="profil.php">
                <label for="joueurSuppr">Supprimer un joueur : </label>
                <input type="text" size="20" maxlength="30" name="joueurSuppr" id="joueurSuppr"/>
                </br>
                <label for="duoSuppr">Supprimer un duo : </label>
                <input type="text" size="20" maxlength="30" name="duoSuppr" id="duoSuppr"/>
                </br>
                <input type="submit" value="Supprimer">
            </form>
        <?php
        }
        


    }



 ?>



</div>
</body>
</html>
