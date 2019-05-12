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
<h1 class="section">Votre message a été envoyé avec succés</h1>

<br/><br/>

Notre équipe vous répondra par mail dans les plus brefs délais.


</section>
<?php
//require("aside.php");
require("footer.php");
?>