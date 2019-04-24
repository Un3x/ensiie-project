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
$users = $userRepository->fetchAll();
$livres = $livreRepository->fetchAll();

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="top"> <!--ajout d'un haut de page si l'utilisateur est admin ou si il est connecté-->
        <?php
        if ($user_connected) {
            echo "<p>Vous êtes connecté en tant que $nom \"$pseudo\" $prenom</p><p>Lien vers votre <a href=\"espace_perso.php\">espace perso</a></p>";
        }
        if ($admin) {
            echo "<p>Espace admin : </p>";
            echo "<p><a href=\"ajout_livre.php\">Ajout Livre</a> <a href=\"emprunt.php\">Emprunt</a> <a href=\"rendu.php\">Rendu</a>";
        }
        ?>
    </div>

    <div class="container">
    <h2>Bienvenu sur le site de Sciience</h2>


<!-- test d'ajout d'un membre -->
<?php


$tmp = $userRepository->creeUser('4','ca mahe', 'hesre', 'fwdf', '2004-03-01', '12', '@dfd', '1', '1', True);



echo $userRepository->updateUser($tmp);

$users = $userRepository->fetchAll();

?>

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


    </div>
    </body>
    </html>
