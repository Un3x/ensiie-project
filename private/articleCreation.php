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

if(isset($_SESSION['pseudo'])){ //Si pas connecté, renvoie vers la page de connexion
    header("location: ../public/connexion.php");
}

$dbName = 'realitiie';
$dbUser = 'postgres';
$dbPassword = 'postgres';
$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

$articleRepository = new \Article\ArticleRepository($connection);

if(isset($_POST['creation'])){ //Si l'article est créé, modification de la bdd puis renvoie vers la page de d'administration des articles
    $status = $articleRepository->createArticle($_POST['titre'], $_POST['texte'], $_POST['auteur'], $_POST['date']);
    
    if($status){
        echo '<h4>L\'article a bien été créé</h4>';
    }else{
        echo '<h4>Erreur: la création de l\'article n°'.$_GET['id'].' a échoué!</h4>';
    }
    
    echo '<h4>Redirection vers la liste des articles...</h4>';
    header( "refresh:3;url=article.php" );
}else{
    
    $membreRepository = new \Membre\MembreRepository($connection);
    $membres = $membreRepository->fetchAll();

    echo '<h1>Création d\'un article</h1>';
                
    ?>
    <div class="modifContainer">
        <form action="" method="POST">
        	<label>Titre : </label><input name="titre" type="text" required/>
        	<br/>
        	<label>Texte : </label><textarea name="texte" rows="5" cols="40" required></textarea>
        	<br/>
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
        	<label>Date de publication : </label><input name="date" type="date" required/>
        	<input type="submit" name="creation" value="Envoyer"/>
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