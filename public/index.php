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
<html>
<head>
    <title> Accueil </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../public/res/css/accueil.css" />
    <link rel="stylesheet" href="../../public/res/css/main.css" />
</head>
<body>



<div id="colonne2">
<a href="MonCompte.phtml">Se connecter</a> 
<a href="Compte.phtml">S'inscrire</a>

</div>


<div id="colonne1">



</div>

<div id="centre">
        <div id="recherche">
            <a href="Recherche.phtml"> Je cherche une colocation </a>
        </div>
        <div id="createlogement">
            <a href="Create_Logement.phtml"> Je propose une colocation </a>
        </div>
</div>

</body>
</html>