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
<title>Challenge Centrale Evry</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="index_style.css">
</head>
 
<body>
 
  <div>
        Bienvenue au Challenge Centrale Evry !
  </div>
 
  <div id="conteneur">
    <div>
        INTRO
    </div>
    <div>
        PHOTOS
    </div>
    <div>
DISCOURS
    </div>
  </div>
 
  <div>
FOOTER
  </div>
 
</body>
</html>