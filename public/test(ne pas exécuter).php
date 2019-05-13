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
$auteurRepository = new \Auteur\AuteurRepository($connection);
$reservationRepository = new \Reservation\ReservationRepository($connection);
$historiqueRepository = new \Historique\HistoriqueRepository($connection);


$users = $userRepository->fetchAll();
$livres = $livreRepository->fetchAll();
$auteurs = $auteurRepository->fetchall();
$reservations = $reservationRepository->fetchAll();
$historiques = $historiqueRepository->fetchAll();


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

?>

<html>
<head>
    <title>Sciience</title>
<!-- Latest compiled and minified CSS -->
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

    <div class="container">
        <section>
    <div class="grand-titre">Bienvenue sur le site de Sciience</div>
    <div class="res"> News scientifique</div>
    <h2>On a marché sur la lune !</h2>

    <p><div>Et oui, ce 21 juillet 1969, Neil Armstrong a foulé le sol de notre bon vieux satellite naturel. Incroyable me direz-vous. Quoi ? C'était il y a 50ans ??? Wow le temps passe beaucoup trop vite</div>C'est en effet il y a presque 50 ans jour pour jour que Apollo 11 s'est posé sur la lune, le 21 juillet 1969 à 2h56 heure française. Vous voulez en savoir plus ? C'est pas mon problème débrouillez vous tout seul. Ou alors cliquez <a href="https://fr.wikipedia.org/wiki/Apollo_11">ici</a>.
    D'ailleurs si vous voulez contempler la lune sous toute les coutures n'hésitez pas à regarder cette vidéo:
</p>

<div class="res"> Mode d'emploi</div>
<p>
    Ce site est principalement fait pour que vous puissiez accéder aux livres appartenant à ScIIEnce GRATUITEMENT. Pour récupérer un livre, c'est très simple. Il suffit de vous rendre sur la page Bibliothèque. Cherchez le livre dont vous avez besoin ou parcourez l'ensemble de notre collection. Cliquez sur le bouton réserver. Ensuite, il vous suffit de venir voir Tanguy "Ansyth" Charles qui vous prêtera volontier le livre que vous avez réservé. Si par mégarde vous avez réservé un livre dont vous n'avez pas besoin, il vous sufft de vous rendre sur mon espace perso, puis mes réservations et d'annuler la réservation effectuée.
    





<!--
<table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>#</td>
    <td>Prenom</td>
    <td>Nom</td>
    <td>Pseudo</td>
    <td>MDP</td>
    <td>DDN</td>
    <td>Empruntés</td>
    <td>Rendus</td>
    </thead>
<?php /** @var \User\User $user */
    foreach ($users as $user) : ?>
    <tr>
    <td><?php echo $user->getId() ?></td>
    <td><?php echo $user->getPrenom() ?></td>
    <td><?php echo $user->getNom() ?></td>
    <td><?php echo $user->getPseudo() ?></td>
    <td><?php echo $user->getMdp() ?></td>
    <td><?php echo $user->getDdn() ?></td>
    <td><?php echo $user->getNbLivresEmpruntes() ?></td>
    <td><?php echo $user->getNbLivresRendus() ?></td>
    </tr>
<?php endforeach; ?>
    </table>

<?php //test d'insertion de livre
$tmp=$livreRepository->creeLivre('13', 'titre', 'jsb', '1990-02-03', 'toto', 'leseditionsquidechirent', '3', '2001-10-23');
echo $livreRepository->insertLivre($tmp);

$livres = $livreRepository->fetchAll();

?>

    <h3> test sur les livres</h3>
    <table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>#</td>
    <td>titre</td>
    <td>publication</td>
    <td>couverture</td>
    <td>editeur</td>
    <td>emprunteur</td>
    <td>date emprunt</td>
    </thead>
<?php /** @var \User\User $user */
    foreach ($livres as $livre) : ?>
    <tr>
    <td><?php echo $livre->getId() ?></td>
    <td><?php echo $livre->getTitre() ?></td>
    <td><?php echo date_format ($livre->getPublication(), 'Y-m-d') ?></td>
    <td><?php echo $livre->getImage() ?></td>
    <td><?php echo $livre->getEdition() ?></td>
    <td><?php echo $livre->getEmprunteur() ?></td>
    <td><?php echo date_format($livre->getDateEmprunt(), 'Y-m-d') ?></td>
    </tr>
<?php endforeach; ?>
    </table>

<?php
//test d'insertion d'auteur
$tmp = $auteurRepository->creeAuteur('chocapic1', 'mario');
$auteurRepository->insertAuteur($tmp);
$auteurs = $auteurRepository->fetchall();
?>


    <h3> test sur les auteurs</h3>
    <table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>id_livre</td>
    <td>auteur</td>
    </thead>
<?php /** @var \User\User $user */
    foreach ($auteurs as $auteur) : ?>
    <tr>
    <td><?php echo $auteur->getIdLivre() ?></td>
    <td><?php echo $auteur->getAuteur() ?></td>
    </tr>
<?php endforeach; ?>
    </table>





    <h3> test sur les réservations</h3>
    <table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>id_livre</td>
    <td>id_user</td>
    </thead>
<?php /** @var \User\User $user */
    foreach ($reservations as $reservation) : ?>
    <tr>
    <td><?php echo $reservation->getIdLivre() ?></td>
    <td><?php echo $reservation->getIdUser() ?></td>
    </tr>
<?php endforeach; ?>
    </table>





    <h3> test sur les historiques</h3>
    <table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>id_livre</td>
    <td>id_user</td>
    <td>date emprunt</td>
    <td>date rendu</td>
    </thead>
<?php /** @var \User\User $user */
    foreach ($historiques as $historique) : ?>
    <tr>
    <td><?php echo $historique->getIdLivre() ?></td>
    <td><?php echo $historique->getIdUser() ?></td>
    <td><?php echo date_format($historique->getDateEmprunt(), 'Y-m-d') ?></td>
    <td><?php echo date_format($historique->getDateRendu(), 'Y-m-d') ?></td>
    </tr>
<?php endforeach; ?>
    </table>

    </div>
-->
    </section>
    <?php affiche_footer()?>
    </body>
    </html>