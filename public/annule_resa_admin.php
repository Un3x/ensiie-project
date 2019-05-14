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
$reservationRepository = new \Reservation\ReservationRepository($connection);

//on vérifie bien que l'utilisateur est un admin
$user_connected=isset($_SESSION["id_user"]);

$prenom = '';
$nom = '';
$pseudo = '';
$admin = false;
if ($user_connected) {//on récupère les info sur l'utilisateur courant (si il est identifié)
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}

//on redirige si l'utilisateur n'est pas connecté ou pas admin
if (!($user_connected)) {
	header("Location: index.php");
}





//on annule la réservation demandée

$tmpres=$reservationRepository->creeReservation($_POST['id_livre'], $_POST['id_user']);
$reservationRepository->deleteReservation($tmpres);

header("Location: liste_emprunts.php");

?>