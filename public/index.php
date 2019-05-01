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
    <link rel="stylesheet" href="style.css">
</head>
<div class="top"> <!--ajout d'un haut de page si l'utilisateur est admin ou si il est connecté-->
        <?php
        if ($user_connected) {
            echo "<TABLE >
      <TR>
        <TD class=\"bande1\" align=\"left\" WIDTH=\"100%\">Vous êtes connecté en tant que $nom \"$pseudo\" $prenom</TD>
        <TD style=\"border:none; height:30px\" align=\"right\"><form action=\"deconnection.php\"><input class=\"bande2\" type=\"submit\" value=\"Deconnection\"></form></TD>
      </TR>
    </TABLE>";

            //"<p style=\"white-space: no-wrap\">Vous êtes connecté en tant que $nom \"$pseudo\" $prenom<div style=\"white-space: no-wrap\">Deconection</div> </p>";

        }
        else {
            echo "<TABLE >
      <TR>
        <TD class=\"bande1\" align=\"left\" WIDTH=\"100%\"></TD>
        <TD style=\"border:none; height:30px\" align=\"right\"><form action=\"connexion.php\"><input class=\"bande2\" type=\"submit\" value=\"Connection\"></form></TD>
      </TR>
    </TABLE>";
        }
        
        ?>
    </div>
<body>
    <header>
        <img src="./titre.png"/>
    </header>
     <nav>
        <a href="index.php" class="rubrique">Accueil    </a>
        <a href="bibliotheque.php" class="rubrique">|   Bilbiothèque    </a>
        <?php if ($user_connected): ?>
            <a href="espace_perso.php" class="rubrique">|   Espace perso    </a>
            <a href="review.php" class="rubrique">|   Review    </a>
            <a href="editer.php" class="rubrique">|   Editer   </a>
            <?php endif; ?>
        <?php if ($user_connected && $admin): ?>
            <a href="ajout_livre.php" class="rubrique">|   Ajout livre   </a>
            <a href="rendu.php" class="rubrique">|   Retour   </a>
            <a href="emprunt.php" class="rubrique">|   Emprunt   </a>
        <?php endif; ?>
    </nav>

    <div class="container">
        <section>
    <div class="grand-titre">Bienvenue sur le site de Sciience</div>





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
    </section>
    </body>
    </html>
