<?php 

// retourne le pseudo du l'utilisateur qui à crée l'événement dont l'idcreator est $idCreator
function getCreator($idCreator){

		$dbName = getenv('DB_NAME');
		$dbUser = getenv('DB_USER');
		$dbPassword = getenv('DB_PASSWORD');
		$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

		$sql = "SELECT pseudo FROM \"user\" u JOIN \"event\" e ON e.idcreator = u.id WHERE u.id = $idCreator";

		foreach ($connection->query($sql) as $row) {
			$creator = $row['pseudo'];
		}

		return $creator;

}


function printEvents($events){


	if (!$_SESSION['connected']){

		// si il y a des événements
		if (isset($events)){

			foreach ($events as $event) {
				if ($event->getPublic() == "Oui"){

					$title = $event->getTitle();
					$day = $event->getDay();
					$start = $event->getStart();
					$type = $event->getType();
					$place = $event->getPlace();
					$idCreator = $event->getIdCreator();
					$creator = getCreator($idCreator);
					
					echo "
					<div class = \"event\" id='connected'>
						<h3 class='event'>$title</h3>
						<p class = 'event'>$type créé(e) par $creator</p>
						<p class = 'event'>Cet Événement aura lieu le $day à $start</p>
						<p class = 'event'>À $place</p>


					</div>
					";
				}

			}
		}

	}

	else {

		// si il y a des événements
		if (isset($events)){



			foreach ($events as $event) {

				$title = $event->getTitle();
				$day = $event->getDay();
				$idevent = $event->getIdEvent();
				$start = $event->getStart();
				$type = $event->getType();
				$place = $event->getPlace();
				$idCreator = $event->getIdCreator();
				$creator = getCreator($idCreator);
				$myid = $_SESSION['currentId'];
				$pseudo = $_SESSION['currentPseudo'];

				echo "
				<div class = \"event\" id='disconnected'>
					<h3 class='event'>$title</h3>
					<p class = 'event'>$type créé(e) par $creator</p>
					<p class = 'event'>Cet Événement aura lieu le $day à $start</p>
					<p class = 'event'>À $place</p>";


				// si on a demandé à cacher les participants
				if (isset($_POST['hideParticipants'])){
					$_POST['participants'] = NULL;
				}	

				//si on a demandé à s'inscrire
				if ((isset($_POST['inscription'])) && ($idevent == $_POST['idevent'])){

					addToEvent($idevent,$myid,$pseudo);
				}

				//si on a demandé à se désinscrire
				if ((isset($_POST['uninscription'])) && ($idevent == $_POST['idevent'])){

					suppToEvent($idevent,$myid,$pseudo);
				}

				// si on a demandé a voir les participants de cet événements
				if ((isset($_POST['participants'])) && ($idevent == $_POST['idevent'])){
					printParticipants($idevent);
					echo "
					<form action=index.php method=post>
						<input type='hidden' value=$idevent name='idevent' />";
						if (!testParticipation($idevent,$myid)){
							echo "<input type='submit' value=\"Participer\" name=\"inscription\"/>";
						}
						else{
							echo "<input type='submit' value=\"Annuler sa participation\" name=\"uninscription\"/>";
						}
						echo "<input type='submit' value=\"Cacher les participants\" name='hideParticipants'/>
					</form>";
				}

				//sinon
				else{
					echo "
					<form action=index.php method=post>
						<input type='hidden' value=$idevent name='idevent' />";
						if (!testParticipation($idevent,$myid)){
							echo "<input type='submit' value=\"Participer\" name=\"inscription\"/>";
						}
						else{
							echo "<input type='submit' value=\"Annuler sa participation\" name=\"uninscription\"/>";
						}
							
						echo "<input type='submit' value=\"Voir les participants\" name='participants'/>
					</form>";
				}

				echo "	
				</div>
				";
			}
		}
	}
}

function invitation(){

	if (isset($_POST['invit'])){

		$titleEvent = $_POST['titleEvent'];
		$idInvitationEvent = $_POST['idevent'];

		echo "
		<h4>Personne à inviter à l'événement $titleEvent:</h4>
		<form action=myevents.php method=post>
			Pseudo: <input type=\"text\" name='invitPseudo'/>
			<input type=\"hidden\" value=$idInvitationEvent name='invitationEvent'/> 
			<input type='submit' value=\"Confirmer\" name='confirm_invitation'/>
		</form>
		";
	}

	if (isset($_POST['confirm_invitation'])){

		$invitationEvent = $_POST['invitationEvent'];
		$myid = $_SESSION['currentId'];
		$invitpseudo = $_POST['invitPseudo'];

		addToEvent($invitationEvent,$myid,$invitpseudo);
	}

}

