<?php

session_start();
require '../vendor/autoload.php';
include '../src/connexion.php';
include '../src/gestionCompte.php';
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
		<h2>Mon Compte </h2>



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
	        echo "<a href=index.php> Événements </a>";
	        echo "<a href=Newevent.php> Nouvel événement </a>";
	        echo "<a href=myevents.php> Consulter mes événements </a>";
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

		<form action=pageCompte.php method=post>
			<input type="submit" value="Changer son identité" name="id"/>
			<input type="submit" value="Changer son mot de passe" name="mdp"/>

		</form>

		<?php

		if (isset($_POST['id'])){

			echo"
			<p><form action=pageCompte.php method=post>
				<p>Nouveau Pseudo: <input type='text' size='20' name='newpseudo'/></p>
				<p>Mot de Passe: <input type='password' size='20' name='mdp'/></p>
				<p><input type=\"submit\" value=\"Confirmer\"/></p>

			</form></p>
			";


		}

		if (isset($_POST['mdp'])){

			echo"
			<p>
			<form action=pageCompte.php method=post>
				<p>Nouveau Mot de Passe: <input type='password' size='20' name='newmdp'/></p>
				<p>Mot de Passe: <input type='password' size='20' name='mdp'/></p>
				<p><input type=\"submit\" value=\"Confirmer\"/></p>

			</form></p>
			";
			
		}

		if (isset($_POST['newmdp'])){



			changeMDP($_POST['mdp'],$_POST['newmdp']);

		}


		if (isset($_POST['newpseudo'])){

			changePseudo($_POST['mdp'],$_POST['newpseudo']);


		}

		?>
	</div>
</div>

</body>