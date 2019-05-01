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
$users = $userRepository->fetchAll();


$user_connected=isset($_SESSION["id_user"]);

if (!($user_connected)) {
	header("Location: index.php");
}

$admin = false;
if ($user_connected) {//on récupère les info sur l'utilisateur courrant (si il est identifié)
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut et la ligne $admin = false;
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}

if (!($admin)) {
	header("Location: index.php");
}



//gestion de la demande d'annulation de réservation
if (isset($_POST['id_rendre'])) {
    $tmpres=$reservationRepository->creeReservation($_POST['id_rendre'], $_POST['id_user']);
    $reservationRepository->deleteReservation($tmpres);
    header("Location: gest_reservation.php");
}


//on récupère la liste des réservations
$reservations = $reservationRepository->fetchAll();

?>


<html>
<head>
	<title>Gestion des réservations</title>
	<link rel="stylesheet" href=".css">
</head>
<body>
	<h2>Liste des livres réservés par les utilisateurs</h2>
	<div class="content">
		<table>
			<thead>
				<td>Couverture</td>
				<td>Titre</td>
				<td>Demandeur</td>
				<td>Annuler la réservation</td>
			</thead>
		<?php foreach ($reservations as $reservation): ?>
			<?php $livre=$livreRepository->fetchId($reservation->getIdLivre()); ?>
			<td><?php echo $livre->getImage(); ?></td>
			<td><?php echo $livre->getTitre(); ?></td>
			<td><?php echo IdToPseudo($reservation->getIdUser()); ?></td>
			<td><form action="gest_reservation.php" method="POST">
				<input style="display:none" name="id_rendre" value=<?php echo $livre->getId(); ?>>
				<input style="display:none" name="id_user" value=<?php echo $reservation->getIdUser(); ?>><input type="submit" value="annuler"></form></td>
		<?php endforeach; ?>
		</table>
