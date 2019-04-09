<?php

require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();   
include '../src/affichage/user_head.php';
include '../src/User/signin.php';
include '../src/affichage/carroussel.php';

enTete("FindYourThing.com");
aside();
navigation();
loginForm();

?>

<section>
	<h2>Inscription</h2>
	<p>Veuillez compléter les champs suivants.<br>Les champs munis d'un <span class="red">*</span> sont obligatoires.</p>
	<form action="verificationsignup.php" method="post">
		Nom <span class="red">*</span> : <input class="form_signup" type="text" size="20" maxlenght="30" name="nom">
	    Prénom <span class="red">*</span> : <input class="form_signup" type="text" size="20" maxlenght="30" name="prenom">
	    Pseudo <span class="red">*</span> : <input class="form_signup" type="text" size="20" maxlenght="30" name="id_user">
	    Adresse mail <span class="red">*</span> : <input class="form_signup" type="text" name="email">
	    Mot de passe <span class="red">*</span> : <input class="form_signup" type="password" size="20" name="mdp">
	    Date de naissance <span class="red">*</span> : <input type="date" name="bday"> <!-- ne fonctionne pas sur safari ou explorer... -->
	    Ville <span class="red">*</span> : <input class="form_signup" type="text" name="ville">
		Photo de profil : <input type="file" name="pp" accept="image/png, image/jpeg">
		<div class="flexbox">
			<div class="bouton">
				<input type="submit" value="Envoyer" name="inscription_bouton">
			</div>
			<div class="bouton">
				<input type="reset" value="Annuler" name="reset_bouton">
			</div>
		  </div>
	</form>
</section>

<?php
pied();
?>