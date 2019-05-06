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
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut et la ligne $admin = false;
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
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
        <a href="bibliotheque.php" class="rubrique">|   Bibliothèque    </a>
        <?php if ($user_connected): ?>
            <a href="espace_perso.php" class="rubrique">|   Espace perso    </a>
            <a href="review.php" class="rubrique">|   Review    </a>
            <a href="editer.php" class="rubrique">|   Editer   </a>
            <?php endif; ?>
        <?php if ($user_connected && $admin): ?>
            <a href="liste_emprunts.php" class="rubrique">|   Liste   </a>
            <a href="ajout_livre.php" class="rubrique">|   Ajout livre   </a>
            <a href="rendu.php" class="rubrique">|   Retour   </a>
            <a href="emprunt.php" class="rubrique">|   Emprunt   </a>
        <?php endif; ?>
    </nav>
        <section>
     <div class="grand-titre">Bienvenue sur la page perso de <?php echo"$pseudo"; ?></div>
     <?php if (!($user_connected)) : ?>
        <div class="non connecté">
            Vous n'êtes pas connectés, veulliez vous connecter<a href="connexion.php">ICI</a>pour accéder aux informations</div>
    <?php endif; ?>
    <?php if ($user_connected) : ?>
    <div class="content">
        <div>
            <div class="res">Mes réservations</div>
            <?php if ($reservations == []): ?>
                <p>Vous n'avez pas de réservations</p>
            <?php endif; ?>
            <?php if ($reservations != []): ?>
            <table>
                <thead>
                    <th>Couverture</th>
                    <th>Titre</th>
                    <th>Annuler la réservation</th>
                </thead>
            <?php foreach ($reservations as $reservation) : ?>
                <?php $livre=$livreRepository->fetchId($reservation->getIdLivre()); ?>
                <tr>
                    <td class="couv"><img height="160" width="100" src=<?php echo $livre->getImage(); ?>></td>
                    <td><?php echo $livre->getTitre(); ?></td>
                    <td><form action="espace_perso.php" method="POST"><input style="display:none" type="text" name="id_rendre" value=<?php $tmp=$reservation->getIdLivre(); echo "$tmp"; ?>><input type="submit"  class="butcan" value="Annuler"></form></td>
                </tr>
            <?php endforeach; ?>
            </table>
            <p></p>
        <?php endif; ?>
        </div>
        <div class="Mes emprunts">
            <div class="res">Mes emprunts</div>
            <?php if ($empruntés == []): ?>
                <p>Vous n'avez pas d'emprunts en cours</p>
            <?php endif; ?>
            <?php if ($empruntés != []): ?>
            <table>
                <thead>
                    <th>Couverture</th>
                    <th>Titre</th>
                </thead>
                <?php foreach ($empruntés as $emprunté) : ?>
                    <tr>
                        <td class="couv"><img height="160" width="100" src=<?php echo $emprunté->getImage(); ?>></td>
                        <td><?php echo $emprunté->getTitre(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p></p>
        <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
     </p>
 </section>
     </body>
     </html>
     
     