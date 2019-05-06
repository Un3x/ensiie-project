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
    <h1 class="section">Mon Profil</h1>
    <h2 class="sous_titre">?/?/ PSEUDO ?/?/</h2>
    <img class="photo_profil" src="hugo.JPG" alt="Photo de profil"/>
</section>

<?php
require("aside.php");
require("footer.php");
?>