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
<?php 
if (isset($_POST['id_user'],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['mdp'],$_POST['bday'],$_POST['ville'],$_POST['mdpverif']))
	{
		$_POST['id_user']=htmlspecialchars($_POST['id_user']);
		$_POST['nom']=htmlspecialchars($_POST['nom']);
		$_POST['prenom']=htmlspecialchars($_POST['prenom']);
		$_POST['email']=htmlspecialchars($_POST['email']);
		$_POST['mdp']=htmlspecialchars($_POST['mdp']);
		$_POST['bday']=htmlspecialchars($_POST['bday']);
		$_POST['ville']=htmlspecialchars($_POST['ville']);
		$_POST['mdpverif']=htmlspecialchars($_POST['mdpverif']);
		$datetime=DateTime::createFromFormat('Y-m-d', $_POST['bday']);
		if($_POST['bday'] == null) $_POST['bday']="1800-01-01";
		$date=explode("-",$_POST['bday']);
		$annee=$date[0];
		$now=new \DateTime();
		$verif=1;
		if ($now < $datetime && $verif==1){
			 echo "<span class=\"red\">Vous n'êtes pas encore né</span><br/>";
			 $verif=0;
		}
		$age=$now->diff($datetime)->y;
		if ($age<19 && $verif==1){
			echo "<span class=\"red\">Vous devez avoir 18 ans pour vous inscrire à TrouveTonTruc</span><br/>";
			$verif=0;
		}

		if ($age>130 && $verif==1){
			echo "<span class=\"red\">Veuillez rentrer une date de naissance valide</span><br/>";
			$verif=0;
		}
		if (($_POST['mdp'] != $_POST['mdpverif']) && $verif==1){
			echo "<span class=\"red\">Vos mots de passe ne sont pas similaires</span><br/>";
			$verif=0;
		}

		if ((strlen($_POST['mdp']) <8) && $verif==1){
			echo "<span class=\"red\">Votre mot de passe doit contenir au moins 8 caractères</span><br/>";
			$verif=0;
		}

		if (($userRepository->testpseudo($_POST['id_user']) != []) && $verif==1){
			echo "<span class=\"red\">Ce pseudo est déjà pris</span><br/>";
			$verif=0;
		}

		if ((!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) && $verif==1){
			echo "<span class=\"red\">Votre adresse email n'a pas le bon format</span><br/>";
			$verif=0;
		}
		
		if (($userRepository->testmail($_POST['email']) != []) && $verif==1){
			echo "<span class=\"red\">Il y a déjà un compte avec cette adresse email</span><br/>";
			$verif=0;
		}

		if ((isset($_FILES['pp']) AND $_FILES['pp']['error']==0) && $verif==1){
			if (($_FILES['pp']['size'] <= 2000000) && $verif==1)
			{
				$infosfichier=pathinfo($_FILES['pp']['name']);
				$extension_upload=$infosfichier['extension'];
				$extension_autorisees=array('jpg','jpeg','gif','png','JPG','PNG','GIF','JPEG');
				if ((in_array($extension_upload,$extension_autorisees) && $verif==1))
				{
					move_uploaded_file($_FILES['pp']['tmp_name'],'uploads/'.basename($_FILES['pp']['name']));
				}

				else{
					echo "<span class=\"red\">Le type de votre image n'est pas accepté (jpg, jpeg, png, gif only)</span><br/>";
					$verif=0;
				}
			}

			else{
				echo "<span class=\"red\">Votre fichier est à une taille trop grande</span><br/>";
				$verif=0;
			}
		}

		if ($verif==1){
			echo "Please wait..";
			$req=$connection->prepare("INSERT INTO utilisateur (id, firstname, lastname, birthday, loc, mail, mdp, administrateur,valid) VALUES (:id, :prenom, :nom, :date_naissance, :loc, :mail, :motdepasse, 0,0)");
			$params = array(
				'id' => $_POST['id_user'],
				'prenom' => $_POST['prenom'],
				'nom' => $_POST['nom'],
				'date_naissance' => $_POST['bday'],
				'loc' => $_POST['ville'],
				'mail' => $_POST['email'],
				'motdepasse' => $_POST['mdp']
			);
			$req->execute($params);
			echo "<meta http-equiv=\"Refresh\" content=\"2;url=inscriptionsuccess.php\">";
			exit();
		}		
	} 
	?>

	<div class="form">
	<h1 class="section">Inscription</h1>
	<h2 class="sous_titre">Création de votre profil</h2>
	<p>Veuillez compléter les champs suivants.<br>Les champs munis d'un <span class="red">*</span> sont obligatoires.</p>
	<form action="" method="post" class="form" enctype="multipart/form-data">
		Nom <span class="red">*</span> : <br/><input type="text" size="20" maxlength="30" name="nom" placeholder="Nom" required> <br/>
	  	Prénom <span class="red">*</span> : <br/><input type="text" size="20" maxlength="30" name="prenom" placeholder="Prénom" required> <br/>
	  	Pseudo <span class="red">*</span> : <br/><input type="text" size="20" maxlength="30" name="id_user" placeholder="Pseudo" required> <br/>
	  	Adresse mail <span class="red">*</span> : <br/><input type="text" name="email" placeholder="Email" required> <br/>
		Mot de passe <span class="red">*</span> : <br/><input type="password" size="20" name="mdp" placeholder="Mot de passe" required> <br/>
		Verification mot de passe <span class="red">*</span> : <br/><input type="password" size="20" name="mdpverif" placeholder="Mot de passe" required> <br/>
	  	Date de naissance : <br/><input type="date" name="bday" value=<?php echo (new DateTime())->format('Y-m-d'); ?>> <br/>
	  	Ville <span class="red">*</span> : <br/><input type="text" name="ville" placeholder="Ville" required> <br/>
		Photo de profil : <br/><input type="file" id="image_uploads" name="pp">
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