
<?php
var_dump($_POST);
//$uid = $_POST["uid"];
//$pwd = $_POST["pwd"];
//$name = $_POST["name"];
@$username = $_POST[username];
@$userpass = $_POST[userpass];

 //1.造连接对象
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
try{
$pdo = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$query = "select * from user where username=:username and userpass = :userpass " ;
         $request = $pdo->prepare($query);
         $request->bindParam(':username', $username);
         $request->bindParam(':userpass', $userpass);
         $request->execute();
         $res = $request->fetchAll(PDO::FETCH_ASSOC);        
        /* if (!empty($res)){
             header('Location: http://localhost/P_U/View/main.php');
         }else{
             header('Location: http://localhost/P_U/View/login.php');
         }*/
     } catch (Exception $e) {
         die("Error!!".$e->getMessage());
     }

 /*2.写SQL语句
   insert into添加语句    
   $sql = "insert into login values('{$uid}','{$name}','{$pwd}',0)";
 //3.执行
   $r = $db->query($sql);
   if($r)
   {
  echo "注册成功！";    
 }
 else
 {
     echo "注册失败！";    
 }*/

       
 ?>
