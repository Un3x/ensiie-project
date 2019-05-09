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

require 'connexion.php';


require("header.php");
?>

<section>
    <?php
        if ($_SESSION['authent'] == 1) {
            echo "<p class=\"accueil\">Coucou "; 
            echo $_SESSION['pseudo'];
            echo ", comment tu vas ? <br/> Regarde un peu les nouvelles annonces &#128516;</p>";
        }

    ?>

    <h2 class="sous_titre">Les Dernières annonces ajoutée sur TTT</h2>
    <div class="produits">
        <a href="">
        <div class="produit">
            <div class="photo_prod">
                <img class="preview" src="voiture.jpg" alt="photo du produit"/>
            </div>
            <div class="text_prod">
                <p>
                <span class="titre_prod">Très très très long Titre de l'annonce</span><br/><br/>
                <span class="prix_prod">67 €</span><br/><br/>
                <span class="details">Auto/Moto<br/>Evry</span>
                </p>
            </div>
        </div>
        </a>
        
        <a href="">
        <div class="produit">
            <div class="photo_prod">
                <img class="preview" src="voiture.jpg" alt="photo du produit"/>
            </div>
            <div class="text_prod">
                <p>
                <span class="titre_prod">Très très très long Titre de l'annonce</span><br/><br/>
                <span class="prix_prod">67 €</span><br/><br/>
                <span class="details">Auto/Moto<br/>Evry</span>
                </p>
            </div>
        </div>
        </a>

        <a href="">
        <div class="produit">
            <div class="photo_prod">
                <img class="preview" src="hugo.JPG" alt="photo du produit"/>
            </div>
            <div class="text_prod">
                <p>
                <span class="titre_prod">Très très très long Titre de l'annonce</span><br/><br/>
                <span class="prix_prod">67 €</span><br/><br/>
                <span class="details">Auto/Moto<br/>Evry</span>
                </p>
            </div>
        </div>
        </a>

        <a href="">
        <div class="produit">
            <div class="photo_prod">
                <img class="preview" src="TTT_green.png" alt="photo du produit"/>
            </div>
            <div class="text_prod">
                <p>
                <span class="titre_prod">Très très très long Titre de l'annonce</span><br/><br/>
                <span class="prix_prod">67 €</span><br/><br/>
                <span class="details">Auto/Moto<br/>Evry</span>
                </p>
            </div>
        </div>
        </a>
    </div>

</section>

<?php
require("aside.php");
require("footer.php");
?>


