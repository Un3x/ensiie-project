<?php
// var_dump($_POST);
$surnom = $_POST['surnom'];
$mdp = $_POST['mdp'];
$rmdp = $_POST['rmdp'];
$role = $_POST['role'];
$regime = $_POST['regime'];

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

if($mdp != $rmdp){
    echo "Le mot de passe n'est pas identique<br/>";
    echo "<a href='http://localhost:8080'>Revenir à la page de connection</a>";
}
else{
    try{
       
        $pdo = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*$query1 = "insert into user1(surnom,mdp,role,regime) VALUES (:surnom,:mdp,:role,:regime)";
                $request1 = $pdo->prepare($query1);
                 $request1->bindParam(':surnom', $surnom);
                 $request1->bindParam(':mdp', $mdp);
                 $request1->bindParam(':role', $sole);
                 $request1->bindParam(':regime', $regime);
                
                $res1 = $request1->execute();
                if(!empty($res1)){
                   echo "注册成功！！";
                    echo "<a href='http://localhost:8080'>返回登陆界面</a>";
                }
                
            } catch (Exception $e) {
                die("注册失败！！！".$e->getMessage());
            }




            */
        $query1 = "select * from user1 where surnom=:surnom";
        $request1 = $pdo->prepare($query1);
        $request1->bindParam(':surnom', $surnom);
        $request1->execute();
        $res1 = $request1->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($res1)){
            echo "Surnom déjà utilisé";
        }
        else{
            $query2 = "insert into user1(surnom, mdp,role, regime) values ('$surnom', '$mdp', '$role', '$regime')";
           
            $pdo->exec($query2);
           {    echo "Bienvenu à CuIsInE!!!<br/>";
                echo "<a href='http://localhost:8080'>Revenir à la page de connection</a>";
           }   
        } 
    }
        catch(PDOException $e)
{
    echo $query2 . "<br>" . $e->getMessage();
}
 
$pdo = null;
           
    
}
?>
