<?php
function entrer_avatar ($choix)
{
// connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');

    $pseudo=$_SESSION['pseudo'];
    $query=$connection->prepare("UPDATE Avatar SET avatar=? WHERE pseudo=?");
    $query->execute(array($choix,$pseudo));

    $connection=null;

}
