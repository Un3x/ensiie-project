<?php
function modification ($arg1,$arg2,$arg3,$arg4,$arg5,$arg6)
{
// connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');
    $pseudo = $_SESSION['pseudo'];
    if($arg1 !== "") {
        $query=$connection->prepare('UPDATE Identite SET nom=? WHERE pseudo=?');
        $query->execute(array($arg1,$pseudo));
    }

    if($arg2 !== "") {
        $query=$connection->prepare('UPDATE Identite SET prenom=? WHERE pseudo=?');
        $query->execute(array($arg2,$pseudo));
    }

    if($arg3 !== "") {
        $query=$connection->prepare('UPDATE Identite SET ville=? WHERE pseudo=?');
        $query->execute(array($arg3,$pseudo));
    }

    if($arg4 !== "") {
        $query=$connection->prepare('UPDATE Identite SET region=? WHERE pseudo=?');
        $query->execute(array($arg4,$pseudo));
    }
    if($arg5 !== "") {
        $query=$connection->prepare('UPDATE Identite SET mdp=? WHERE pseudo=?');
        $query->execute(array($arg5,$pseudo));
    }

    if($arg6 !== "") {
        $query=$connection->prepare('UPDATE Identite SET phrase=? WHERE pseudo=?');
        $query->execute(array($arg6,$pseudo));
    }

    $connection=null;
}

?>