function printMyEvents($events,$myevents){


	// si on a créé des événements
	if (isset($myevents)){

		echo "<h3>Vous avez créé les évenements:</h3>";

		foreach ($myevents as $event) {


			$title = $event->getTitle();
			$day = $event->getDay();
			$idevent = $event->getIdEvent();
			$start = $event->getStart();
			$type = $event->getType();
			$place = $event->getPlace();
			$idCreator = $event->getIdCreator();
			$creator = getCreator($idCreator);


			echo "
			<div class = \"event\">
				<h3 class='event'>$title</h3>
				<p class = 'event'>Cet Évenement aura lieu le $day à $start</p>
				<p class = 'event'>À $place</p>";

				//si on a demandé à cacher les participants
				if (isset($_POST['hideParticipants'])){
					$_POST['participants'] = NULL;
				}	 

				//si on a demandé à voir les participants
				if ((isset($_POST['participants'])) && ($idevent == $_POST['idevent'])){
					printParticipants($idevent);
					$_POST['participants'] = NULL; //pour éviter que les participants ne s'affichent dans l'affichage des événements où on participe.
					echo "<form action=myevents.php method=post>
						<input type=\"hidden\" value=$idevent name=\"idevent\"/>
						<input type=\"hidden\" value=$title name=\"titleEvent\"/>
						<input type=\"submit\" value=\"Inviter\" name=\"invit\"/>
						<input type=\"submit\" value=\"Éditer\" name=\"Edit\"/>
						<input type=\"submit\" value=\"Annuler\" name=\"Cancel\"/>
						<input type='submit' value=\"Cacher les participants\" name='hideParticipants'/>
					</form>";
				}
				else{
					echo "<form action=myevents.php method=post>
						<input type=\"hidden\" value=$idevent name=\"idevent\"/>
						<input type=\"hidden\" value=$title name=\"titleEvent\"/>
						<input type=\"submit\" value=\"Inviter\" name=\"invit\"/>
						<input type=\"submit\" value=\"Éditer\" name=\"Edit\"/>
						<input type=\"submit\" value=\"Annuler\" name=\"Cancel\"/>
						<input type='submit' value=\"Voir les participants\" name='participants'/>
					</form>";

				}

			echo "</div>
			";
		}

	}

	else{
		echo "<h3>Vous n'avez créé aucun évenement</h3>";
	}
		

	if (isset($events)){

		echo "<h3>Vous participez aux évenements:</h3>";


		foreach ($events as $event) {

			$title = $event->getTitle();
			$day = $event->getDay();
			$idevent = $event->getIdEvent();
			$start = $event->getStart();
			$type = $event->getType();
			$place = $event->getPlace();
			$idCreator = $event->getIdCreator();
			$creator = getCreator($idCreator);
			$myid = $_SESSION['currentId'];
			$pseudo = $_SESSION['currentPseudo'];

			// si on participe à l'événement
			if (testParticipation($idevent,$myid)){
				echo "
				<div class = \"event\">
					<h3 class='event'>$title</h3>
					<p class = 'event'>$type créé(e) par $creator</p>
					<p class = 'event'>Cet Évenement aura lieu le $day à $start</p>
					<p class = 'event'>À $place</p>";

				//si on a demandé à cacher les participants
				if (isset($_POST['hideParticipants'])){
					$_POST['participants'] = NULL;
				}	

				//si on a demandé à s'inscrire
				if ((isset($_POST['inscription'])) && ($idevent == $_POST['idevent'])){

					addToEvent($idevent,$myid,$pseudo);
				}

				//si on a demandé à se désinscrire
				if ((isset($_POST['uninscription'])) && ($idevent == $_POST['idevent'])){

					suppToEvent($idevent,$myid,$pseudo);
				}

				//si on a demandé à vori les participants
				if ((isset($_POST['participants'])) && ($idevent == $_POST['idevent'])){
					printParticipants($idevent);
					echo "
					<form action=myevents.php method=post>
						<input type='hidden' value=$idevent name='idevent' />
						<input type='submit' value=\"Annuler sa participation\" name=\"uninscription\"/>
						<input type='submit' value=\"Cacher les participants\" name='hideParticipants'/>
					</form>";
				}

				else{
					echo "
					<form action=myevents.php method=post>
						<input type='hidden' value=$idevent name='idevent' />
						<input type='submit' value=\"Annuler sa participation\" name=\"uninscription\"/>
						<input type='submit' value=\"Voir les participants\" name='participants'/>
					</form>";
				}

				echo "	
				</div>
				";

			}
			
		}
	}

	else {

		echo "<h3>Vous ne participez à aucun évenement</h3>";
	}

}

