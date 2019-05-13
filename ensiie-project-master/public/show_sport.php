<?php
require '../vendor/autoload.php';
require '../src/Sport/SportRepository.php';
require '../src/Sport/Sport.php';
include("ini_session.php");
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$sportRepository = new \Sport\SportRepository($connection);
$sports = $sportRepository->fetchAll();
$userRepository = new \User\UserRepository($connection);
$usersParticipant = $userRepository->fetchAllParticipant();
$usersJury = $userRepository->fetchAllJury();
$usersOrganisateur = $userRepository->fetchAllOrganisateur();
$rows = $sportRepository->fetchAllUsers();
?>

<html lang="en" dir="ltr">
<head>
    <title>Challenge Centrale Evry</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">

    <?php include ("header.php")?>
</head>
<body>
    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>Sport</td>
            <td>Prenom</td>
            <td>Nom</td>
            <td>Genre</td>
            <td>Lieu</td>
        </thead>
         <?php /** @var \User\User $user */
        
        foreach ($rows as $row) : ?>
            <tr>
                <td><?php echo $row->sport ?></td>
                <td><?php echo $row->prenom ?></td>
                <td><?php echo $row->unom ?></td>
                <td><?php echo $row->genre ?></td>
                <td><?php echo $row->lieu ?></td>
            </tr>
        <?php endforeach;?>
    </table>

    <?php include("footer.php") ?>

</body>
</html>

