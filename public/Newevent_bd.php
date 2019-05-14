<?php session_start();

require '../vendor/autoload.php';
include '../src/connexion.php';
include '../src/User/User.php';
include '../src/Event/Event.php';
require '../src/Event/EventRepository.php';

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="projet.css">
</head>

<body>


	<?php
	$tab=$_POST;


		$connection = connectToBD();

		// creation de l'événement
		$sql = 'INSERT INTO "event"(title, type, day, start, place, idcreator, public) VALUES (?,?,?,?,?,?,?)';

		$title = $tab['title'];
		$type = $tab['type'];
		$day = $tab['day'];
		$month = $tab['month'];
		$year = $tab['year'];
		$date = "$year-$month-$day";
		$public = $tab['public'];
		$start = $tab['start'];
		$place = $tab['place'];
		$idcreator = $_SESSION['currentId'];
		$pseudo = $_SESSION['currentPseudo'];

		$req = $connection->prepare($sql);

		$req->execute([$title, $type, $date, $start, $place, $idcreator, $public]);


		// inscription du createur à l'événement
		$sql = 'INSERT INTO "participant"(idevent,iduser,pseudo) VALUES (?,?,?)';

		$connection = connectToBD();
		$eventRepository = new \Event\EventRepository($connection);
		$events = $eventRepository->fetchAll();

		foreach ($events as $event) {
			$t = $event->getTitle();
			if ($t = $title){

				$idevent = $event->getIdEvent();
			}
		}

		$connection->prepare($sql)->execute([$idevent,$idcreator,$pseudo]);


		
	    
		echo "<p>Évenement créé</p><br>";
		echo "<a href=index.php> Retour au menu </a><br>";
	?>

