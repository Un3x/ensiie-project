<head>
	<link rel="stylesheet" href="../CSS/style.css">
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

if(!isset($_GET['id'])){ //Si aucun article selectionné, renvoie vers la page de d'administration des articles
    header("location: article.php");
}

$dbName = 'realitiie';
$dbUser = 'postgres';
$dbPassword = 'postgres';
$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

$articleRepository = new \Article\ArticleRepository($connection);

$article = $articleRepository->getArticle($_GET['id']);

if($article == NULL){ //Si article introuvable, renvoie vers la page de d'administration des articles
    echo '<h4>Erreur: l\'article n°'.$_GET['id'].' est introuvable!</h4>';
    echo '<h4>Redirection vers la liste des articles...</h4>';
    header( "refresh:3;url=article.php" );
}else if(isset($_POST['modification'])){ //Si article est modfifié, modification de la bdd puis renvoie vers la page de d'administration des articles
    if(!isset($_POST['auteur'])){
        $_POST['auteur'] = $_SESSION['id'];
    }
    
    $status = $articleRepository->setArticle($_GET['id'], $_POST['titre'], $_POST['texte'], $_POST['auteur'], $_POST['date']);
    
    if($status){
        echo '<h4>L\'article n°'.$_GET['id'].' a bien été modifié</h4>';
    }else{
        echo '<h4>Erreur: la modification de l\'article n°'.$_GET['id'].' a échoué!</h4>';
    }
    
    echo '<h4>Redirection vers la liste des articles...</h4>';
    header( "refresh:3;url=article.php" );
}else if(isset($_POST['supression'])){ //Si article est supprimé, modification de la bdd puis renvoie vers la page de d'administration des articles
    $status = $articleRepository->deleteArticle($_GET['id']);
    
    if($status){
        echo '<h4>L\'article n°'.$_GET['id'].' a bien été supprimé</h4>';
    }else{
        echo '<h4>Erreur: la supression de l\'article n°'.$_GET['id'].' a échoué!</h4>';
    }
    
    echo '<h4>Redirection vers la liste des articles...</h4>';
    header( "refresh:3;url=article.php" );
}else{
    
    $membreRepository = new \Membre\MembreRepository($connection);
    $membres = $membreRepository->fetchAll();

    echo '<h1>Modification de l\'article n°'.$article->getId().'</h1>';
                
    ?>
    <div class="modifContainer">
        <form action="" method="POST">
        	<label>Titre : </label><input name="titre" type="text" value="<?php echo $article->getTitre() ?>" required/>
        	<br/>
        	<label>Texte : </label><textarea name="texte" rows="5" cols="40" required><?php echo $article->getTexte() ?></textarea>
        	<br/>
        	<?php if($_SESSION['role'] == 'a'){?>
            	<label>Auteur : </label>
            	<select name="auteur" required>
            		<?php
            		foreach ($membres as $membre){
            		    if($membre->getId() == $article->getAuteur()->getId()){ //Selectionne l'auteur de l'article
                            echo '<option value="'.$membre->getId().'" selected>'.$membre->getSurnom().'</option>';
            		    }else{
            		        echo '<option value="'.$membre->getId().'">'.$membre->getSurnom().'</option>';
            		    }
            		}
            		?>
            	</select>
            	<br/>
            <?php } ?>
        	<label>Date de publication : </label><input name="date" type="date" value="<?php echo $article->getDate()->format('Y-m-d') ?>" required/>
        	<input type="submit" name="modification" value="Envoyer"/>
        </form>
    </div>
    
    <form action="" method="POST"><input name ="supression" type="submit" class="moins" value="Supprimer l'article"/></form>
 
<?php
}
?>

</body>

<?php
	pied();
?>