function printEventAdmin($events){

	echo "<h3>En tant qu'administrateur vous pouvez modifiez ou annuler n'importe quel événement</h3>";

	if (isset($events)){

		foreach ($events as $event) {


			$title = $event->getTitle();
			$day = $event->getDay();
			$idevent = $event->getIdEvent();
			$start = $event->getStart();
			$type = $event->getType();
			$place = $event->getPlace();
			$idCreator = $event->getIdCreator();
			$creator = getCreator($idCreator);


			echo "
			<div class = \"event\">
				<h3 class='event'>$title</h3>
				<p class = 'event'>Cet Évenement aura lieu le $day à $start</p>
				<p class = 'event'>À $place</p>";

				//si on a demandé à cacher les participants
				if (isset($_POST['hideParticipants'])){
					$_POST['participants'] = NULL;
				}	 

				//si on a demandé à voir les participants
				if ((isset($_POST['participants'])) && ($idevent == $_POST['idevent'])){
					printParticipants($idevent);
					$_POST['participants'] = NULL; //pour éviter que les participants ne s'affichent dans l'affichage des événements où on participe.
					echo "<form action=administration.php method=post>
						<input type=\"hidden\" value=$idevent name=\"idevent\"/>
						<input type=\"submit\" value=\"Éditer\" name=\"Edit\"/>
						<input type=\"submit\" value=\"Annuler\" name=\"Cancel\"/>
						<input type='submit' value=\"Cacher les participants\" name='hideParticipants'/>
					</form>";
				}
				else{
					echo "<form action=administration.php method=post>
						<input type=\"hidden\" value=$idevent name=\"idevent\"/>
						<input type=\"submit\" value=\"Éditer\" name=\"Edit\"/>
						<input type=\"submit\" value=\"Annuler\" name=\"Cancel\"/>
						<input type='submit' value=\"Voir les participants\" name='participants'/>
					</form>";

				}

			echo "</div>
			";
		}

	}
}

// Retire l'événements d'id $idevent de la base de donnée 
function cancelEvent($idevent){


	$connection = connectToBD();

	$sql = 'DELETE FROM "event" WHERE idevent = ?';

	$connection->prepare($sql)->execute([$idevent]);
}

// Modifie l'événements d'if $idevent selon les valeurs données
function editEvent($idevent,$title,$day,$month,$year,$start,$place,$type){

	$connection = connectToBD();

	$sql = "UPDATE \"event\" SET title=?, start=?, type = ?, day=?, place=? WHERE idevent=$idevent";
	$day = "$year-$month-$day";

	$connection->prepare($sql)->execute([$title,$start,$type,$day,$place]);


}

// Affiche les participants de l'événement d'id $idevent
function printParticipants($idevent){

	$connection = connectToBD();

	$participantRepository = new \Participant\ParticipantRepository($connection);
	$participants = $participantRepository->fetch($idevent);
	echo "<h4 class='event'>Participants:</h4>";
	echo "<ul>";
	foreach ($participants as $participant) {
		$pseudo = $participant->getPseudo();
		echo "<li>$pseudo</li>";
	}
	echo "</ul>";	
}

// Test si l'user d'id $myid (l'utilisateur connecté) participe à l'événement d'id $idevent
function testParticipation($idevent,$myid){

	$sql = "SELECT * FROM \"participant\" WHERE (idevent=$idevent AND iduser=$myid)";
	$connection = connectToBD();
	$req = $connection->query($sql);

	if ($req->fetchColumn() == 0){
		return false;
	}
	else{
		return true;
	}
}

// Ajoute aux participants à l'événement $idevent  l'utilisateur connecté 
function addToEvent($idevent,$myid,$pseudo){

	$sql = "INSERT INTO \"participant\"(idevent,iduser,pseudo) VALUES (?,?,?)";

	$connection = connectToBD();
	$connection->prepare($sql)->execute([$idevent,$myid,$pseudo]);
}

// Supprime des participants à l'événement $idevent l'utilisateur connecté (il doit y participer pour appeler cette fonction)
function suppToEvent($idevent,$myid,$pseudo){

	$sql = "DELETE FROM \"participant\" WHERE (idevent=? AND iduser=?)";
	$connection = connectToBD();
	$connection->prepare($sql)->execute([$idevent,$myid]);
}