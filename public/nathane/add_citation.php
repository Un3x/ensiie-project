<?php

require '../../vendor/autoload.php';

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$req=$connection->prepare('UPDATE "nathane_citations" SET citation=:citation WHERE nombre=:num;');
$req->execute(array(
    'citation' => $_POST['c'],
    'num' => $_POST['n']
));

header("Location: gain.php");
?>