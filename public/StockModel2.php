<?php
// var_dump($_POST);
$ingrediant = $_POST['ingrediant'];
$surnom = $_POST['surnom'];
$qte = $_POST['qte'];
$expiration = $_POST['expiration'];
$role = $_POST['role'];

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

try{
    $pdo = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    $query1 = "select * from user1 natural join stock where ingrediant=:ingrediant and surnom=:surnom or role!=:role";
    $request1 = $pdo->prepare($query1);
    $request1->bindParam(':ingrediant', $ingrediant);
    $request1->bindParam(':surnom', $surnom);
    $request1->bindParam(':role', $role);
    $request1->execute();
    $res1 = $request1->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($res1)){
        echo "Ingrediant déjà existant pour ce Surnom ou que ce Surnom n'est pas autoriser à stocker";
    }
    else{
        $query2 = "insert into \"stock\"(surnom, ingrediant, qte, expiration) values (':surnom', ':ingrediant', ':qte', ':expiration');";
        $request2 = $pdo->prepare($query2);
        $request2->bindParam(':surnom', $surnom);
        $request2->bindParam(':ingrediant', $ingrediant);
        $request2->bindParam(':qte', $qte);
        $request2->bindParam(':expiration', $expiration);
        $request2->execute();
        $res2 = $request2->fetchAll(PDO::FETCH_ASSOC);
        echo "Votre ingrediant est stocker";
        echo "<a href='http://localhost:8080/mandats.html'>Revenir à la page de Stockage";
    }
}
catch (Exception $e){
    die("Base de données hors service".$e->getMessage());
}
?>
