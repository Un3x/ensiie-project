<?php

include ("utils.php");


session_start();

require '../vendor/autoload.php';

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();


$echec_co = false;

// connexion

if (isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['connexion'])) {
	$pseudo=$_POST['pseudo'];
	$mdp=$_POST['mdp'];
	foreach ($users as $user) {
		if ($user->getPseudo() == $pseudo) {
			if (password_verify($mdp, $user->getMdp())) {
				$_SESSION["id_user"] = $user->getId();
				header("Location:index.php");
			}				
		}
	}
	$echec_co = true;
}




// inscription
$ok_pseudo = 1;
$ok_nom = 1;
$ok_mdp = 1;

if (isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['pseudo'])&&isset($_POST['mdp'])&&isset($_POST['cmdp'])&&isset($_POST['ddn'])&&isset($_POST['email'])&&isset($_POST['inscription'])) {
    
	if (!verifPseudo($_POST['pseudo'])) {
			$ok_pseudo = 0;
	}
	if (!verifNomPrenom($_POST['nom'], $_POST['prenom']) ) {
			$ok_nom = 0;
	}
	if ($_POST['mdp'] != $_POST['cmdp']) {
			$ok_mdp = 0;
	}
	if ($ok_pseudo && $ok_nom && $ok_mdp) {
			$id_newUser = genereIdUser();
			$newUser = $userRepository->creeUser($id_newUser, $_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['ddn'], $_POST['mdp'], $_POST['email'], '0', '0', 'false');
			$userRepository->insertUser($newUser);

			$_SESSION['id_user'] = $id_newUser;

			header("Location: index.php");
	}
}

?>


<html>
	<head>
		<meta charset="utf-8"/>
		<title>Page de connexion de Sciience</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="formulaire_small.css">
		<link rel="stylesheet" href="connexion.css">
		<script type="text/javascript" src="./script_connexion.js"></script>
		
	</head>
	<body>
		<header>
      <a href="index.php"><img src="./titre.png"/></a>
    </header>
		<section class="connect">
			<div class="container">
				<div class="grand-titre">Bienvenue sur la page de connexion de Sciience</div>
			</div>
			<div class="onglets">
				<span class="onglet onglet_non_select" id="onglet_connexion" onclick="change_onglet('connexion', 0);">Se connecter</span>
				<span class="onglet onglet_non_select" id="onglet_inscription" onclick="change_onglet('inscription', 0);">S'inscrire</span>
			</div>			
			<div class="contenu_onglet" id="contenu_onglet_connexion">
					<h1>Connexion</h1>
					<?php 
						if($echec_co) 
							echo '<span class="invalid_submit">Pseudo ou mot de passe invalide !</span>';
							echo $echec_co;
					?>
					<form class="form_connexion" action="connexion.php" method="Post">
						<!-- champs caché pour savoir si on vient de connexion ou inscription -->
						<input type="hidden" name="connexion" value="42"/> 
						Pseudo : <br>
						<input class="formulaire" type="text" name="pseudo"><br>
						Mot de Passe : <br>
						<input class="formulaire" type="password" name="mdp"><br>
						<input class="formulaire_connexion" type="submit" class="butcon" value="Se connecter">
					</form>
			</div>
			<div class="contenu_onglet" id="contenu_onglet_inscription">
					<h1>Inscription</h1>
					<?php 
						if($ok_pseudo == 0 || $ok_mdp == 0 || $ok_nom == 0) {
							echo '<span class="invalid_submit">Inscription invalide !</span></br>';
							if($ok_nom == 0) 
								echo '<span class="invalid_submit">Le couple Prénom/Nom apparaît déjà dans nos bases de données. Avez-vous déjà un compte ?</span>';
							else if ($ok_pseudo == 0) 
								echo '<span class="invalid_submit">Ce pseudo existe déjà !</span>';							
							else if (!$ok_mdp == 0) 
								echo '<span class="invalid_submit">Vos mots de passe doivent être identiques !</span>';						
						}			
					?>
					<form class="form" action="connexion.php" method="POST">
						<!-- champs caché pour savoir si on vient de connexion ou inscription -->
						<input type="hidden" name="inscription" value="42"/> 
            Nom :<br>
            <input class="formulaire" type="text" name="nom" required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br>
            Prenom :<br>
            <input class="formulaire" type="text" name="prenom" required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br>
            Pseudo :<br>
            <input class="formulaire" type="text" name="pseudo" required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br>
            Mot de passe :<br>
            <input class="formulaire" id="m1" type="password" name="mdp" required /><br>
            Confirmation du mot de passe :<br>
            <input class="formulaire" id="m2" type="password" name="cmdp" oninput="check_mdp(this)" required /><br>
            Date de naissance :<br>
            <input class="formulaire" type="date" name="ddn" required /><br>
            Email :<br>
            <input class="formulaire" type="text" name="email" required pattern="[a-zA-Z0-9._-]*@[a-zA-Z0-9-]*.[a-zA-Z]*" maxlength="50"/><br>
            <input class="formulaire" id="valider" type="submit" value="S'inscrire"/>
        </form>					
			</div>            
      <p></p>
		</section>
	</body>
	<script>
		// si l'un des 3 est false, c'est que l'utilisateur était sur inscription et l'a foiré donc 
		// on le remet sur inscription
		if ( <?php echo $ok_nom ?> == 0 || <?php echo $ok_pseudo ?> == 0 || <?php echo $ok_mdp ?> == 0 ) {
			change_onglet('inscription', 1);
		}
		else {
			// sinon sur connexion
			change_onglet('connexion', 2);
		}		
	</script>
</html>

