<head>
	<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

<?php
require( "../inc/inc.default.php" );
require( "../inc/inc.nav.php" );
entete( "Accueil" );
navAccueil();

if(isset($_SESSION['pseudo'])){ //Si pas connecté, renvoie vers la page de connexion
    header("location: connexion.php");
}

if(isset($_POST['modification'])){ //Si mot de passe est modifié, modification de la bdd puis rechargement de la page de d'administration
    $dbName = 'realitiie';
    $dbUser = 'postgres';
    $dbPassword = 'postgres';
    $connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");
    
    $membreRepository = new \Membre\MembreRepository($connection);
    
    if($_POST['password'] == $_POST['conf_password']){
        $status = $membreRepository->setMembrePassword($_SESSION['id'], $_POST['password']);
        
        if($status){
            echo '<h4>Le mot de passe a bien été modifié</h4>';
        }else{
            echo '<h4>Erreur: le changement du mot de passe a échoué!</h4>';
        }
    }else{
        echo '<h4>Les deux mot de passes sont différents, veuillez réessayer</h4>';
    }
    
    echo '<h4>Redirection vers la page d\'administration...</h4>';
    header( "refresh:3;url=admin.php" );
}else{

    ?>
    
    <h1>Page d'administration</h1>
    
    <br/><br/>
    
    <h2>Bienvenue sur la page d'administration du site de l'association de Realitiie</h2>
    <br/>
    <h2>Choissiez quelle partie du site vous souhaitez éditer :</h2>
    <br/><br/><br/>
    
    <form action="article.php"><input type="submit" class="admin" value="Articles"/></form>
    <form action="jeux.php"><input class="admin" type="submit" value="Projets"/></form>
    <form action="membre.php"><input class="admin" type="submit" value="Membres"/></form>
    
    <br/><br/><br/>
    <h3>Vous pouvez changer votre mot de passe ici :</h3>
    <form action="">
    	<label>Nouveau mot de passe : </label><input name="password" type="password" required/>
    	<label>Confirmer nouveau mot de passe : </label><input name="conf_password" type="password" required/>
    	<input type="submit" name="modification" value="Envoyer"/>
    </form>
    
    <?php
}
?>
</body>

<?php
	pied();
?>