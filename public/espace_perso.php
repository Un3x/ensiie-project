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

$admin = false;

if ($user_connected) {//on récupère les info sur l'utilisateur courrant (si il est identifié)
    $id_user=$_SESSION["id_user"]; 
    foreach ($users as $user) {
        if ($user->getId() == $id_user) {
            $admin=$user->getAdmin();
            $nom=$user->getNom();
            $prenom=$user->getPrenom();
            $pseudo=$user->getPseudo();
        }
    }
}



//gestion de la demande d'annulation d'une réservation
if (isset($_POST['id_rendre'])) {
    $tmpres=$reservationRepository->creeReservation($_POST['id_rendre'], $_SESSION['id_user']);
    $reservationRepository->deleteReservation($tmpres);
}





//on récupère la liste des réservations
//on récupere la liste des livres empruntés par l'utilisateur
if ($user_connected) {
    $reservations = $reservationRepository->fetchByUser($_SESSION["id_user"]);
    $empruntés = $livreRepository->fetchByUser($_SESSION["id_user"]);
}
else {
    $reservations = [];
    $empruntés = [];
}





?>
<html>
<head>
<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href=".css">
    </head>
     <body>
     <h2>Vous pouvez ici consulter votre espace perso au cas où vous auriez oublié votre nom,prenom ou autre.</h2>
     <?php if (!($user_connected)) : ?>
        <div class="non connecté">
            Vous n'êtes pas connectés, veulliez vous connecter<a href="connexion.php">ICI</a>pour accéder aux informations</div>
    <?php endif; ?>
    <?php if ($user_connected) : ?>
    <div class="content">
        <div class="informations">
            <?php
            echo "vous êtes connectés en tant que $nom \"$pseudo\" $prenom"
            ?>
        </div>
        <div class="Mes réservations">
            <h4>Mes réservations</h4>
            <table>
                <thead>
                    <td>Titre</td>
                    <td>Couverture</td>
                    <td>Annuler la réservation</td>
                </thead>
            <?php foreach ($reservations as $reservation) : ?>
                <?php $livre=$livreRepository->fetchId($reservation->getIdUser()); ?>
                <tr>
                    <td><?php echo $livre->getTitre(); ?></td>
                    <td><?php echo $livre->getImage(); ?></td>
                    <td><form action="espace_perso.php" method="POST"><input style="display:none" type="text" name="id_rendre" value=<?php $tmp=$reservation->getIdLivre(); echo "$tmp"; ?>><input type="submit" value="Annuler"></form></td>
                </tr>
            <?php endforeach; ?>
            </table>
        </div>
        <div class="Mes emprunts">
            <h4>Mes emprunts</h4>
            <table>
                <thead>
                    <td>Titre</td>
                    <td>Couverture</td>
                </thead>
                <?php foreach ($empruntés as $emprunté) : ?>
                    <tr>
                        <td><?php echo $emprunté->getTitre(); ?></td>
                        <td><?php echo $emprunté->getImage(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
<?php endif; ?>
     </p>
     </body>
     </html>
     
     