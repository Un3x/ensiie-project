<?php
	require("../inc/inc.default.php");
	require("../inc/inc.nav.php");
	require("../src/Article/Article.php");
	require("../src/Article/ArticleRepository.php");
	require("../src/Membre/Membre.php");
	entete("Comptes-rendus");
	
	$id_page="debrief";
	navAccueil();
	
	$dbName = 'realitiie';
	$dbUser = 'postgres';
	$dbPassword = 'postgres';
	$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

	$articleRepository = new \Article\ArticleRepository($connection);
	$articles = $articleRepository->fetchCompteRendu();
?>

<?php
	$i = 2;
	foreach($articles as $article){
		if ($article->getDate() > getDate()){
			if ($i == 1)
				$i = 2;
			else
				$i = 1;
			
			echo '<div class="CR-border'.$i.'">
			<h3>'.$article->getTitre().'</h3>';
		
			$imgs = $articleRepository->getMedias($article->getId());
			foreach($imgs as $img){
				if(file_exists($img) == true){
						echo '<img src='.$img.' alt="img not found" width="100" height="100"/>'; 
				}
			}
		
			echo '<p>'.$article->getTexte().'</p>
			<p> Auteur : '.$article->getAuteur()->getSurnom().'</p>
			</div><p></p>';
		}
	}
?>

<?php pied(); ?>