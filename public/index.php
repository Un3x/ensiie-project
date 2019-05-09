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

<?php require '../src/components/head.php';?>
    <body>
        <header id="disconnected">
            <div class="container">
                <?php require('../src/components/navbar_connection.php');?>
                <img id="logo-img" src="img/logo_tsps_2019.png" alt="Logo de promo"/>
                <div id="header-text">
                    <h1>Tutorat Santé Paris-Sud</h1>
                    <p>Toutes les informations nécessaires à votre année de PACES.</p>
                    <a class="button" href="login.php">Se connecter ></a>
                </div>
            </div>

            <svg id="curve" preserveAspectRatio="none" width="1450" height="160" viewBox="0 0 1450 160" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g>
                <path d="M 0 160L 0 0C 552.762 3.38469e-14 829.144 157.977 1450 157.977L 1450 160L 0 160Z"/>
                </g>
            </svg>
        </header>
        <?php require('../src/components/footer.php'); ?>
    </body>
</html>
