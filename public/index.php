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

<?php include_once("navbar.phtml"); ?>

<html>
<head>
    <title> Accueil </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../res/css/Accueil.css" />
    <link rel="stylesheet" href="../res/css/main.css" />
</head>
<body>



<div id="colonne1">



</div>

<div id="centre">
        <div id="recherche">
            <a href="searchlogement.php"> Je cherche une colocation </a>
        </div>
        <div id="createlogement">
            <a href="./createlogement.php"> Je propose une colocation </a>
        </div>
</div>

</body>
</html>