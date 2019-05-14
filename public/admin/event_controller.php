<?php
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']) || empty($_SESSION['president']) ) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: ../authentification.php');
  exit();
}
if(empty($_SESSION['event']) || empty($_SESSION['association'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: ../president.php');
  exit();
}

  //Gros machin copié depuis authentification.php
require '../../vendor/autoload.php';
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
$user = $users[$_SESSION['login']];
$asso=$connection->query('select * from associations where id_asso='.$_SESSION["association"])->fetch(\PDO::FETCH_OBJ);
$events=$connection->query('select * from events where id_event='.$_SESSION['event'])->fetch(\PDO::FETCH_OBJ);
$eleves = $connection->query('select * from score left join users using (id_user) where id_event='.$_SESSION['event'])->fetchAll(\PDO::FETCH_OBJ);

if (array_key_exists('suppr',$_POST)){
	if ($connection->query("delete from score where id_event='".$_SESSION['event']."' and id_user=".$_POST['usertomodif'])){
		header('Location: ../event.php');
	}	
}
if (!empty($_POST['points'])) {
	$connection->query("update score set notation=".$_POST["points"].' where id_user='.$_POST['usertomodif']);
}
if (!empty($_POST['usertoadd'])){
	$connection->query("insert into score(id_user,id_event,notation) values (".$_POST['usertoadd'].",".$_SESSION['event'].",10)");
}
header('Location: ../event.php')
?>
