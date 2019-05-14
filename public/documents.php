<?php session_start();
require_once '../src/uploads/uploads.php';
require_once '../src/uploads/uploadRepository.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$sujetsRepository = new UploadsRepository($connection);
?>

<!DOCTYPE html>
<html>
    <?php require '../src/components/head.php';?>
    <body id="connected">
        <div class="container">
            <?php require('../src/components/navbar_connection.php');?>
            <div id="contain">
                <h1>Documents</h1>
                <div id="sub-container">
                    <div id="sujet-list-container">
                    <input class="search" placeholder="Search" />
                    <button class="sort" data-sort="s-title">
                        Sort by Title
                    </button>
                        <ul class="sujet-list list">
                            <?php
                                $sujetArr = $sujetsRepository->getuploads();
                                foreach($sujetArr as $s){
                                    $t = $s->getTitle();
                                    $p = $s->getUploadPath();
                                    echo "<li>";
                                    echo "<div>";
                                    echo "<h3 class='s-title'>$t</h3>";
                                    echo "<a href='$p' download>Télécharger</a>";
                                    echo "</div>";
                                    echo "</li>";
                                }
                            ?>
                        </ul>
                        <ul class="pagination"></ul>
                        <script>
                            var options = {
                            valueNames: [ 's-title', 's-content' ],
                            page : 7,
                            pagination : true
                            };

                            var subList = new List('sub-container', options);
                        </script>
                    </div>
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