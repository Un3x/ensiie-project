<?php
function commenter ($arg_com,$destinataire)
{
// connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');
    $pseudo = $_SESSION['pseudo'];
    $commentaire=$arg_com;
    $query = $connection->prepare('INSERT INTO Commentaire(pseudo,commentaire,commentateur,dat,heur) VALUES(:pseudo,:commentaire,:commentateur,CURRENT_DATE ,CURRENT_TIME )');
    $query->bindValue('pseudo',$destinataire,PDO::PARAM_STR);
    $query->bindValue('commentaire',$commentaire,PDO::PARAM_STR);
    $query->bindValue('commentateur',$pseudo,PDO::PARAM_STR);
    $query->execute();
    $connection=null;
}
?>
