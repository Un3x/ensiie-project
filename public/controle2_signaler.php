<?php
function signaler($commentaire,$commentateur,$dat,$heur)
{
// connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');

    $pseudo = $_SESSION['pseudo'];
    $query=$connection->prepare('INSERT INTO Signalement(pseudo,commentaire,commentateur,dat,heur) VALUES(:pseudo,:commentaire,:commentateur,:dat,:heur)');
    $query->bindValue('pseudo',$pseudo,PDO::PARAM_STR);
    $query->bindValue('commentaire',$commentaire,PDO::PARAM_STR);
    $query->bindValue('commentateur',$commentateur,PDO::PARAM_STR);
    $query->bindValue('dat',$dat,PDO::PARAM_STR);
    $query->bindValue('heur',$heur,PDO::PARAM_STR);
    $query->execute();

    // fermeture connexion base de donnees
    $connection=null;

}
