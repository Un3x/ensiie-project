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

require 'connexion.php';

require("header.php");
?>


<section>
<script type="text/javascript">
function showCat(etat){
    document.getElementById("categorie").style.display=etat;
}
</script>

    <h2>Recherchez un produit, une catégorie, un vendeur...</h2>
    <form action="search.php" class="form" method="get">
        <input type="text" placeholder="Rechercher.." name="search" required>
        <p>Votre recherche concerne :</p>
        <div class="radioboxes">
            <div class="radio">
            <label for="prd" class="radiobox">Produits
                <input type="radio" name="typerec" value="prod" checked="checked" onclick="showCat('block');"/>
                <span class="radiomark"></span>
            </label>
            </div>
            <div class="radio">
            <label for="util" class="radiobox">Utilisateur
                <input type="radio" name="typerec" value="util" onclick="showCat('none');"/>
                <span class="radiomark"></span>
            </label>
            </div>
        </div>
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
            if ($_GET['cat']>10) $_GET['cat']=0;

            echo 'Votre recherche : '.htmlspecialchars($_GET['search']).' ';
            if ($_GET['cat'] != "all"){
                $_GET['cat']=(int) $_GET['cat'];
                $catact=$catRepository->getCatofId(htmlspecialchars($_GET['cat']));
            }

            if ($_GET['typerec'] == "prod"){
                if ($_GET['cat'] != "all" ){
                foreach($catact as $cat) :
                echo 'dans la catégorie '.$cat->getNomCat();
                $resultsearch=$prodRepository->searchProdonCat(htmlspecialchars($_GET['search']),$cat->getId());
                endforeach;
                echo '<br/><br/>';
                foreach ($resultsearch as $res) :
                    echo 'Titre '.$res->getTitle().' Description '.$res->getDescription().' Prix '.$res->getPrice().'<br/>'; endforeach;
                if ($resultsearch == []) echo "Aucun résultat pour cette recherche.";
                }

                else{
                    echo 'dans toutes les catégories';
                    $resultsearch=$prodRepository->searchProd(htmlspecialchars($_GET['search']));
                    echo '<br/><br/>';
                    foreach ($resultsearch as $res) :
                        echo 'Titre '.$res->getTitle().' Description '.$res->getDescription().' Prix '.$res->getPrice().'<br/>'; endforeach;
                    if ($resultsearch == []) echo "Aucun résultat pour cette recherche.";

                }
            }

            if ($_GET['typerec'] == "util"){
                echo 'dans les Utilisateurs';
                $resultsearch=$userRepository->searchUser(htmlspecialchars($_GET['search']));
                echo '<br/><br/>';
                $compt=1;
                foreach ($resultsearch as $res) :
                    echo 'Pseudo '.$res->getId().' Nom '.$res->getLastname().' Prenom '.$res->getFirstname().'<br/>'; endforeach;
                if ($resultsearch == []) echo "Aucun résultat pour cette recherche.";
            }
        }

        ?>
</form>
</section>

<?php
require("aside.php");
require("footer.php");
?>