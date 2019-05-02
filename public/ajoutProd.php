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
    <h1 class="section">Ajouter un produit</h1>
    <h2 class="sous_titre">Votre annonce</h2>
    <p>Veuillez compléter les champs suivants.<br>Les champs munis d'un <span class="red">*</span> sont obligatoires.</p>
    <form action="" method="post" class="form">
        <p>Catégories<span class="red">*</span> :</p>
        <div class="checkboxes">
            <?php 
            foreach ($cats as $cat) : ?>
            <label class="checkbox"><?php echo $cat->getNomCat() ?>
                <input type="checkbox" name="categories" value="<?php echo $cat->getId(); ?>" id="<?php echo $cat->getId(); ?>" required/>
                <span class="checkmark"></span>
            </label>
            <?php endforeach; ?>
        </div>
        <br/>
        <p>Titre de l'annonce<span class="red">*</span> :</p> <input type="text" size="20" maxlenght="50" name="titre" placeholder="Entrez le titre" required> <br/>
        <p>Texte de l'annonce<span class="red">*</span> :</p> <textarea name="description" cols="80" rows="15" placeholder="Veuillez saisir une desciption pour votre produit..." required></textarea> <br/>
        <p>Prix<span class="red">*</span> :</p> <input type="text" style="width : 200px;" name="price" placeholder="Entrez le prix en €" required> €<br/> <!-- verifier que c'est bien un nombre --> 
        <p>Photo :</p> <input type="file" class="photo1" id="image_uploads" name="photo_prod1" accept="image/png, image/jpeg" multiple>
        <input type="file" class="photo2" id="image_uploads" name="photo_prod2" accept="image/png, image/jpeg" multiple>
        <input type="file" class="photo3" id="image_uploads" name="photo_prod3" accept="image/png, image/jpeg" multiple>
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
    </form>
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
require("aside.php");
require("footer.php");
?>