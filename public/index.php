<?php
require '../vendor/autoload.php';
include('./admin/functions.php');
session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
//début du document html
//
displayHeader();
?>


<h1 id="MainTitle"> <label> Bienvenue sur le site où on gratte ses points asso' pour valider le semestre ! </label> </h1>

<?php displayAll($users);?>


<footer> Attention ce site n'est pas fait pour les fantômes... </footer>
</body>
</html>
