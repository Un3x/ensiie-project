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

$myeventRepository = new \Event\EventRepository($connection);
$myevents = $myeventRepository->fetchmyevents();


?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="projet.css">
</head>

<body>

	<div class = "head">
        <h1>IIvEnt</h1> 
        <h2>Mes Évenements</h2> 

        <?php connect($userRepository,$users,$_POST);

        if (!$_SESSION['connected']){

            echo "<p class=\"user\"> Vous n'êtes pas connecté. Vous n'avez pas accès à cette page. </p>";
        }

        ?>

    </div>
    
    <div class = "column">
        <div class = "menu">
        <?php

        if (!$_SESSION['connected']){
            
            echo "<a class='active'> Menu </a>";
            echo "<a href=inscription.php> Inscrivez vous ! </a>";
        }

        if ($_SESSION['connected']) {

            echo "<a class='active'> Menu </a>";
            echo "<a href=index.php> Événement </a>";
            echo "<a href=Newevent.php> Nouvel événement </a>";
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
          
        //si on a demandé d'annuler un événement 
        if (isset($_POST['Cancel'])){

            $idevent = $_POST['idevent'];
            cancelEvent($idevent);
            echo "<h3 class='modif'> Événement annulée</h3>";


        }


        //si on a demandé d'éditer un événement
        if (!isset($_POST['Edit'])){

            if (isset($_POST['confirmEdit'])){
                $idevent = $_POST['idevent'];
                $title = $_POST['title'];
                $day = $_POST['day'];
                $month = $_POST['month'];
                $year = $_POST['year'];
                $start = $_POST['start'];
                $place = $_POST['place'];
                $type = $_POST['type'];
                editEvent($idevent,$title,$day,$month,$year,$start,$place,$type);
                echo "<h3 class='modif'> Modification effectuée</h3>";
            }


            $connection = connectToBD();

            $userRepository = new \User\UserRepository($connection);
            $users = $userRepository->fetchAll();

            $eventRepository = new \Event\EventRepository($connection);
            $events = $eventRepository->fetchAll();

            $myeventRepository = new \Event\EventRepository($connection);
            $myevents = $myeventRepository->fetchmyevents();

            invitation();
            printMyEvents($events,$myevents);

        }

        else{

            $id = $_POST['idevent'];

            echo "
            <form action=myevents.php method=post>
            <p>Nouveau Titre: <input type='text' size='20' name='title'/ required></p>

            <p>Jour:<select name='day'>
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                <option value=6>6</option>
                <option value=7>7</option>
                <option value=8>8</option>
                <option value=9>9</option>
                <option value=10>10</option>
                <option value=10>11</option>
                <option value=12>12</option>
                <option value=13>13</option>
                <option value=14>14</option>
                <option value=15>15</option>
                <option value=16>16</option>
                <option value=17>17</option>
                <option value=18>18</option>
                <option value=19>19</option>
                <option value=20>20</option>
                <option value=21>21</option>
                <option value=22>22</option>
                <option value=23>23</option>
                <option value=24>24</option>
                <option value=25>25</option>
                <option value=26>26</option>
                <option value=27>27</option>
                <option value=28>28</option>
                <option value=29>29</option>
                <option value=30>30</option>
                <option value=31>31</option>
            </select>
            Mois: <select name='month'>
                <option value=1>Janvier</option>
                <option value=2>Fevier</option>
                <option value=3>Mars</option>
                <option value=4>Avril</option>
                <option value=5>Mai</option>
                <option value=6>Juin</option>
                <option value=7>Juillet</option>
                <option value=8>Aout</option>
                <option value=9>Septembre</option>
                <option value=10>Octobre</option>
                <option value=11>Novembre</option>
                <option value=12>Decembre</option>
            </select>
            Année: <select name='year'>
                <option value=2019>2019</option>
                <option value=2020>2020</option>
                <option value=2021>2021</option>
                <option value=2022>2022</option>
                <option value=2023>2023</option>
                <option value=2024>2024</option>

            </select></p>

            <p>Début: <select name='start'>
                <option value='10:00:00'>10h</option>
                <option value='11:00:00'>11h</option>
                <option value='12:00:00'>12h</option>
                <option value='13:00:00'>13h</option>
                <option value='14:00:00'>14h</option>
                <option value='15:00:00'>15h</option>
                <option value='16:00:00'>16h</option>
                <option value='17:00:00'>17h</option>
                <option value='18:00:00' selected=\"selected\">18h</option>
                <option value='19:00:00'>19h</option>
                <option value='20:00:00'>20h</option>
                <option value='21:00:00'>21h</option>
                <option value='22:00:00'>22h</option>
                <option value='23:00:00'>23h</option>
                <option value='24:00:00'>Minuit</option>
            </select></p>

            <p>Lieu: <input type='text' size='20' maxlength=\"30\" name='place'/ required></p>
                
            <p>Type: <select name=\"type\">
                <option value=\"Before\" selected=\"selected\">Before</option>
                <option value=\"Soirée BDE\">Soirée BDE</option>
                <option value=\"After\">After</option>
                <option value=\"Sortie\">Sortie</option>
                <option value=\"Soirée\">Soirée</option>
                <option value=\"Aniversaire\">Anniversaire</option>
                <option value=\"Crémaillère\">Crémaillère</option></p>
       
            </select><br>
            <input type='hidden' value=$id name=\"idevent\"/>
            <p><input type='submit' value=\"Confirmer la modification\" name=\"confirmEdit\"/></p>
            </form>
            ";

        }


        ?>
    	</div>
    </div>

</body>