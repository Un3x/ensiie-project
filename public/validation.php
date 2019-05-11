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

if ($_SESSION['authent'] == 0 || $_SESSION['statut'] != 1) {
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
    exit();
}


require("header.php");
?>

<section>
<h2 class="sous_titre">Les annonces pas encore validées :</h2>
<?php 
    $prods=array_reverse($ProdRepository->getProdNonValid());
    if ($prods!=[]){
        foreach ($prods as $prod){
            $ProdRepository->afficheProd($prod);
            echo "<button class=\"boutton\" onclick=\"\" style=\"width:auto;\">&#10004; Valider</button>";
            echo "<button class=\"supp\" onclick=\"\">&#128465; Supprimer</button>";
        }
    }
    else {
        echo "<h4>Aucune annonce à valider !</h4>";
    }
?>
</section>

<?php
require("aside.php");
require("footer.php");
?>