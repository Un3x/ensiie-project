<?php
	require( "../inc/inc.default.php" );
	require( "../inc/inc.nav.php" );
	require( "../src/Membre/Membre.php");
	require( "../src/Membre/MembreRepository.php");
	entete( "Accueil" );
	navAccueil();
	
	/*$dbName = 'realitiie';
	$dbUser = 'postgres';
	$dbPassword = 'postgres';
	$connection = new PDO("pgsql:host=localhost, user=$dbUser, dbname=$dbName, password=$dbPassword");

	$membreRepository = new \Membre\MembreRepository($connection);
	$membres = new \Membre\Membre($connection);
	
	$members = $MembreRepository->fetchAll();*/
?>

<h2>NOTRE EQUIPE</h2>
<div>
    <div class="round-border"> 
	
		<h3>Le président</h3>
			<p>Plou, règnant en tyrant est là pour nous montrer la voie à suivre. Fort de sa dernière 
			participation au Laval virtual il sera chargé d'organiser les tutos et vous entrainer pour 
			pouvoir profiter vous même de l'expérience.</p>
		
		<h3>Son bureau</h3>
			<p> Vice président : Altréon, très actif dans l'association et à son compte plusieurs projets (même s'il ne totalise que 
			des echecs), se fera un plaisir de vous aiderà réaliser le jeu de vos rêves. Il suffit comme lui de ne pas avoir de scrupules
			et de savoir voler en toute impunité le travail des autres.</p>
			<p>Trésorié : Jalik, ayant pour unique objectif de partir avec la caisse, mais pas avant de l'avoir entièrement 
			dépensée en matériel pour l'association. Le budget de l'association est à dépenser et c'est à vous de proposer 
			ce qu'il faut acheter.</p>
			
			<p>Secrétaire Général : DBA3, du moins quand il n'est pas entrain de mettre des B-coté sur smash bros ultimate, 
			vous pouvez compter sur lui pour recevoir les compte-rendus des réunions.</p>
	</div>
	
	<div>		
		<h3>Ainsi que le reste des membres</h3>
		<table>
			<tr><th>Surnom</th><th>Prénom</th><th>Nom</th></tr>
			
			<!-- A retirer : à titre d'exemple-->
			<tr><td>Plou</td><td>Jean-Loup</td><td>MACARIT</td></tr>
			<tr><td>Altreon</td><td>Matteo</td><td>BRANDI</td></tr>
			<tr><td>fIIEts</td><td>Rémi</td><td>VAN DER LEE</td></tr>
			<?php // A TESTER
			/*foreach ($membres as $membre) {
				echo 
				'<tr>
					<td>'.$membre->getSurnom().'</td>
					<td>'.$membre->getPrenom().'</td>
					<td>'.¤membre->getNom().'</td>
				</tr>';
			}
			*/?>
		</table>
	</div>
</div>


<?php
	pied();
?>