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
		Nom <span class="red">*</span> : <input type="text" size="20" maxlenght="30" name="nom" placeholder="Nom" required>
	  Prénom <span class="red">*</span> : <input type="text" size="20" maxlenght="30" name="prenom" placeholder="Prénom" required>
	  Pseudo <span class="red">*</span> : <input type="text" size="20" maxlenght="30" name="id_user" placeholder="Pseudo" required>
	  Adresse mail <span class="red">*</span> : <input type="text" name="email" placeholder="Email" required>
	  Mot de passe <span class="red">*</span> : <input type="password" size="20" name="mdp" placeholder="Mot de passe" required>
	  Date de naissance : <input type="date" name="bday"> <!-- ne fonctionne pas sur safari ou explorer... -->
	  Ville <span class="red">*</span> : <input type="text" name="ville" placeholder="Ville" required>
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