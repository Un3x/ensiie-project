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

require("header.php");


?>
<section>
<h1 class="section">Votre ajout de produit a été réalisé avec succés</h1>

<br/><br/>

Notre équipe va maintenant vérifier et valider votre ajout.
<br/>
Vous serez averti par mail dès que votre annonce aura bien été mise en ligne.

</section>
<?php
//require("aside.php");
require("footer.php");
?>