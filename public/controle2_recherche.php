<?php
function recherche($terme) {

// connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');

    $select_terme = $connection->prepare("SELECT pseudo, nom, prenom FROM Identite WHERE pseudo LIKE ? OR nom LIKE ? OR prenom LIKE ?");
    $select_terme->execute(array("%".$terme."%", "%".$terme."%", "%".$terme."%"));
    $resultat=array();
    while($tuple_courant=$select_terme->fetch()){
        $temporaire=array('pseudo' => $tuple_courant['pseudo'],'nom'=> $tuple_courant['nom'],'prenom' =>$tuple_courant['prenom']);
        $resultat[]=$temporaire;
    }
    return $resultat;
    $connection=null;
}
?>
