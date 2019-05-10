<?php
	require("../inc/inc.default.php");
	require("../inc/inc.nav.php");
	require("../src/Jeu/Jeu.php");
	require("../src/Jeu/JeuRepository.php");
	
	entete("Projets");
	navAccueil();
	
	$dbName = 'realitiie';
	$dbUser = 'postgres';
	$dbPassword = 'postgres';
	$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

	$JeuRepository = new \Jeu\JeuRepository($connection);
	$Jeu = new \Jeu\Jeu($connection);
	
	//Postgres
	$jeux = $JeuRepository->fetchAll();
?>

<h2>PROJETS!</h2>
<div>
<p>Voici ce dont les membres de l'association sont capable!</p>
</div>
<div>
<table>
    	<tr><th></th><th>Titre</th><th>Téléchargement</th></tr>
		
		<!-- A retirer : à titre d'exemple
		<tr><td><img src=""/></td><td>Overcraft</td><td>dwl</td></tr>
		<tr><td><img src="../img/jeux/fight_door.png" height ="150" width="150"/></td><td>Fight for the Door</td><td>dwl</td></tr>
		<tr><td><img src="../img/jeux/Restroom.png" height ="150" width="150"/></td><td>Restroom</td><td><a href="../data/jeux/toto.rar">dwl</a></td></tr>
    	-->
		<?php // A TESTER
    	foreach ($jeux as $jeu) {
			$img = $jeu->getTitre();
			$image = "../img/jeux/".$img.".png";
			if(file_exists($img) == false){
				$img = "";
			}
					
    	    echo 
    	    '<tr>
				<td>'.$jeu->getTitre().'</td>
				<td><a href='.$jeu->getTelechargement().' download='.$jeu->getTitre().'>download</a></td>
			</tr>';
    	}
		
    	?>
    </table>
</div>


<?php pied(); ?>