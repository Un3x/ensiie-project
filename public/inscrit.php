<html>
    <body>
    <img src="ImageInscrit.png" style="margin-top=500px" width="270" height="200">
    </body>
</html>

<?php
// var_dump($_POST);
$fname = $_POST['fname'];
$falimen = $_POST['falimen'];


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');


    try{
       
        $pdo = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
              
        $query3 = "select * from user2 where fname=:fname";
        $request3 = $pdo->prepare($query3);
        $request3->bindParam(':fname', $fanme);
        $request3->execute();
        $res3 = $request3->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($res3)){
            echo "Nom déjà inscrit";
        }
        else{
            $query4 = "insert into \"user2\"(fname, falimen) values ('$fname', '$falimen')";
           
            $pdo->exec($query4);
           {    echo "Merci !!!<br/>";
                echo "<a href='http://localhost:8080/Accueil.php'>Revenir à la page d'Accueil</a>";
           }   
        } 
    }
        catch(PDOException $e)
{
    echo $query4 . "<br>" . $e->getMessage();
}
 
$pdo = null;
           
    

?>
