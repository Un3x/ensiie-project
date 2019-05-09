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

require 'connexion.php';

if ($_SESSION['authent'] == 0) {
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
	exit();
}

require("header.php");
?>

<section>
    <?php
        $CurrUser = $userRepository->testpseudo($_SESSION['pseudo']);
        $cheminphoto=$userRepository->getPhoto($_SESSION['pseudo']);
    ?>
    <h1 class="section">Mon Profil</h1>
    <h2 class="sous_titre"><?php echo $CurrUser[0]->getId(); ?></h2>
    <!-- FAIRE DES COLONES -->
    <div class="rowInfo">
        <div class="columnPP">
            <img class="photo_profil" src=<?php echo $cheminphoto;?> alt="Photo de profil"/>
        </div>
        <div class="columnInfo">
            <p>Pseudo : <?php echo $CurrUser[0]->getId(); ?></p>
            <p>Prénom : <?php echo $CurrUser[0]->getFirstname(); ?> </p>
            <p>Nom : <?php echo $CurrUser[0]->getLastname(); ?> </p>
            <p>E-mail : <?php echo $CurrUser[0]->getMail(); ?> </p>
            <p>Ville : <?php echo $CurrUser[0]->getLocation(); ?> </p>
            <p>Date de naissance : <?php echo date_format($CurrUser[0]->getBirthday(), 'd-m-Y'); ?> </p>
            <button class="boutton" onclick="window.location.href='modifProfil.php'" style="width:auto;">Modifier mes infos</button>
        </div>
    </div>

    <h2 class="sous_titre">Mes annonces</h2>
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
        <button class="boutton" onclick="" style="width:20%;">Supprimer</button>

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