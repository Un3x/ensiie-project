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
    <form action="" method="post">
        <?php 
        foreach ($cats as $cat) : ?>
        <label for="<?php echo $cat->getId(); ?>"><?php echo $cat->getNomCat() ?></label>
        <input type="checkbox" name="categories" value="<?php echo $cat->getId(); ?>" id="<?php echo $cat->getId(); ?>"/>
        <?php endforeach; ?>
    </form>
</section>

<?php
require("aside.php");
require("footer.php");
?>