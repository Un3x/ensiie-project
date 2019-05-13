<?php
session_start();
if (!isset($_SESSION['authent'])) {
    $_SESSION['authent'] = 0;
}

if (!isset($_SESSION['statut'])) {
    $_SESSION['statut'] = 0;
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

        if (isset($_POST['delete'],$_POST['id'])){
            $connection->query("UPDATE produits SET valide='3' WHERE id_produit='".$_POST['id']."';");
            echo "Votre annonce a bien été supprimée<br/>";
            $_POST['id']=null;
            $_POST['delete']=null;
        }

        if (isset($_POST['delete_user'])){
            $list_prod=$ProdRepository->getProdofUser($_SESSION['pseudo']);
            foreach ($list_prod as $p){
                $id=$p->getIdProd();
                $connection->query("DELETE FROM assoc_prd_cat WHERE id_prod='".$id."';");
                $connection->query("DELETE FROM produits WHERE id_produit='".$id."';");
            }
            $connection->query("DELETE FROM utilisateur WHERE id='".$_SESSION['pseudo']."';");
            echo "<meta http-equiv=\"Refresh\" content=\"2;url=deconnexion.php\">";
            exit();
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
        if ($CurrUser[0]->getValid()!=1 && $_SESSION['statut']!=1){
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

    if (isset($_POST['email'],$_POST['mdp'],$_POST['mdpverif'],$_POST['city']))
	{
		$_POST['email']=htmlspecialchars($_POST['email']);
		$_POST['mdp']=htmlspecialchars($_POST['mdp']);
        $_POST['mdpverif']=htmlspecialchars($_POST['mdpverif']);
        $_POST['city']=htmlspecialchars($_POST['city']);
		$verif=1;
		$photoon=0; /*0 si l'utilisateur met pas de photo 1 si oui*/
        $id_photo=0;

		if (($_POST['mdp'] != $_POST['mdpverif']) && $verif==1){
			echo "<span class=\"red\">Vos mots de passe ne sont pas similaires</span><br/>";
			$verif=0;
		}

		if ((strlen($_POST['mdp']) <8) && $verif==1){
			echo "<span class=\"red\">Votre mot de passe doit contenir au moins 8 caractères</span><br/>";
			$verif=0;
        }
        


		if ((!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) && $verif==1){
			echo "<span class=\"red\">Votre adresse email n'a pas le bon format</span><br/>";
			$verif=0;
		}
		
		if (($userRepository->testmail($_POST['email']) != [] && $userRepository->testmail($_POST['email'])[0]->getMail() != $CurrUser[0]->getMail()) && $verif==1){
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
                    $id_photo=$CurrUser[0]->getPhoto();
                    unlink($userRepository->getPhototoUnlink($_SESSION['pseudo']));
					move_uploaded_file($_FILES['pp']['tmp_name'],'uploads/'.$id_photo.".".$extension_upload);
                    $photoon=1;
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
			if ($photoon == 1){
                $reqphoto=$connection->query("UPDATE photo SET extension='".$extension_upload."' WHERE id_photo='".$id_photo."';");
            }
            $req=$connection->prepare("UPDATE utilisateur SET mail = :mail,  mdp = :motdepasse, loc = :localisation WHERE id='".$_SESSION['pseudo']."';");
            $params = array(
				'mail' => $_POST['email'],
                'motdepasse' => $_POST['mdp'],
                'localisation' => $_POST['city']
			);
            
            $req->execute($params);
            $_POST['city']=null;
            $_POST['mdp']=null;
            $_POST['email']=null;
            $_FILES['pp']=null;
			echo "<meta http-equiv=\"Refresh\" content=\"2;url=pageProfil.php\">";
			exit();
		}		
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
	  	        Adresse mail <span class="red">*</span> : <br/><input type="text" name="email" value="<?php echo $CurrUser[0]->getMail(); ?>"> <br/>
		        Mot de passe <span class="red">*</span> : <br/><input type="password" size="20" name="mdp" value="<?php echo $CurrUser[0]->getMdp(); ?>"> <br/>
                Verification mot de passe <span class="red">*</span> : <br/><input type="password" size="20" name="mdpverif" value="<?php echo $CurrUser[0]->getMdp(); ?>"> <br/>
                Ville <span class="red">*</span> : <br/><input type="text" name="city" value="<?php echo $CurrUser[0]->getLocation(); ?>"> <br/>
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

        function show(etat,id)
        {
            document.getElementById(id).style.display=etat;
        }
    </script>

    <?php
    if ($_SESSION['pseudo'] == $_GET['pseudo']) {
    echo "<form method=\"post\" action=\"\">
    <div class=\"flexbox_button\">
        <div class=\"bouton\">
            <input type=\"reset\" onclick=\"show('block','suppprofil')\" value=\"&#128465; Supprimer mon profil\" name=\"supprimer\">
        </div>
    </div>
</form>
<div id=\"suppprofil\">
Êtes-vous sur de vouloir supprimer ce profil ?
<form method=\"post\" action=\"\">
    <input type=\"hidden\" name=\"delete_user\" value=\"1\">
    <div class=\"flexbox_boutton\">
        <div class=\"bouton\">
            <input type=\"submit\" value=\"Oui\" name=\"Oui\">
        </div>
        <div class=\"bouton\">
            <input type=\"reset\" onclick=\"show('none','suppprofil')\" value=\"Non\" name=\"Non\">
        </div>
    </div>
</form>
</div>
<script type=\"text/javascript\">show('none','suppprofil');</script>";}
    ?>
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
        $c=0;
        foreach ($prods as $prod){
                $c=$c+1;
                $ProdRepository->afficheProd($prod);
                if ($_GET['pseudo']==$_SESSION['pseudo'] && $prod->getValide()==1) {
                echo 
                "<form method=\"post\" action=\"\">
                    <div class=\"flexbox_button\">
                        <div class=\"bouton\">
                            <input type=\"reset\" onclick=\"show('block','".$prod->getIdProd()."')\" value=\"&#128465; Supprimer\" name=\"supprimer\">
                        </div>
                    </div>
                </form>
                <div id=\"".$prod->getIdProd()."\">
                Êtes-vous sur de vouloir supprimer ce produit ?
                <form method=\"post\" action=\"\">
                    <input type=\"hidden\" name=\"id\" value=\"".$prod->getIdProd()."\">
                    <input type=\"hidden\" name=\"delete\" value=\"1\">
                    <div class=\"flexbox_boutton\">
                        <div class=\"bouton\">
                            <input type=\"submit\" value=\"Oui\" name=\"Oui\">
                        </div>
                        <div class=\"bouton\">
                            <input type=\"reset\" onclick=\"show('none','".$prod->getIdProd()."')\" value=\"Non\" name=\"Non\">
                        </div>
                    </div>
                </form>
                </div>
                <script type=\"text/javascript\">show('none','".$prod->getIdProd()."');</script>";
        }
    }

        if ($prods==[] || $c==0){
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