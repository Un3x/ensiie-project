<?php
function ignorer($auteur,$commentaire,$commentateur,$dat,$heur)
{
    //connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');

    // suppression des informations dans la table des signalemennts
    $query = $connection->prepare("DELETE FROM Signalement WHERE pseudo=? AND commentaire=? AND commentateur=? AND dat=? AND heur=?");
    $query->execute(array($auteur,$commentaire,$commentateur,$dat,$heur));


    //deconnexion de la base de données
    $connection=null;

}
?>