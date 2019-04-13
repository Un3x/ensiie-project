<head>
	<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

<?php
require '../src/Article/Article.php';
require '../src/Article/ArticleRepository.php';
require '../src/Membre/Membre.php';
require '../src/Membre/MembreRepository.php';

if(isset($_SESSION['pseudo'])){ //Si pas connecté, renvoie vers la page de connexion
    header("location: ../public/connexion.php");
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

$membreRepository = new \Membre\MembreRepository($connection);
$membres = $membreRepository->fetchAll();

if($article == NULL){ //Si article introuvable, renvoie vers la page de d'administration des articles
    echo '<h4>Erreur: l\'article n°'.$_GET['id'].' est introuvable!</h4>';
    echo '<h4>Redirection vers la liste des article...</h4>';
    header( "refresh:3;url=article.php" );
}else{

    echo '<h1>Modification de l\'article n°'.$article->getId().'</h1>';
    
    ?>
    <div class="modifContainer">
        <form action="">
        
        	<label>Titre : </label><input id="titre" type="text" value="<?php echo $article->getTitre() ?>"/>
        	<br/>
        	<label>Texte : </label><textarea id="texte" rows="5" cols="40"><?php echo $article->getTexte() ?></textarea>
        	<br/>
        	<label>Auteur : </label>
        	<select>
        		<?php
        		foreach ($membres as $membre){
        		    echo '<option value="'.$membre->getId().'">'.$membre->getSurnom().'</option>';
        		}
        		?>
        	</select>
        	<br/>
        	<input type="submit" value="Envoyer"/>
        </form>
    </div>
    
    <form action=""><input type="submit" class="moins" value="Supprimer l'article"/></form>
 
<?php
}
?>

</body>