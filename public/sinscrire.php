<?php

require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$catRepository = new \User\CategorieRepository($connection);
$cats = $catRepository->fetchAll();

require("header.php");

?>

<section>
	<div class="form">
	<h1 class="inscription">Inscription</h1>
	<p>Veuillez compléter les champs suivants.<br>Les champs munis d'un <span class="red">*</span> sont obligatoires.</p>
	<form action="verificationsignup.php" method="post" class="form">
		Nom <span class="red">*</span> : <br/><input type="text" size="20" maxlenght="30" name="nom" placeholder="Nom" required> <br/>
	  	Prénom <span class="red">*</span> : <br/><input type="text" size="20" maxlenght="30" name="prenom" placeholder="Prénom" required> <br/>
	  	Pseudo <span class="red">*</span> : <br/><input type="text" size="20" maxlenght="30" name="id_user" placeholder="Pseudo" required> <br/>
	  	Adresse mail <span class="red">*</span> : <br/><input type="text" name="email" placeholder="Email" required> <br/>
	  	Mot de passe <span class="red">*</span> : <br/><input type="password" size="20" name="mdp" placeholder="Mot de passe" required> <br/>
	  	Date de naissance : <br/><input type="date" name="bday"> <br/>
	  	Ville <span class="red">*</span> : <br/><input type="text" name="ville" placeholder="Ville" required> <br/>
		Photo de profil : <br/><input type="file" id="image_uploads" name="pp" accept="image/png, image/jpeg">
		<div class="preview">
    	
  		</div>
		<div class="flexbox_boutton">
			<div class="bouton">
				<input type="submit" value="Envoyer" name="inscription_bouton">
			</div>
			<div class="bouton">
				<input type="reset" onclick="updateImageDisplay()" value="Annuler" name="reset_bouton">
			</div>
		  </div>
	</form>
	</div>
</section>

<script>
	var input = document.querySelector('input[type=file]');
	var preview = document.querySelector('.preview');

	input.addEventListener('change', updateImageDisplay);

	function updateImageDisplay() 
	{
		while(preview.firstChild) {
    		preview.removeChild(preview.firstChild);
		}
		var curFiles = input.files;
		if(curFiles.length === 0) {
    		var para = document.createElement('p');
    		para.textContent = 'Aucun fichier actuellement sélectionné';
			preview.appendChild(para);
		}
		else {
     		var para = document.createElement('p');
        	var image = document.createElement('img');
        	image.src = window.URL.createObjectURL(curFiles[0]);
			preview.appendChild(image);
			preview.appendChild(para);
		}  
	}
</script>

<?php
require("aside.php");
require("footer.php");
?>