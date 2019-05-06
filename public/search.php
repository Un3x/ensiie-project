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
<script type="text/javascript">
function showCat(etat){
    document.getElementById("categorie").style.display=etat;
}
</script>

    <h2>Recherchez un produit, une catégorie, un vendeur...</h2>
    <form action="search.php" class="search-container" method="get">
        <input type="text" placeholder="Rechercher.." name="search">
        Votre recherche concerne : 
        Produit<input type="radio" name="typerec" value="Prod" checked="checked" onclick="showCat('block');"/><label for="prd">Produits</label>
        <input type="radio" name="typerec" value="util" onclick="showCat('none');"/>
<br /> <label for="util">Utilisateurs</label>
<div id="categorie">
        <br>Catégorie :
        <select name="cat">
            <option value="all">Toutes</option>
            <?php
            foreach($cats as $cat) : ?>
            <option value="<?php echo $cat->getId(); ?>"><?php
                        echo $cat->getNomCat() ?></option>
            <?php endforeach; ?>
                    </select>
</div>

<br/>
        <button type="submit">OK</button>

        <br><br>
        <?php 
        if (isset($_GET['search']) AND isset($_GET['cat']) AND isset($_GET['typerec'])){
            echo 'Votre recherche : '.htmlspecialchars($_GET['search']);
        }

        ?>
</form>
</section>

<?php
require("aside.php");
require("footer.php");
?>