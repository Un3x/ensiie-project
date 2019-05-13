<head>
	<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

<?php
require '../src/Jeu/Jeu.php';
require '../src/Jeu/JeuRepository.php';
require '../src/Miseajour/Miseajour.php';
require '../src/Miseajour/MiseajourRepository.php';
require( "../inc/inc.default.php" );
require( "../inc/inc.nav.php" );
entete( "Accueil" );
navAccueil();

if(!isset($_SESSION['pseudo'])){ //Si pas connecté, renvoie vers la page de connexion
    require( "../inc/connexionForm.php" );
    exit();
}

if(!isset($_GET['id'])){ //Si aucun jeu selectionné, renvoie vers la page de d'administration des jeux
    header("location: jeux.php");
}

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
    $MajRepository = new \Miseajour\MiseajourRepository($connection);
    $majs = $MajRepository->fetchAllFromJeu($_GET['id']);
    
    echo '<h1>Modification du projet n°'.$jeu->getId().'</h1>';
                
    ?>
    <div class="modifContainer">
        <form action="" method="POST">
        	<label>Titre : </label><input name="titre" type="text" value="<?php echo $jeu->getTitre() ?>" required/>
        	<br/>
        	<label>Lien du git : </label><input name="git" type="text" value="<?php echo $jeu->getGit() ?>" required/>
        	<br/>
        	<label>Lien de téléchargement : </label><input name="telechargement" type="text" value="<?php echo $jeu->getTelechargement() ?>" required/>
        	<input type="submit" name="modification" value="Envoyer"/>
        </form>
    </div>
    
    <form action="" method="POST"><input name ="supression" type="submit" class="moins" value="Supprimer le projet"/></form>
    
    <br/><br/>
    
    <h4>Cliquez sur une mise à jour pour la modifier ou la supprimer</h4>

    <ul>
    	<?php 
    	foreach ($majs as $maj) {
    	    echo '<li><a href="miseajourModification.php?id='.$maj->getId().'">'.$maj->get_Date()->format('d/m/Y').'</li>';
    	}
    	?>
    </ul>
    
    <form action="miseajourCreation.php">
    	<input type="hidden" name="id_jeu" value="<?php echo $jeu->getId() ?>"/>
    	<input type="submit" class="plus" value="Écrire une mise à jour"/>
    </form>
    
    <br/>
    <form action="admin.php"><input type="submit" class="moins" value="Revenir à l'espace d'administration"/></form>
     
<?php
}
?>

</body>

<?php
	pied();
?>