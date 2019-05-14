<?php
function mis_a_jour_note ($pseudo)
{
// connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');
    $query=$connection->prepare('SELECT COUNT(*) as n, SUM(note) as s FROM Notation WHERE pseudo = ?');
    $query->execute(array($pseudo));
    $reponse=$query->fetch();
    $quantite=$reponse['n'];
    $total=$reponse['s'];
    $note=$total/$quantite;
    $requete =$connection->prepare("UPDATE Identite SET note =$note WHERE pseudo=?");
    $requete->execute(array($pseudo));
    $connection=null;
}
?>