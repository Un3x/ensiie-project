<head>
	<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

<?php
require '../src/Jeu/Jeu.php';
require '../src/Jeu/JeuRepository.php';
require( "../inc/inc.default.php" );
require( "../inc/inc.nav.php" );
entete( "Accueil" );
navAccueil();

if(isset($_SESSION['pseudo'])){ //Si pas connecté, renvoie vers la page de connexion
    header("location: ../public/connexion.php");
}

if(!isset($_GET['id'])){ //Si aucun jeu selectionné, renvoie vers la page de d'administration des jeux
    header("location: jeux.php");
}

$dbName = 'realitiie';
$dbUser = 'postgres';
$dbPassword = 'postgres';
$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

$jeuRepository = new \Jeu\JeuRepository($connection);

$jeu = $jeuRepository->getJeu($_GET['id']);

if($jeu == NULL){ //Si jeu introuvable, renvoie vers la page de d'administration des jeux
    echo '<h4>Erreur: le projet n°'.$_GET['id'].' est introuvable!</h4>';
    echo '<h4>Redirection vers la liste des projets...</h4>';
    header( "refresh:3;url=jeux.php" );
}else if(isset($_POST['modification'])){ //Si jeu est modfifié, modification de la bdd puis renvoie vers la page de d'administration des jeux
    $status = $jeuRepository->setJeu($_GET['id'], $_POST['titre'], $_POST['git'], $_POST['telechargement']);
    
    if($status){
        echo '<h4>Le projet n°'.$_GET['id'].' a bien été modifié</h4>';
    }else{
        echo '<h4>Erreur: la modification du projet n°'.$_GET['id'].' a échoué!</h4>';
    }
    
    echo '<h4>Redirection vers la liste des projets...</h4>';
    header( "refresh:3;url=jeux.php" );
}else if(isset($_POST['supression'])){ //Si jeu est supprimé, modification de la bdd puis renvoie vers la page de d'administration des jeux
    $status = $jeuRepository->deleteJeu($_GET['id']);
    
    if($status){
        echo '<h4>Le projet n°'.$_GET['id'].' a bien été supprimé</h4>';
    }else{
        echo '<h4>Erreur: la supression du projet n°'.$_GET['id'].' a échoué!</h4>';
    }
    
    echo '<h4>Redirection vers la liste des projets...</h4>';
    header( "refresh:3;url=jeux.php" );
}else{

    echo '<h1>Modification du projet n°'.$jeu->getId().'</h1>';
                
    ?>
    <div class="modifContainer">
        <form action="" method="POST">
        	<label>Titre : </label><input name="titre" type="text" value="<?php echo $jeu->getTitre() ?>" required/>
        	<br/>
        	<label>Lien du git : </label><textarea name="git" rows="5" cols="40" required><?php echo $jeu->getGit() ?></textarea>
        	<br/>
        	<label>Lien de téléchargement : </label><textarea name="telechargement" rows="5" cols="40" required><?php echo $jeu->getTelechargement() ?></textarea>
        	<input type="submit" name="modification" value="Envoyer"/>
        </form>
    </div>
    
    <form action="" method="POST"><input name ="supression" type="submit" class="moins" value="Supprimer le projet"/></form>
 
<?php
}
?>

</body>

<?php
	pied();
?>