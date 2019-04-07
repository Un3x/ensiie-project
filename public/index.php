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

<!DOCTYPE html>

<html lang="fr-FR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title> Points assos IIE </title>
</head>
<body>
<nav>
	<ul>
		<li><a href="/"> Accueil </a></li>
		<li><a href="/"> Connexion AriseID </a><li>
	</ul>
</nav>
<h1> Bienvenue sur le site où on gratte ses points asso' pour valider le semestre ! </h1>
<footer> Attention ce site n'est pas fait pour les fantômes... <footer>
<!-- example php : 
<div class="container">
    <h3><?php echo 'Hello world from Docker! php' . PHP_VERSION; ?></h3>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>#</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Age</td>
        </thead>
        <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getId() ?></td>
                <td><?php echo $user->getFirstname() ?></td>
                <td><?php echo $user->getLastname() ?></td>
                <td><?php echo $user->getAge() ?> years</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
-->

</body>
</html>
