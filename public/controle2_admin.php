<?php
function get_signalement()
{

// connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');


    $select_terme = $connection->prepare("SELECT *,COUNT(pseudo) AS n FROM Signalement GROUP BY (pseudo,commentaire,commentateur,dat,heur)");
    $select_terme->execute(array());
    $resultat=array();
    while($tuple_courant=$select_terme->fetch()){
        $temporaire=array('nombre' => $tuple_courant['n'],'pseudo' => $tuple_courant['pseudo'],'commentaire'=> $tuple_courant['commentaire'],'commentateur' =>$tuple_courant['commentateur'], 'dat' =>$tuple_courant['dat'], 'heur' =>$tuple_courant['heur']);
        $resultat[]=$temporaire;
    }
    return $resultat;
    $connection=null;

}

?>
