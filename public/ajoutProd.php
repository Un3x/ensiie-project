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
$prodRepository= new \User\ProduitRepository($connection);

$phoRepository=new \User\PhotoRepository($connection);


require 'connexion.php';

require("header.php");

?>

<section>

<?php

if ($_SESSION['authent']==0){
    echo "Vous devez être connecté pour ajouter un produit.<br/>Redirection en cours...";
    echo "<meta http-equiv=\"Refresh\" content=\"5;url=index.php\">";
    exit();
}

if (isset($_POST['titre'],$_POST['description'],$_POST['price'])){
    $_POST['titre']=htmlspecialchars($_POST['titre']);
    $_POST['descritption']=htmlspecialchars($_POST['description']);
    $_POST['price']=htmlspecialchars($_POST['price']);
    $verif=1;
    if (!isset($_POST['categories'])){
        echo "<span class=\"red\">Veuillez séléctionner au moins une catégorie</span><br/>";
        $verif=0;
    }

    if (strlen($_POST['description']) < 30 && $verif==1){
        echo "<span class=\"red\">Votre description doit contenir au moins 30 caractères</span><br/>";
        $verif=0;
    }

    if (strlen($_POST['description']) > 5000 && $verif==1){
        echo "<span class=\"red\">Votre description est trop longue</span><br/>";
        $verif=0;
    }

    if (!ctype_digit($_POST['price'])){
        echo "<span class=\"red\">Votre prix doit être un chiffre rond</span><br/>";
        $verif=0;
    }
    $extension_autorisees=array('jpg','jpeg','gif','png','JPG','PNG','GIF','JPEG');
    $photo1=0;
    $photo2=0;
    $photo3=0;


    if ((isset($_FILES['photo_prod1']) AND $_FILES['photo_prod1']['error']==0) && $verif==1){
        if (($_FILES['photo_prod1']['size'] <= 2000000) && $verif==1)
        {
            $infosfichier1=pathinfo($_FILES['photo_prod1']['name']);
            $extension_upload1=$infosfichier1['extension'];
            if (!(in_array($extension_upload1,$extension_autorisees) && $verif==1))
            {
                echo "<span class=\"red\">Le type de votre image 1 n'est pas accepté (jpg, jpeg, png, gif only)</span><br/>";
                $verif=0;
            }

            else{
                $photo1=1;
            }
        }

        else{
            echo "<span class=\"red\">Votre image 1 est à une taille trop grande</span><br/>";
            $verif=0;
        }
    }

    if ((isset($_FILES['photo_prod2']) AND $_FILES['photo_prod2']['error']==0) && $verif==1){
        if (($_FILES['photo_prod2']['size'] <= 2000000) && $verif==1)
        {
            $infosfichier2=pathinfo($_FILES['photo_prod2']['name']);
            $extension_upload2=$infosfichier2['extension'];
            if (!(in_array($extension_upload2,$extension_autorisees) && $verif==1))
            {
                echo "<span class=\"red\">Le type de votre image 2 n'est pas accepté (jpg, jpeg, png, gif only)</span><br/>";
                $verif=0;
            }

            else if($photo1==1){
                $photo2=1;
            }

            else {
                echo "<span class=\"red\">Vous n'avez pas rentrer de photo 1</span><br/>";
                $verif=0;
            }
        }

        else{
            echo "<span class=\"red\">Votre image 2 est à une taille trop grande</span><br/>";
            $verif=0;
        }
    }

    if ((isset($_FILES['photo_prod3']) AND $_FILES['photo_prod3']['error']==0) && $verif==1){
        if (($_FILES['photo_prod3']['size'] <= 2000000) && $verif==1)
        {
            $infosfichier3=pathinfo($_FILES['photo_prod3']['name']);
            $extension_upload3=$infosfichier3['extension'];
            if (!(in_array($extension_upload3,$extension_autorisees) && $verif==1))
            {
                echo "<span class=\"red\">Le type de votre image 3 n'est pas accepté (jpg, jpeg, png, gif only)</span><br/>";
                $verif=0;
            }

            else if($photo1==1){
                if ($photo2==1){
                    $photo3=1;
                }

                else{
                    echo "<span class=\"red\">Vous ne pouvez pas rentrer de photo 3 sans avoir une photo 2</span><br/>";
                    $verif=0;
                }
            }
            else {
                echo "<span class=\"red\">Vous n'avez pas rentrer de photo 1</span><br/>";
                $verif=0;
            }
        }

        else{
            echo "<span class=\"red\">Votre image 2 est à une taille trop grande</span><br/>";
            $verif=0;
        }
    }



    $id_photo1=3;
    $id_photo2=3;
    $id_photo3=3;

    if ($verif==1){
        echo "Please wait..";
        if ($photo1==1){
            $id_photo1=($phoRepository->getMax()+1);
            move_uploaded_file($_FILES['photo_prod1']['tmp_name'],'uploads/'.$id_photo1.".".$extension_upload1);
            $reqphoto1=$connection->prepare("INSERT INTO photo (id_photo, extension) VALUES (:id_p,:ext)");
			$paramsphoto1=array(
				'id_p' => $id_photo1,
				'ext' => $extension_upload1
			);
			$reqphoto1->execute($paramsphoto1);
        }

        if ($photo2==1){
            $id_photo2=($phoRepository->getMax()+1);
            move_uploaded_file($_FILES['photo_prod2']['tmp_name'],'uploads/'.$id_photo2.".".$extension_upload2);
            $reqphoto2=$connection->prepare("INSERT INTO photo (id_photo, extension) VALUES (:id_p,:ext)");
			$paramsphoto2=array(
				'id_p' => $id_photo2,
				'ext' => $extension_upload2
			);
			$reqphoto2->execute($paramsphoto2);
        }

        if ($photo3==1){
            $id_photo3=($phoRepository->getMax()+1);
            move_uploaded_file($_FILES['photo_prod3']['tmp_name'],'uploads/'.$id_photo3.".".$extension_upload3);
            $reqphoto3=$connection->prepare("INSERT INTO photo (id_photo, extension) VALUES (:id_p,:ext)");
			$paramsphoto3=array(
				'id_p' => $id_photo3,
				'ext' => $extension_upload3
			);
			$reqphoto3->execute($paramsphoto3);
        }

        $prodRepository= new \User\ProduitRepository($connection);
        $id_produit=($prodRepository->getMax()+1);

        $now=new \DateTime();
        $nowstring = $now->format('Y-m-d');

        $reqprod=$connection->prepare("INSERT INTO produits (id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (:id,:date_publi,:id_prop,:descript,:titre,:prix,:ph1,:ph2,:ph3,0);");
        $paramsprod=array(
            'id' => $id_produit,
            'date_publi' => $nowstring,
            'id_prop' => $_SESSION['pseudo'],
            'descript' => $_POST['description'],
            'titre' => $_POST['titre'],
            'prix' => $_POST['price'],
            'ph1' => $id_photo1,
            'ph2' => $id_photo2,
            'ph3' => $id_photo3
        );
        $reqprod->execute($paramsprod);

        foreach($_POST['categories'] as $valeur){
            $reqcat=$connection->prepare("INSERT INTO assoc_prd_cat (id_cat,id_prod) VALUES (:id_cat,:id_prod); ");
            $paramscat=array(
                'id_cat' => $valeur,
                'id_prod' => $id_produit
            );
            $reqcat->execute($paramscat);
        }

        echo "<meta http-equiv=\"Refresh\" content=\"2;url=depotproduitsuccess.php\">";
		exit();
    }
}

