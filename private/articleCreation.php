<head>
	<link rel="stylesheet" href="../CSS/style.css">
	<script rel="text/javascript" src="../JS/ajoutMedia.js"></script>
</head>

<body>

<?php
require '../src/Article/Article.php';
require '../src/Article/ArticleRepository.php';
require '../src/Membre/Membre.php';
require '../src/Membre/MembreRepository.php';
require( "../inc/inc.default.php" );
require( "../inc/inc.nav.php" );
entete( "Accueil" );
navAccueil();

if(!isset($_SESSION['pseudo'])){ //Si pas connecté, renvoie vers la page de connexion
    require( "../inc/connexionForm.php" );
    exit();
}

$articleRepository = new \Article\ArticleRepository($connection);

if(isset($_POST['creation'])){ //Si l'article est créé, modification de la bdd puis renvoie vers la page de d'administration des articles
    if(!isset($_POST['auteur'])){
        $_POST['auteur'] = $_SESSION['id'];
    }
    
    $status = $articleRepository->createArticle($_POST['titre'], $_POST['texte'], $_POST['auteur'], $_POST['date']);
    
    if($status){
        echo '<h4>L\'article a bien été créé</h4>';
    }else{
        echo '<h4>Erreur: la création du nouvel article a échoué!</h4>';
    }
    
    echo '<h4>Redirection vers la liste des articles...</h4>';
    header( "refresh:3;url=article.php" );
}else{
    
    $membreRepository = new \Membre\MembreRepository($connection);
    $membres = $membreRepository->fetchAll();

    echo '<h1>Création d\'un article</h1>';
                
    ?>
    <div class="modifContainer">
        <form id="formAjout" action="" method="POST">
        	<label>Titre : </label><input name="titre" type="text" required/>
        	<br/>
        	<label>Texte : </label><textarea name="texte" rows="5" cols="40" required></textarea>
        	<br/>
        	<?php if($_SESSION['role'] == 'a'){?>
        		<label>Auteur : </label>
            	<select name="auteur" required>
            		<?php
            		//if($membre->getId() = $article->getAuteur()->getId()){echo "selected";}
            		foreach ($membres as $membre){
            		    echo '<option value="'.$membre->getId().'">'.$membre->getSurnom().'</option>';
            		}
            		?>
            	</select>
            	<br/>
            <?php } ?>
            
        	<label>Date de publication : </label><input name="date" type="date" required/>
        	
        	<br/><br/>
        	
        	<input type="button" id="bAjoutMedia" onclick="ajoutMedia()" value="Ajouter une image" />
			<input type="button" id="bSuppMedia" onclick="suppMedia()" style="background-color:red" value="Supprimer la dernière image" />
        	
        	<input type="submit" id="bEnvoyer" name="creation" value="Envoyer"/>
        </form>
    </div>
    
    <form action="article.php"><input type="submit" class="moins" value="Annuler"/></form>
 
<?php
}
?>

</body>

<?php
	pied();
?>