<?php
	require( "../inc/inc.default.php" );
	require( "../inc/inc.nav.php" );
	require( "../src/Membre/Membre.php");
	require( "../src/Membre/MembreRepository.php");
	entete( "Accueil" );
	navAccueil();
	
	$dbName = 'realitiie';
	$dbUser = 'postgres';
	$dbPassword = 'postgres';
	$connection = new PDO("pgsql:host=localhost, user=$dbUser, dbname=$dbName, password=$dbPassword");

	$membreRepository = new \Membre\MembreRepository($connection);
	$membres = new \Membre\Membre($connection);
	
	$members = $MembreRepository->fetchAll();
?>

<h2>NOTRE EQUIPE</h2>
<div>
    <div class="bloc-bord"> 
		<h3>Le président</h3>
			<p><b>Plou</b>, règnant en tyrant est là pour nous montrer la voie à suivre. Fort de sa dernière participation
			au Laval virtual il sera chargé d'organiser les tutos et vous entrainer pour pouvoir profiter vous même de l'expérience.</p>
		
		<h4>Son bureau</h4>
			<p><b> Vice président : Altréon</b>, très actif dans l'association et à son compte plusieurs projets (même s'il totalise que des échecs),
			se fera un plaisir de vous aider à réaliser le jeu de vos rêves. Il suffit, comme lui, de ne pas avoir de scrupules et de savoir
			voler avec impunité le travail des autres.</p>
			<p><b>Trésorié : Jalik</b>, ayant pour unique objectif de partir avec la caisse, mais pas avant de l'avoir entièrement dépensée en matériel
			pour l'association. Le budget de l'association est à dépenser et c'est à vous de proposer ce qu'il faut acheter.</p>
			
			<p><b>Secrétaire Général : DBA3</b>, du moins quand il n'est pas entrain de mettre des B-coté sur smash bros ultimate, vous pouvez compter sur lui pour
			recevoir les compte-rendus des réunions.</p>
	</div>
	<div>		
		<h5>Ainsi que le reste des membres</h5>
		<table>
			<tr><th></th><th>Surnom</th><th>Prénom</th><th>Nom</th></tr>
			
			<!-- A retirer : à titre d'exemple
			<tr> <td><img src="../img/membres/Plou.png" alt="l'homme invisible" width="100" height="100"/></td> <td>Plou</td> <td>Jean-Loup</td> <td>MACARIT</td> </tr>
			<tr> <td><img src="../img/membres/Altreon.png" alt="l'homme invisible" width="100" height="100"/></td> <td>Altreon</td><td>Matteo</td><td>BRANDI</td></tr>
			<tr> <td><img src="../img/badassChicken.png" alt="l'homme invisible" width="100" height="100"/></td> <td>fIIEts</td><td>Rémi</td><td>VAN DER LEE</td></tr>
			-->
			<?php // A TESTER
			foreach ($membres as $membre) {
				$img = $membres->getSurnom();
				$img = "../img/membres/".$img.".png";
				if(file_exists($img) == false){
					$img = "../img/badassChicken.png";
				}
					
				echo 
				'<tr>
					<td><img src='.$img.' alt="404 : people not found" width="150" height="150"/>
					<td>'.$membre->getSurnom().'</td>
					<td>'.$membre->getPrenom().'</td>
					<td>'.$membre->getNom().'</td>
				</tr>';
			}
			?>
		</table>
	</div>
</div>


<?php
	pied();
?>