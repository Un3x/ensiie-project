<?php

session_start();

require '../vendor/autoload.php';
include '../src/connexion.php';
require '../src/User/User.php';
include '../src/Event/Event.php';
require '../src/Event/EventRepository.php';
include '../src/Participant/Participant.php';
require '../src/Participant/ParticipantRepository.php';
require '../src/gestionEvents.php';

$connection = connectToBD();

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$eventRepository = new \Event\EventRepository($connection);
$events = $eventRepository->fetchAll();

$participantRepository = new \Participant\ParticipantRepository($connection);
$participants = $participantRepository->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="projet.css">
</head>

<body>

    <div class = "head">
        <h1>IIvEnt</h1> 
        <h2>Les Événements</h2> 


        <?php connect($userRepository,$users,$_POST);

        if (!$_SESSION['connected']){

            echo "<p class=\"user\"> Vous n'êtes pas connecté. Pour avoir accès aux événements privés, vous inscrire à des événements ou en créér, connectez vous ou inscrivez vous! </p>";
        }

        ?>

    </div>

    <div class="row">
        <div class = "column">
            <div class = "menu">

            <?php

            if (!$_SESSION['connected']){

                echo "<a class='active'> Menu </a>";
                echo "<a href=inscription.php> Inscrivez vous ! </a>";
            }

            if ($_SESSION['connected']) {

                echo "<a class='active'> Menu </a>";
                echo "<a href=Newevent.php> Nouvel événement </a>";
                echo "<a href=myevents.php> Consulter mes événements </a>";
                echo "<a href=pageCompte.php> Gérer son compte </a>";
                if ($_SESSION['currentAdmin'] == 'Oui'){
                    echo "<a href=administration.php> Administration </a>";
                }
                echo "<a href=deconnexion.php> Se déconnecter </a>";
            }
            ?>

            </div>
        </div>

        <div class = "column">
            <div class = "content">
                <?php 

                printEvents($events);

                ?>   
            </div>
        </div>
    </div>


</body>

</body>
</html>
