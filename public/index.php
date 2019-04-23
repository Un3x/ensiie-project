<?php

require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
#$users = $userRepository->fetchAll();
?>

<html>
<head>
<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>

    <div class="container">
    <h3><?php echo 'Hello world from Docker! php' . PHP_VERSION; ?></h3>


<!-- test d'ajout d'un membre -->
<?php


$tmp = $userRepository->creeUser('4','ca mahe', 'hesre', 'fwdf', 4, '12', '@dfd', '1', '1', True);



echo $userRepository->updateUser($tmp);

$users = $userRepository->fetchAll();

?>
<table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>#</td>
    <td>Prenom</td>
    <td>Nom</td>
    <td>Pseudo</td>
    </thead>
<?php /** @var \User\User $user */
    foreach ($users as $user) : ?>
    <tr>
    <td><?php echo $user->getId() ?></td>
    <td><?php echo $user->getPrenom() ?></td>
    <td><?php echo $user->getNom() ?></td>
    <td><?php echo $user->getPseudo() ?></td>
    </tr>
<?php endforeach; ?>
    </table>
    </div>
    </body>
    </html>
