<?php session_start();
require '../vendor/autoload.php';
include '../src/connexion.php';
require '../src/User/User.php';
include '../src/Event/Event.php';
require '../src/Event/EventRepository.php';
require '../src/gestionEvents.php';

$connection = connectToBD();

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$eventRepository = new \Event\EventRepository($connection);
$events = $eventRepository->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="projet.css">
</head>

<body>

	<div class = "head">
        <h1>IIvEnt</h1> 
        <h2>Inscription</h2> 

        <?php connect($userRepository,$users,$_POST);

        echo "<p class=\"user\"> Inscrivez-vous ! </p>";

        ?>
    </div>

    <div class="row">
        <div class = "column">
            <div class = "menu">
    
                <?php

                if (!$_SESSION['connected']){
                    
                    echo "<a class='active'> Menu </a>";
                    echo "<a href=index.php> Événements </a>";
                }

                if ($_SESSION['connected']) {

                    echo "<a class='active'> Menu </a>";
                    echo "<a href=Newevent.php> Nouvel événement </a>";
                    echo "<a href=myevents.php> Consulter mes événements </a>";
                    echo "<a href=pageCompte.php> Gérer son compte </a>";
                    if ($_SESSION['currentAdmin']){
                        echo "<a href=administration.php> Administration </a>";
                    }
                    echo "<a href=deconnexion.php> Se déconnecter </a>";
                }
                ?>

            </div>
        </div>

        <div class = "column">
        	<div class = "content">
        		<form action=inscription_bd.php method=post>
        			<p>Prénom: <input type='text' size='20' maxlength='28' name='prenom' required/></p>
        			<p>Nom: <input type='text' size='20' maxlength='28' name='nom' required/></p>
        			<p>Pseudo: <input type='text' size='20' maxlength='28' name='pseudo' required/></p>
        			<p>Mot de Passe: <input type='password' size='20' maxlength='18' name='mdp' required/></p>
        			<p><input type='submit' value="S'inscrire"/></p>
        		</form>
        	</div>
        </div>
    </div>

</body>
