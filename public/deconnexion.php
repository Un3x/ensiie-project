<?php 
session_start();
session_destroy();
?>

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
<h1 class="section">Vous êtes bien déconnectés !</h1>

<br/><br/>

<button class="boutton" onclick="window.location.href='index.php'" style="width:auto;">Cliquez ici pour revenir à l'accueil</button>

</section>
<?php
//require("aside.php");
require("footer.php");
?>