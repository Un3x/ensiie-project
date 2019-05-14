<?php
// var_dump($_POST);
$recherche = $_POST['recherche'];

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');


try{
    $pdo = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    $query1 = "select * from stock where ingrediant like '%:recherche%'";
    $request1 = $pdo->prepare($query1);
    $request1->bindParam(':recherche', $recherche);
    $request1->execute();
    $res1 = $request1->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($res1)){
        echo "Pas de résultat";
        echo "<a href='http://localhost:8080/mandats.html'>Retour</a>";
    }
    else{
        echo "<table><tr><th>Surnom</th><th>Ingrediant</th><th>Quantité</th><th>Expiration</th></tr>";
        foreach($res1 as $line){
            echo "<tr>";
            foreach($line as $value){
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
    }
}
catch (Exception $e){
    die("Base de données hors service".$e->getMessage());
}

?>
