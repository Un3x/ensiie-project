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
    <title>emprunt</title>
</head>
<body>
<div class="container">
	<h1>Page d'emprunt (réservée aux admin)</h1>
	<!--on affiche ensuite un formulaire pour désigner le livre à emprunter ainsi que la personne qui emprunte-->
	<form>
	</form>
</div>
</body>
</html>