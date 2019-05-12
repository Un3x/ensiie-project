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
require("header.php");
?>

<section>
<h2 class="sous_titre">Messages en attente<h2>
<?php
$wait=$MessRepository->fetchUnvalid();
foreach ($wait as $w){
    echo "<a href=\"mess.php?id_mess=".$w->getId()."\"><h6 style=\"color:orange\">".$w->getTitre()." de ".$w->getMail()."</h6></a>";
}
if ($wait==[]){
    echo "<h4>Aucun message à traiter ! Good Job !</h4>";
}
?>
<h2 class="sous_titre">Messages traités<h2>
<?php
$val=array_reverse($MessRepository->fetchValid());
foreach ($val as $w){
    echo "<a href=\"mess.php?id_mess=".$w->getId()."\"><h6 style=\"color:green\">".$w->getTitre()." de ".$w->getMail()."</h6></a>";
}
if ($val==[]){
    echo "<h6>Aucun message traité</h6>";
}
?>
<h2 class="sous_titre">Messages supprimés<h2>
<?php
$del=array_reverse($MessRepository->fetchDeleted());
foreach ($del as $w){
    echo "<a href=\"mess.php?id_mess=".$w->getId()."\"><h6 style=\"color:red\">".$w->getTitre()." de ".$w->getMail()."</h6></a>";
}
if ($del==[]){
    echo "<h6>Aucun message supprimé</h6>";
}
?>
</section>

<?php
require("aside.php");
require("footer.php");
?>