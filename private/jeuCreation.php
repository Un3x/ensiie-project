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

if(!isset($_SESSION['pseudo'])){ //Si pas connecté, renvoie vers la page de connexion
    require( "../inc/connexionForm.php" );
    exit();
}

$dbName = 'realitiie';
$dbUser = 'postgres';
$dbPassword = 'postgres';
$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

$jeuRepository = new \Jeu\JeuRepository($connection);

if(isset($_POST['creation'])){ //Si le jeu est créé, modification de la bdd puis renvoie vers la page de d'administration des jeux
    $status = $jeuRepository->createJeu($_POST['titre'], $_POST['git'], $_POST['telechargement']);
    
    if($status){
        echo '<h4>Le projet a bien été créé</h4>';
    }else{
        echo '<h4>Erreur: la création du nouveau projet a échoué!</h4>';
    }
    
    echo '<h4>Redirection vers la liste des projets...</h4>';
    header( "refresh:3;url=jeux.php" );
}else{

    echo '<h1>Création d\'un projet</h1>';
                
    ?>
    <div class="modifContainer">
        <form action="" method="POST">
        	<label>Titre : </label><input name="titre" type="text" required/>
        	<br/>
        	<label>Lien du git : </label><textarea name="git" rows="5" cols="40" required></textarea>
        	<br/>
        	<label>Lien de téléchargement : </label><textarea name="telechargement" rows="5" cols="40" required></textarea>
        	<input type="submit" name="creation" value="Envoyer"/>
        </form>
    </div>
    
    <form action="jeux.php"><input type="submit" class="moins" value="Annuler"/></form>
 
<?php
}
?>

</body>

<?php
	pied();
?>