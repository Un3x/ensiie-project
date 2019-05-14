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

$tournoisRepository = new Tournoi\TournoiRepository($connection);
$tournois = $tournoisRepository->fetchAll();

$scoreRepository = new Score\ScoreRepository($connection);
$scores = $scoreRepository->fetchAll();

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
        echo 'Pour pouvoir vous mettre en duo, il faut vous connecter.';
    }

    else
    {
        $actuel = $_SESSION['login'];

        if (isset($_POST['partenaire']) && isset($_POST['nomDuo']) && $_POST['partenaire']!='' && $_POST['nomDuo']!='')
        {
            $nomPartenaire = $_POST['partenaire'];
            $nomDuo = $_POST['nomDuo'];

            $verifPartenaire = 0;
            foreach ($joueurs as $j)
            {
                if ($j->getNom()==$nomPartenaire)
                {
                    $verifPartenaire = 1;
                    break;
                }
            }

            if ($verifPartenaire==0)
            {
                echo "</br>Cette personne n'existe pas</br>";
            }

            else
            {
                $verifDoublon = 0;
                if ($actuel==$nomPartenaire) $verifDoublon=1;

                if ($verifDoublon==0)
                {
                    //Ajout dans Participants pour pouvoir l'ajouter à Duo après
                    $req = "INSERT INTO Participants(nom,elo)
                            VALUES (?,?)";
                    $tmp = $connection->prepare($req);
                    $tmp->execute([$nomDuo, 1000]);

                    //Ajout dans Duo
                    $req = "INSERT INTO Duo(nom,joueur1,joueur2,statut)
                            VALUES (?,?,?,?)";
                    $tmp = $connection->prepare($req);
                    $tmp->execute([$nomDuo, $actuel, $nomPartenaire, 'Chapitre 0 : Pourquoi avoir fait ça']);

                    echo "Le duo a bien été ajouté.</br>";
                }

                else echo "Vous ne pouvez pas être en duo avec vous-même.</br>";
            }
        }

        else
        {
            echo "</br>Veuillez remplir tous les champs</br>";
        }







        if (isset($_POST['tournoiInscr']) && $_POST['tournoiInscr']!='' && isset($_POST['duoTournoi']) && $_POST['duoTournoi']!='')
        {
            $tournoiInscr = $_POST['tournoiInscr'];
            $duoTournoi = $_POST['duoTournoi'];

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

                $verifDuo = 0;
                foreach ($duos as $d)
                {
                    if ($d->getNom()==$duoTournoi)
                    {
                        $verifDuo=1;
                        break;
                    }
                }


                if ($verifDuo==1)
                {

                    $verifDoublon = 0;
                    
                    foreach ($scores as $s)
                    {
                        if ($s->getParticipant()==$duoTournoi && $s->getTournoi()==$tournoiInscr)
                        {
                            $verifDoublon = 1;
                            break;
                        }
                    }


                    if ($verifDoublon==0)
                    {
                        $req = "INSERT INTO Score(participant,tournoi,score) VALUES (?,?,?)";
                        $tmp = $connection->prepare($req);
                        $tmp->execute([$duoTournoi, $tournoiInscr, 1000]);
                        //print_r($tmp->errorInfo());
                        echo "L'inscription a bien été effectuée";

                        $scores = $scoreRepository->fetchAll();
                        $tournois = $tournoisRepository->fetchAll();
                        $classementTournoi = $classUtility->fetchClassementTournoi();
                    }

                    else echo "Vous êtes déjà inscrit à ce tournoi.</br>";

                }
                else echo "Ce duo n'existe pas.</br>";

            }

            else echo "Impossible de s'inscrire au tournoi $tournoiInscr car il n'existe pas.</br>";
        }

        else echo "Pour s'inscrire à un tournoi, rentrer le nom du tournoi et du duo.</br>";





        ?>


        <h3>Création :</h3>
        <form method="POST" action="duos.php">
            <label for="partenaire">Votre partenaire : </label>
            <input type="text" size="20" maxlength="30" name="partenaire" id="partenaire"/>
            </br>
            <label for="nomDuo">Le nom de votre duo : </label>
            <input type="text" size="20" maxlength="30" name="nomDuo" id="nomDuo"/>
            </br>

            <input type='submit' value="Création du duo">
        </form>


        <h3>Inscription dans un tournoi :</h3>
        <form method="POST" action="duos.php">
            <label for="tournoiInscr">Nom du tournoi : </label>
            <input type="text" size="20" maxlength="30" name="tournoiInscr" id="tournoiInscr"/>
            </br>
            <label for="duoTournoi">Nom du duo : </label>
            <input type="text" size="20" maxlength="30" name="duoTournoi" id="duoTournoi"/>
            </br>
            <input type="submit" value="Inscription">
        </form>


        <?php
        

    }



 ?>



</div>
</body>
</html>
