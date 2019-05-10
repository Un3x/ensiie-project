<?php
session_start();
if (!isset($_SESSION['authent'])) {
    $_SESSION['authent'] = 0;
}
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

$phoRepository=new \User\PhotoRepository($connection);
$ProdRepository=new \User\ProduitRepository($connection);

require 'connexion.php';


require("header.php");
?>

<section>
    <?php
        if (!isset($_GET['pseudo'])){
            if ($_SESSION['authent'] == 0) {
                echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
                exit();
            }

            else{
                $_GET['pseudo']=$_SESSION['pseudo'];
            }
        }

        if ($_SESSION['authent']==0){
            echo "Vous devez être connecté pour voir le contenu d'un profil";
            exit();
        }
        $CurrUser = $userRepository->testpseudo($_GET['pseudo']);
        if ($CurrUser==[]){
            echo "Ce profil n'existe pas.<br/>Redirection en cours...";
            echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
            exit();
        }
        $cheminphoto=$userRepository->getPhoto($_GET['pseudo']);
        if ($_GET['pseudo']==$_SESSION['pseudo']){
            echo "<h1 class=\"section\">Mon Profil</h1>";
        }

        else{
            echo "<h1 class=\"section\">Profil de ".$_GET['pseudo']."</h1>";
        }
    ?>
    <h2 class="sous_titre"><?php echo $CurrUser[0]->getId(); ?></h2>
    <!-- FAIRE DES COLONES -->
    <div class="rowInfo">
        <div class="columnPP">
            <img class="photo_profil" src=<?php echo $cheminphoto;?> alt="Photo de profil"/>
        </div>
        <div class="columnInfo" id="infos">
            <p>Pseudo : <?php echo $CurrUser[0]->getId(); ?></p>
            <p>Prénom : <?php echo $CurrUser[0]->getFirstname(); ?> </p>
            <p>Nom : <?php echo $CurrUser[0]->getLastname(); ?> </p>
            <p>E-mail : <?php echo $CurrUser[0]->getMail(); ?> </p>
            <p>Ville : <?php echo $CurrUser[0]->getLocation(); ?> </p>
            <p>Date de naissance : <?php echo date_format($CurrUser[0]->getBirthday(), 'd-m-Y'); ?> </p>
            <?php
            if ($_GET['pseudo']==$_SESSION['pseudo']){
                echo "<button class=\"boutton\" onclick=\"showform()\" style=\"width:auto;\">Modifier mes infos</button>";
            }
            ?>
        </div>
        <div class="columnInfo" id="formulaire" style="display: none;">
            <form action="" method="post" class="form" enctype="multipart/form-data">
                Nom <span class="red">*</span> : <br/><input type="text" size="20" maxlength="30" name="nom" placeholder="Nom"> <br/>
	  	        Prénom <span class="red">*</span> : <br/><input type="text" size="20" maxlength="30" name="prenom" placeholder="Prénom"> <br/>
	  	        Pseudo <span class="red">*</span> : <br/><input type="text" size="20" maxlength="30" name="id_user" placeholder="Pseudo"> <br/>
	  	        Adresse mail <span class="red">*</span> : <br/><input type="text" name="email" placeholder="Email"> <br/>
		        Mot de passe <span class="red">*</span> : <br/><input type="password" size="20" name="mdp" placeholder="Mot de passe"> <br/>
		        Verification mot de passe <span class="red">*</span> : <br/><input type="password" size="20" name="mdpverif" placeholder="Mot de passe"> <br/>
	  	        Date de naissance : <br/><input type="date" name="bday" value=<?php echo (new DateTime())->format('Y-m-d'); ?>> <br/>
	  	        Ville <span class="red">*</span> : <br/><input type="text" name="ville" placeholder="Ville"> <br/>
		        Photo de profil : <br/><input type="file" id="image_uploads" name="pp">
                <div class="preview">
    	
                </div>
                <div class="flexbox_boutton">
			        <div class="bouton">
				        <input type="submit" value="Envoyer" name="modification_bouton">
			        </div>
                    <div class="bouton">
				        <input type="reset" onclick="updateImageDisplay()" value="Annuler" name="reset_bouton">
			        </div>
		        </div>
	        </form>
            <p>Appuyez sur "Envoyer" même si vous n'avez rien modifié. "Don't worry... Be happy !"
        </div>
    </div>

    <script>
        function showform() {
            var infos = document.getElementById("infos");
            var form = document.getElementById("formulaire");
            if (form.style.display === "none") {
                form.style.display = "block";
                infos.style.display = "none";
            }
        } 
    </script>

    <?php
    if ($_GET['pseudo']==$_SESSION['pseudo']){
        echo "<h2 class=\"sous_titre\">Mes annonces</h2>";
    }
    else{
        echo "<h2 class=\"sous_titre\">Les annonces de ".$_GET['pseudo'] ."</h2>";
    }
    ?>
    <div class="produits">
    <?php 
        $prods=array_reverse($ProdRepository->getProdofUser($_GET['pseudo']));
        foreach ($prods as $prod){
                $ProdRepository->afficheProd($prod);
                if ($_GET['pseudo']==$_SESSION['pseudo']) echo "<button class=\"supp\" onclick=\"\">&#128465; Supprimer</button>";
        }

        if ($prods==[]){
            if ($_GET['pseudo']==$_SESSION['pseudo']) echo "Vous n'avez posté aucune annonce";
            else {
                echo $_GET['pseudo']." n'a posté aucune annonce";
            }
        }
    ?>

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