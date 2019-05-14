<?php
require '../../vendor/autoload.php';
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if (empty($_SESSION['login'])) {
	// Si inexistante ou nulle, on redirige vers le formulaire de login
	header('Location: ../authentification.php');
	exit();
}

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$iduser = $users[$_SESSION['login']]->getId();


$points = $connection->query('SELECT name,notation moyenne from (pointsassos join associations using (id_asso)) where id_user='.$iduser)->fetchAll(\PDO::FETCH_OBJ);
$events = $connection->query('select e.name name_event,a.name name_asso,notation,date_ev from ((select name,notation,id_asso,id_user,date_ev from score join events using (id_event)) e join associations a using (id_asso)) where id_user='.$iduser)->fetchAll(\PDO::FETCH_OBJ);
$moyenne = $connection->query('select moyenne from leaderboard where id_user='.$iduser)->fetch(\PDO::FETCH_OBJ);
$participations = $connection->query('SELECT score.id_event score_id_ev, notation FROM score NATURAL JOIN events WHERE id_user = '.$iduser)->fetchAll(\PDO::FETCH_OBJ);
$assos=$connection->query("select * from associations")->fetchAll(\PDO::FETCH_OBJ);



if (!empty($_POST['event']) && !empty($_POST['note'])){
	$connection->query('insert into score (id_user,id_event,notation) values ('.$iduser.','.$_POST['event'].','.$_POST['note'].')');	
}
if (!empty($_POST['association'])){
	$_SESSION["asso"]=$_POST['association']; 
}

header('Location: ../eleve.php');
?>

