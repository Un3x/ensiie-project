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
	$jeux = $JeuRepository->fetchAll();
?>

<h2>PROJETS!</h2>
<div>
<p>Voici ce dont les membres de l'association sont capable!</p>
</div>
<div>
<table>
    	<tr><th></th><th>Titre</th><th>Git</th><th>Téléchargement</th></tr>
		
		<?php
    	foreach ($jeux as $jeu) {
			$img = $jeu->getTitre();
			$img = "../img/jeux/".$img.".png";
			if(file_exists($img) == false){
				$img = "../img/RobotRealitIIE.png";
			}
					
    	    echo 
    	    '<tr>
				<td><img src='.$img.' alt="404 : game not found" width="150" height="150"/></td>
				<td>'.$jeu->getTitre().'</td>
				<td>'.$jeu->getGit().'</td>
				<td><a href=../data/jeux/'.$jeu->getTelechargement().' download='.$jeu->getTitre().'>download</a></td>
			</tr>';
    	}
		
    	?>
    </table>
</div>


<?php pied(); ?>