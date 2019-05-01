<?php
require '../vendor/autoload.php';

include "utils.php";

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$livreRepository = new \Livre\LivreRepository($connection);
$reservationRepository = new \Reservation\ReservationRepository($connection);

if (!(isset($_POST['id_user']) && isset($_POST['id_livre']))) {
    header("Location: bibliotheque.php");
}

$okreserv=$reservationRepository->okReservation($_POST['id_livre']);

$nbres = nbReservation($_POST['id_user']);

if ($okreserv && ($nbres <= 3)) {
    $tmpreserv=$reservationRepository->creeReservation($_POST['id_livre'], $_POST['id_user']);
    $reservationRepository->insertReservation($tmpreserv);
    header("Location: index.php");
}

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Reservation</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
    <h2>Reservation de livre</h2>
    <nav>
         <!-- TODO recopier le nav-->
    </nav>
    <?php if (!($okreserv)): ?>
        <p>Désolé, ce livre a déjà été réservé</p>
    <?php endif; ?>
    <?php if ($nbres > 3): ?>
        <p>Désolé, vous ne pouvez pas réserver plus de trois livres à la fois</p>
    <?php endif; ?>
</body>