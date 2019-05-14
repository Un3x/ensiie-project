<head>
	<link rel="stylesheet" href="../CSS/style.css">
	<script rel="text/javascript" src="../JS/ajoutMedia.js"></script>
</head>

<body>

<?php
$id_page="admin";
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

$dbName = 'realitiie';
$dbUser = 'postgres';
$dbPassword = 'postgres';
$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

$membreRepository = new \Membre\MembreRepository($connection);

$roles = array('a' => "Administrateur", 'r' => "Membre"); // à compléter si ajout de nouveaux rôles

if(isset($_POST['creation'])){ //Si le membre est créé, modification de la bdd puis renvoie vers la page de d'administration des membres
	$status = $membreRepository->createMembre($_POST['nom'], $_POST['prenom'], $_POST['surnom'], $_POST['password'], $_POST['promo'], $_POST['role']);

	$i = 1;
	$envoie = TRUE;
	while( isset($_FILES['media'.$i] )) {
		$lien = "../media/";
		$lien = $lien . basename($_FILES['media'.$i]['name']);
		if(!move_uploaded_file($_FILES['media'.$i]['tmp_name'], $lien)) {
			echo '<h1>'.var_dump($lien).'</h1>';
			$envoie = FALSE;
			break;
		}else{
			$membreRepository->addMedia($idMembre, $lien);
		}
		$i = $i + 1;
	}
	
    if($status){
        echo '<h4>Le membre a bien été créé</h4>';
    }else{
        echo '<h4>Erreur: la création du nouveau membre a échoué!</h4>';
    }
    
    echo '<h4>Redirection vers la liste des membres...</h4>';
    header( "refresh:3;url=membre.php" );
}else{

    echo '<h1>Création d\'un membre</h1>';
                
    ?>
    <div class="modifContainer">
        <form action="" method="POST"  enctype="multipart/form-data" id="formAjout">
        	<label>Nom : </label><input name="nom" type="text" required/>
        	<br/>
        	<label>Prénom : </label><input name="prenom" type="text" required/>
        	<br/>
        	<label>Surnon : </label><input name="surnom" type="text" required/>
        	<br/>
        	<label>Mot de passe : </label><input name="password" type="password" required/>
        	<br/>
        	<label>promo : </label>
        	<select name="promo" required>
        		<?php
        		foreach (range(date("Y") + 3, 1968, 1) as $promo){
        		    echo '<option value="'.$promo.'">'.$promo.'</option>';
        		}
        		?>
        	</select>
        	<br/>
        	<label>role : </label>
        	<select name="role" required>
        		<?php
        		foreach ($roles as $roleChar => $roleName){
        		    echo '<option value="'.$roleChar.'">'.$roleName.'</option>';
        		}
        		?>
        	</select>
			<input type="button" id="bAjoutMedia" onclick="ajoutMedia()" value="Ajouter une image" />
			<input type="button" id="bSuppMedia" onclick="suppMedia()" style="background-color:red" value="Supprimer la dernière image" />
        	<input type="submit" ib="bEnvoyer"  name="creation" value="Envoyer"/>
        </form>
    </div>
    
    <form action="membre.php"><input type="submit" class="moins" value="Annuler"/></form>
 
<?php
}
?>

</body>

<?php
	pied();
?>