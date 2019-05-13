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
        <img src="../images/sciience.png" alt="Logo du site"/>
    </header>
     <nav>
        <?php affiche_nav($user_connected, $admin) ?> <!-- dans utils.php -->
    </nav>

    <div class="container">
        <section>
    <div class="grand-titre">Bienvenue sur le site de Sciience</div>
    <div class="res"> News scientifique</div>
    <h2>On a marché sur la lune !</h2>

    <table>
        <tr><td><img src="../images/lune.jpg" width="80%" length="80%" alt="Photo de la lune"/></td>
            <td class="centre_verticalement"> <p><div>Et oui, ce 21 juillet 1969, Neil Armstrong a foulé le sol de notre bon vieux satellite naturel. Incroyable me direz-vous ! Comment ? C'était il y a 50ans ?! C'est incroyable ! Le temps passe si vite...</div>
            C'est en effet il y a presque 50 ans jour pour jour que Apollo 11 s'est posé sur la lune, le 21 juillet 1969 à 2h56 heure française.
            <br>Vous voulez en savoir plus ? C'est pas mon problème débrouillez vous tout seul. Ou alors cliquez <a href="https://fr.wikipedia.org/wiki/Apollo_11">ici</a>.
            D'ailleurs si vous voulez contempler la lune sous toute les coutures n'hésitez pas à regarder cette <a href="https://www.nasa.gov/content/ultra-high-definition-video-gallery">vidéo</a>
            </td>
        </tr>
    </table>
</p>

<div class="res"> Mode d'emploi</div>
<p>
    Ce site est principalement fait pour que vous puissiez accéder aux livres appartenant à ScIIEnce GRATUITEMENT. 
    Pour récupérer un livre, c'est très simple: <br>
    <br>
    Il suffit de vous rendre sur la page Bibliothèque, puis cherchez le livre qui vous intéresse ou parcourez l'ensemble de notre collection. 
    Cliquez ensuite sur le bouton réserver. Enfin, il vous suffit de venir voir Tanguy "Ansyth" Charles qui vous prêtera volontier le livre que vous avez réservé. 
    Si par mégarde vous avez réservé un livre dont vous n'avez pas besoin, il vous sufft de vous rendre sur mon espace perso, 
    puis mes réservations et d'annuler la réservation effectuée.
</p>



    </section>
    <?php affiche_footer()?>
    </body>
    </html>
