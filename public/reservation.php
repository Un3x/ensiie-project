<?php
require '../vendor/autoload.php';

include "utils.php";

session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$livreRepository = new \Livre\LivreRepository($connection);
$reservationRepository = new \Reservation\ReservationRepository($connection);


$user_connected=isset($_SESSION["id_user"]);



$prenom = '';
$nom = '';
$pseudo = '';
$admin = false;
if ($user_connected) {//on récupère les info sur l'utilisateur courrant (si il est identifié)
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}


if (!(isset($_POST['id_user']) && isset($_POST['id_livre']))) {
    header("Location: bibliotheque.php");
}

$okreserv=$reservationRepository->okReservation($_POST['id_livre']);

$nbres = nbReservation($_POST['id_user']);

if ($okreserv && ($nbres < 3)) {
    $tmpreserv=$reservationRepository->creeReservation($_POST['id_livre'], $_POST['id_user']);
    $reservationRepository->insertReservation($tmpreserv);
    header("Location: index.php");
}

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Reservation</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<div class="top"> <!--ajout d'un haut de page si l'utilisateur est admin ou si il est connecté-->
    <?php affiche_bandeau_connexion($user_connected, $nom, $prenom, $pseudo, $admin) ?> 
    <!-- dans utils.php -->
</div>
<body>
    <header>
        <img src="../images/sciience.png"/>
    </header>
    <nav>
        <?php affiche_nav($user_connected, $admin) ?> <!-- dans utils.php -->
    </nav>
    <section>
        <div class="grand-titre">Reservation de livre</div>
    <?php if (!($okreserv)): ?>
        <p>Désolé, ce livre a déjà été réservé</p>
    <?php endif; ?>
    <?php if ($nbres >= 3): ?>
        <p>Désolé, vous ne pouvez pas réserver plus de trois livres à la fois</p>
    <?php endif; ?>
</section>
</body>