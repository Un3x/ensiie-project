<?php
require '../vendor/autoload.php';

function get_identite($pseudo)
{

//postgres
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');

    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    $requete = $connection->prepare("SELECT * FROM Identite NATURAL JOIN Avatar WHERE pseudo = ?");

    if($requete->execute(array($pseudo))){
        $donnes = $requete->fetch();
        $tab=array('pseudo' => $donnes['pseudo'],'nom' => $donnes['nom'],'prenom' => $donnes['prenom'], 'ville' => $donnes['ville'],'region' => $donnes['region'], 'sexe' => $donnes['sexe'],'note' => $donnes['note'],'phrase' => $donnes['phrase'],'avatar' => $donnes['avatar']);
        return $tab;
    }

    else{
        echo "err";
    }
}

function get_commentaire($pseudo)
{
    //postgres
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');

    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    $requete = $connection->prepare("SELECT * FROM Commentaire WHERE pseudo = ? ORDER BY dat,heur");
    if($requete->execute(array($pseudo))){
        $donnes=array();
        while($tuple_courant = $requete -> fetch()){
            $tab=array('pseudo' => $tuple_courant['pseudo'], 'commentaire' => $tuple_courant['commentaire'], 'commentateur' => $tuple_courant['commentateur'], 'dat' => $tuple_courant['dat'], 'heur' => $tuple_courant['heur']);
            $donnes[]=$tab;
        }
        return $donnes;
    }

    else {
        echo "err";
    }

}



?>