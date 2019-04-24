<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
?>

<!DOCTYPE html>

<html>
<!--
<head>
    <!- Latest compiled and minified CSS -> // wesh
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h3><?php //echo 'Hello world from Docker! php' . PHP_VERSION; ?></h3>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>#</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Age</td>
        </thead>
        <?php /** @var \User\User $user */
        //foreach ($users as $user) : ?>
            <tr>
                <td><?php //echo $user->getId() ?></td>
                <td><?php //echo $user->getFirstname() ?></td>
                <td><?php //echo $user->getLastname() ?></td>
                <td><?php //echo $user->getAge() ?> years</td>
            </tr>
        <?php //endforeach; ?>
    </table>
</div>
</body> -->

<!-- KATANA -->

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Tutorat Santé Paris-Sud</title>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="fonts.css">
    </head>
    <body>
        <main id="disconnected">
            <div class="container">
                <div class="navbar-container">
                    <h1>TSPS</h1>
                    <nav id="landing-nav">
                        <ul class="nav-link">
                            <li><a href="#">Espace lycéen</a></li>
                            <li><a href="signup.html">Inscription</a></li>
                            <li><a href="login.html">Connexion</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="sidebar-container">
                    <h1>TSPS</h1>
                    <a id="nav-toggle" href="#">&#9776;</a>
                    <div id="sidebar-nav"></div>
                </div>
                <img id="logo-img" src="img/logo_tsps_2019.png"/ alt="Logo de promo">
                <div id="header-text">
                    <h1>Tutorat Santé Paris-Sud</h1>
                    <p>Toutes les informations nécessaires à votre année de PACES.</p>
                    <a class="button" href="login.html">Se connecter ></a>
                </div>                
            </div>
            
            <svg id="curve" preserveAspectRatio="none" width="1450" height="160" viewBox="0 0 1450 160" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g>
                <path d="M 0 160L 0 0C 552.762 3.38469e-14 829.144 157.977 1450 157.977L 1450 160L 0 160Z"/>
                </g>
            </svg>
        </main>
        <footer>
            <div class="container">
                <img id="contact-us-img" src="img/contact_us.svg" alt="Icone question"/>
                <section id="footer-text">
                    <h2>Une question à nous poser?</h2>
                    <p>Rien de plus simple! Il vous suffit de nous contacter par mail ou sur notre page Facebook. </p>
                    <table>
                        <td><a href="#"><img class="icon"src="img/facebook-icon.png" alt="Facebook icon"/></a></td>
                        <td><a href="#"><img class="icon"src="img/Mail-Icon.png" alt="Mail icon"/></a></td>
                        <td><a href="#"><img class="icon" src="img/anemflogo.png"/></a></td>
                        <td><a href="#"><img class="icon" src="img/anesflogo.png"/></a></td>
                    </table>
                </section>
            </div>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="responsive.js"></script>
    </body>


</html>
