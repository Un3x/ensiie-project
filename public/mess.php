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
$MessRepository= new \User\MessageRepository($connection);

require 'connexion.php';


if ($_SESSION['authent'] == 0 || $_SESSION['statut'] != 1) {
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
    exit();
}

if (!isset($_GET['id_mess'])){
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=checkmessage.php\">";
    exit();
}
$_GET['id_mess']=htmlspecialchars($_GET['id_mess']);

$mess=$MessRepository->getMessage($_GET['id_mess']);

if ($mess==[]){
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=checkmessage.php\">";
    exit();
}

$user=$userRepository->testmail($mess[0]->getMail());


require("header.php");
?>

<section>
<h2 class="sous_titre"><?php echo $mess[0]->getTitre();?></h2>
</section>

<?php
require("aside.php");
require("footer.php");
?>