<?php
function supprimer_by_admin($autre_pseudo)
{
    //connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');

    // supression infos connexion
    $query = $connection->prepare("DELETE FROM Connexion WHERE pseudo=?");
    $query->execute(array($autre_pseudo));

    //suppression info identite
    $query=$connection->prepare('DELETE FROM Identite WHERE pseudo=?');
    $query->execute(array($autre_pseudo));

    //supression info commentaire
    $query=$connection->prepare('DELETE FROM Commentaire WHERE pseudo=? OR commentateur=?');
    $query->execute(array($autre_pseudo,$autre_pseudo));

    //suppression info notation
    $query=$connection->prepare('DELETE FROM Notation WHERE pseudo=?');
    $query->execute(array($autre_pseudo));

    //suppression info avatar
    $query=$connection->prepare('DELETE FROM Avatar WHERE pseudo=?');
    $query->execute(array($autre_pseudo));

    //suppression info dans signalements
    $query=$connection->prepare('DELETE FROM Signalement WHERE pseudo=? OR commentateur=?');
    $query->execute(array($autre_pseudo,$autre_pseudo));


    $connection=null;

}
?>
