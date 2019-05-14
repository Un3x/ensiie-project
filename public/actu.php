<?php
require '../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

if (isset($_POST['add'])) {
    $req = $connection->prepare('INSERT INTO actualite (actu) VALUES (:actu)');
    $req->execute(array(
        'actu' => $_POST['add']
    ));
}

if (isset($_POST['delete'])) {
    $req = $connection->prepare('DELETE FROM actualite WHERE actu=:actu');
    $req->execute(array(
        'actu' => $_POST['delete']
    ));
}

header("Location: accueil.php");
?>