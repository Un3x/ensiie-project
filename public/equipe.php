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
	<h3>Le président</h3>
		Plou, règnant en tyrant est là pour nous montrer la voie à suivre.
	
	<h4>Son bureau</h4>
		<p>Trésorié : Jalik, ayant pour unique objectif de partir avec la caisse.</p>
		
		<p>Secrétaire Général : DBA3, du moins quand il n'est pas entrain de mettre des B-coté sur smash bros ultimate.</p>
		
	<h5>Ainsi que le reste des membres</h5>
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


<?php
	pied();
?>