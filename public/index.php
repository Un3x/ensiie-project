<?php

require '../vendor/autoload.php';


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

?>

<html>
<head>
    <title>Sciience</title>
<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="rien.css">
</head>
<nav>
        <a href="test.html" class="rubrique">Accueil    </a>
        <a href="test.html" class="rubrique">|   Bilbiothèque    </a>
        <a href="test.html" class="rubrique">|   Réservation    </a>
        <a href="test.html" class="rubrique">|   Recherche    </a>
        <a href="test.html" class="rubrique">|   Inscription    </a>
    </nav>
<body>
    <div class="top"> <!--ajout d'un haut de page si l'utilisateur est admin ou si il est connecté-->
        <?php
        if ($user_connected) {
            echo "<p>Vous êtes connecté en tant que $nom \"$pseudo\" $prenom</p><p>Lien vers votre <a href=\"espace_perso.php\">espace perso</a></p>";
            if ($admin) {
            echo "<p>Espace admin : </p>";
            echo "<p><a href=\"ajout_livre.php\">Ajout Livre</a> <a href=\"emprunt.php\">Emprunt</a> <a href=\"rendu.php\">Rendu</a>";
        }
        }
        
        ?>
    </div>

    <div class="container">
        <a href="inscription.php">TMPinscription</a><br>
        <a href="ajout_livre.php">TMPajout_livre</a><br>
        <a href="editer.php">TMPediter</a><br>
        <a href="emprunt.php">TMPemprunt</a><br>
        <a href="rendu.php">TMPrendu</a><br>
        <a href="bibliotheque.php">TMPbibliotheque</a><br>
        <a href="review.php">TMPreview</a>
    <h2>Bienvenu sur le site de Sciience</h2>



<section>
<p><a href="connexion.php">lien vers la connexion</a></p>

<table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>#</td>
    <td>Prenom</td>
    <td>Nom</td>
    <td>Pseudo</td>
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
    <td><?php echo $user->getDdn() ?></td>
    <td><?php echo $user->getNbLivresEmpruntes() ?></td>
    <td><?php echo $user->getNbLivresRendus() ?></td>
    </tr>
<?php endforeach; ?>
    </table>
</section>

<?php //test d'insertion de livre
$tmp=$livreRepository->creeLivre('13', 'titre', 'jsb', '1990-02-03', 'toto', 'leseditionsquidechirent', '3', '2001-10-23');
echo $livreRepository->insertLivre($tmp);

$livres = $livreRepository->fetchAll();

?>

<section>
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
</section>

<?php
//test d'insertion d'auteur
$tmp = $auteurRepository->creeAuteur('chocapic1', 'mario');
$auteurRepository->insertAuteur($tmp);
$auteurs = $auteurRepository->fetchall();
?>


<section>
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
</section>



<section>
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
</section>



<section>
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
</section>
    </div>
    </body>
    </html>
