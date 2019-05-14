<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div>
    <a href="main.php">Accueil</a>
</div>

<div class="container">
    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>Pseudo</td>
            <td>Courriel</td>
            <td>Mot de passe</td>
        </thead>
        <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getpseudo() ?></td>
                <td><?php echo $user->getcourriel() ?></td>
                <td><?php echo $user->getmotdepasse() ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div>
    <a href="main.php">Accueil</a>
</div>
</body>
</html>
