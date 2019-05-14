<?php
function noter ($arg_note,$destinataire)
{
// connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');

    $note=$arg_note;
    $query = $connection->prepare('INSERT INTO Notation(pseudo,note) VALUES(:pseudo,:note)');
    $query->bindValue('pseudo',$destinataire,PDO::PARAM_STR);
    $query->bindValue('note',$note,PDO::PARAM_INT);
    $query->execute();
    mis_a_jour_note($destinataire);
    $connection=null;
}
?>