?>

    <div class="form">
    <h1 class="section">Ajouter un produit</h1>
    <h2 class="sous_titre">Votre annonce</h2>
    <p>Veuillez compléter les champs suivants.<br>Les champs munis d'un <span class="red">*</span> sont obligatoires.</p>
    <form action="" method="post" class="form" enctype="multipart/form-data">
        <p>Catégories<span class="red">*</span> :</p>
        <div class="checkboxes">
            <?php 
            foreach ($cats as $cat) : ?>
            <label class="checkbox"><?php echo $cat->getNomCat() ?>
                <input type="checkbox" name="categories[]" value="<?php echo $cat->getId(); ?>" id="<?php echo $cat->getId(); ?>"/>
                <span class="checkmark"></span>
            </label>
            <?php endforeach; ?>
        </div>
        <br/>
        <p>Titre de l'annonce<span class="red">*</span> :</p> <input type="text" size="20" maxlength="50" name="titre" placeholder="Entrez le titre" required> <br/>
        <p>Texte de l'annonce<span class="red">*</span> :</p> <textarea name="description" cols="80" rows="15" placeholder="Veuillez saisir une desciption pour votre produit...(30 caractères minimum)" required></textarea> <br/>
        <p>Prix<span class="red">*</span> :</p> <input type="text" style="width : 200px;" name="price" placeholder="Entrez le prix en €" required> €<br/> <!-- verifier que c'est bien un nombre --> 
        <p>Photo :</p> <input type="file" class="photo1" id="image_uploads1" name="photo_prod1" accept="image/*">
        <input type="file" class="photo2" id="image_uploads2" name="photo_prod2" accept="image/*">
        <input type="file" class="photo3" id="image_uploads3" name="photo_prod3" accept="image/*">
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
	var input1 = document.querySelector('input[type=file].photo1');
    var input2 = document.querySelector('input[type=file].photo2');
    var input3 = document.querySelector('input[type=file].photo3');
	var preview = document.querySelector('.preview');

	input1.addEventListener('change', updateImageDisplay);
    input2.addEventListener('change', updateImageDisplay);
    input3.addEventListener('change', updateImageDisplay);

	function updateImageDisplay() 
	{
		while(preview.firstChild) {
    		preview.removeChild(preview.firstChild);
		}
		var curFiles1 = input1.files;
        var curFiles2 = input2.files;
        var curFiles3 = input3.files;
		if(curFiles1.length === 0) {
    		var para = document.createElement('p');
    		para.textContent = 'Aucun fichier actuellement sélectionné';
			preview.appendChild(para);
		}
		else {
     		var para = document.createElement('p');
        	var image1 = document.createElement('img');
        	image1.src = window.URL.createObjectURL(curFiles1[0]);
			preview.appendChild(image1);
		}  
        if(curFiles2.length === 0) {
    		var para = document.createElement('p');
    		para.textContent = '';
			preview.appendChild(para);
        }
        else {
            var image2 = document.createElement('img');
            image2.src = window.URL.createObjectURL(curFiles2[0]);
            preview.appendChild(image2);
        }
        if(curFiles2.length === 0) {
    		var para = document.createElement('p');
    		para.textContent = '';
			preview.appendChild(para);
        }
        else {
            var image3 = document.createElement('img');
            image3.src = window.URL.createObjectURL(curFiles3[0]);
            preview.appendChild(image3);
        }
        preview.appendChild(para);
	}
</script>

<?php
//require("aside.php");
require("footer.php");
?>