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
            <div id="sub-container">
                <div id="sujet-list-container">
                <input class="search" placeholder="Search" />
                <button class="sort" data-sort="s-title">
                    Sort by Title
                </button>
                    <ul class="sujet-list list">
                        <?php
                            $sujetArr = $sujetsRepository->getSujets();
                            foreach($sujetArr as $s){
                                $t = $s->getTitle();
                                $a = $s->getAuthor();
                                $c = $s->getContent();
                                $rep = $s->getNbRep();
                                echo "<li>";
                                echo "<div>";
                                echo "<h3 class='s-title'>$t</h3>";
                                echo "<p class='s-content'>$c</p>";
                                echo "<h5 class='s-author'>$a</h5>";
                                echo "<p class='s-nbrep'>$rep</p>";
                                echo "</div>";
                                echo "<a class='vote-top' href='#'>&#9650;</a>";
                                echo "<a class='vote-bot' href='#'>&#9660;</a>";
                                echo "</li>";
                            }
                        ?>
                    </ul>
                    <script>
                        $(document).ready(function () {
                        $("a.vote-top").click(function () {
                            the_id = $(this).attr('id');
                            $.ajax({
                                type: "POST",
                                data: "action=upvote&id=" + $(this).attr("id"),
                                url: "vote.php",
                                success: function (msg) {
                                    alert("Success");
                                },
                                error: function () {
                                    alert("Error");
                                }
                                });
                            });
                        });

                        $(document).ready(function () {
                            $("a.vote-bot").click(function () {
                                the_id = $(this).attr('id');
                                $.ajax({
                                    type: "POST",
                                    data: "action=downvote&id=" + $(this).attr("id"),
                                    url: "vote.php",
                                    success: function (msg) {
                                        alert("Success");
                                    },
                                    error: function () {
                                        alert("Error");
                                    }
                                });
                            });
                        }); 
                    </script>
                    <ul class="pagination"></ul>
                    <script>
                        var options = {
                        valueNames: [ 's-title', 's-author' ],
                        page : 1,
                        pagination : true
                        };

                        var subList = new List('sub-container', options);
                    </script>
                </div>
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