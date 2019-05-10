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

$ProdRepository=new \User\ProduitRepository($connection);

require 'connexion.php';


require("header.php");
?>

<section>
    <?php
    if (!isset($_GET['id'])){
        echo "<h2 class=\"sous_titre\">Produits de toutes les catégories</h1>";
        $prods=array_reverse($ProdRepository->fetchAll());
        foreach ($prods as $prod){
            $ProdRepository->afficheProd($prod);
        }
    }
    else{
        $_GET['id']=(int) $_GET['id'];
        if (!(0<$_GET['id'] && $_GET['id']<=$catRepository->getMax())){
            echo "<meta http-equiv=\"Refresh\" content=\"0;url=cat.php\">";
            exit();
        }

        $prods=array_reverse($ProdRepository->getProdofC($_GET['id']));
        $nom=$catRepository->getCatofId($_GET['id'])[0]->getNomCat();
        echo "<h2 class=\"sous_titre\">Produits dans la catégorie ".$nom."</h1>";
        if ($prods ==[]) echo "<span class=\"red\">Pas de produits dans cette catégorie</span>";
        foreach ($prods as $prod){
            $ProdRepository->afficheProd($prod);
        }
    }
    ?>

</section>

<?php
require("aside.php");
require("footer.php");
?>