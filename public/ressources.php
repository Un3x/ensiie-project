<?php
	$id_page="ressources";
	require("../inc/inc.default.php");
	require("../inc/inc.nav.php");
	require("../src/Tuto/Tuto.php");
	require("../src/Tuto/TutoRepository.php");
	entete("Ressources",$id_page);
	
	navAccueil();

	$dbName = 'realitiie';
	$dbUser = 'postgres';
	$dbPassword = 'postgres';
	$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

	$TutoRepository = new \Tuto\TutoRepository($connection);
	$tutos = $TutoRepository->fetchAll();
	
	
?>

<div class="round-border">
	<h3>Voici des tutos qui pourront vous aider dans vos projets!</h3>
</div>
<br/>
<?php 
	foreach($tutos as $tuto){
		echo '<div class="round-border">
			<p>'.$tuto->getTitre().'</p>';
		
		$imgs = $TutoRepository->getMedias($tuto->getId());;
		foreach($imgs as $img){
			if(file_exists($img) == true){
					echo '<img src='.$img.' alt="img not found" width="100" height="100"/>'; 
			}
		}
		
		echo '<p>'.$tuto->getTexte().'</p>
			<p>
				<a href="../document/Tuto/'.$tuto->getPdf().'">
					view '.$tuto->getTitre().'.pdf
				</a>
			</p>
			</div><br/>';
	}
?>

<?php pied(); ?>