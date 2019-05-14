<head>
	<link rel="stylesheet" href="../CSS/style.css">
	<script rel="text/javascript" src="../JS/ajoutMedia.js"></script>
</head>

<?php
$id_page="admin";
require '../src/Article/Article.php';
require '../src/Article/ArticleRepository.php';
require '../src/Membre/Membre.php';
require '../src/Membre/MembreRepository.php';
require( "../inc/inc.default.php" );
require( "../inc/inc.nav.php" );
entete( "Accueil" ,$id_page);
navAccueil();

if(!isset($_SESSION['pseudo'])){ //Si pas connecté, renvoie vers la page de connexion
    require( "../inc/connexionForm.php" );
    exit();
}

if(!isset($_GET['idArticle'])){ //Si pas connecté, renvoie vers la page de connexion
	header("location:../private/article.php");
}

$idArticle = htmlspecialchars_decode( $_GET['idArticle']);

if( isset($_POST['modificationMedia'] ) )
{
	$articleRepository = new \Article\ArticleRepository($connection);
	echo "patate";
	$status = $articleRepository->deleteAllMedia($idArticle);
	$i = 1;
	$envoie = TRUE;
	while( isset( $_FILES[ 'media'.$i ] ) )
	{
		$lien = "../media/";
		$lien = $lien . basename($_FILES['media'.$i]['name']);
		if(!move_uploaded_file($_FILES['media'.$i]['tmp_name'], $lien)) {
			echo '<h1>'.var_dump($lien).'</h1>';
			$envoie = FALSE;
			break;
		}else{
			$articleRepository->addMedia($idArticle, $lien);
		}
		$i = $i + 1;
	}
	if($status && $envoie){
        echo '<h4>Les modifications on été faites</h4>';
    }else{
        echo '<h4>Erreur: la modification a échouée</h4>';
    }
    
    echo '<h4>Redirection vers la liste des articles...</h4>';
    header( "refresh:3;url=article.php" );
}
else
{
?>
	<div class="modifContainer">
		<form id="formAjout" action="" method="POST" enctype="multipart/form-data">
			
			<br/><br/>
			
			<input type="button" id="bAjoutMedia" onclick="ajoutMedia()" value="Ajouter une image" />
			<input type="button" id="bSuppMedia" onclick="suppMedia()" style="background-color:red" value="Supprimer la dernière image" />
			
			<input type="submit" id="bEnvoyer" name="modificationMedia" value="Envoyer"/>
		</form>
	</div>
<?php
}
?>