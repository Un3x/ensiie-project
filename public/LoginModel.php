<?php
    $surnom = $_POST['surnom'];
    $mdp = $_POST['mdp'];
    
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');

    try {
        $pdo = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        $query = "select * from user1 where surnom=:surnom and mdp = :mdp";
        $request = $pdo->prepare($query);
        $request->bindParam(':surnom', $surnom);
        $request->bindParam(':mdp', $mdp);
        $request->execute();
        $res = $request->fetchAll(PDO::FETCH_ASSOC);        
        if (!empty($res)){
            header('Location: http://localhost:8080/Accueil.php');
        }else{
            header('Location: http://localhost:8080');
        }
    } catch (Exception $e) {
        die("Error!!".$e->getMessage());
    }

 ?>