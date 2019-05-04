<?php
	require("../inc/inc.default.php");
	require("../inc/inc.nav.php");
	require("../src/Jeu/Jeu.php");
	require("../src/Jeu/JeuRepository.php");
	
	entete("Projets");
	navAccueil();
	
	/*$dbName = 'realitiie';
	$dbUser = 'postgres';
	$dbPassword = 'postgres';
	$connection = new PDO("pgsql:host=localhost, user=$dbUser, dbname=$dbName, password=$dbPassword");

	$JeuRepository = new \Jeu\JeuRepository($connection);
	$Jeu = new \Jeu\Jeu($connection);
	
	//Postgres
	$jeux = $JeuRepository->fetchAll();*/
?>

<h2>PROJETS!</h2>
<div>
<p>Voici ce dont les membres de l'association sont capable!</p>
</div>
<div>
<table>
    	<tr><th>Titre</th><th>Téléchargement</th></tr>
		
		<!-- A retirer : à titre d'exemple-->
		<tr><td>Overcraft</td><td>dwl</td></tr>
		<tr><td>Fight for the Door</td><td>dwl</td></tr>
		<tr><td>Restroom</td><td>dwl</td></tr>
    	<?php // A TESTER
    	/*foreach ($jeux as $jeu) {
    	    echo 
    	    '<tr>
				<td>'.$jeu->getTitre().'</td>
				<td>'.$jeu->getTelechargement().'</td>
			</tr>';
    	}
    	*/?>
    </table>
</div>


<?php pied(); ?>