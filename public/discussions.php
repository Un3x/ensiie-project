<?php session_start();?>
<?php require_once '../src/Questions/sujetsRepository.php';
require_once '../src/Questions/sujets.php';
require_once '../src/Questions/sujetsRepository.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$sujetsRepository = new SujetsRepository($connection);
?>

<!DOCTYPE html>
<html>
    <?php require '../src/components/head.php';?>
    <body id="connected">
        <div class="container">
            <?php require('../src/components/navbar_connection.php');?>
            <div id="sujet-list-container">
                <ul class="sujet-list">
                    <?php
                        $sujetArr = $sujetsRepository->getSujets();
                        foreach($sujetArr as $s){
                            $t = $s->getTitle();
                            echo "<li>$t</li>";
                        }
                    ?>
                </ul>
                <ul class="pagination"></ul>
            </div>
            <div id="sub-container">
                <div id="sujet-create-container">
                    <form method="post">
                        <h3>Créer un nouveau sujet</h3>
                        <input type="text" name="title" placeholder="Titre">
                        <input type="text" name="content" placeholder="Description...">
                    </form>
                </div>
            </div>
        </div>

        <svg class="curve" preserveAspectRatio="none" width="1450" height="160" viewBox="0 0 1450 160" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g>
                <path d="M 0 160L 0 0C 552.762 3.38469e-14 829.144 157.977 1450 157.977L 1450 160L 0 160Z"/>
            </g>
        </svg>
        <?php require('../src/components/footer.php'); ?>
    </body>
</html>