<?php
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']) || empty($_SESSION['president'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: ../authentification.php');
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

$assos_pres = $connection->query('select * from associations where president='.$user->getId())->fetchAll(\PDO::FETCH_OBJ);
//debut detail evenement
//fin detail evenement


//un président doit pouvoir:
// - choisir quelle asso modifier
// - transmettre le role de président
// - rajouter,modifier, enlever un évènement
// - consulter, modifier, rajouter, enlever la participation d'un élève a un évènement
 
if (array_key_exists('suppr_eleve',$_POST)){
	if ($connection->query("delete from pointsassos where id_asso='".$_SESSION['association']."' and id_user=".$_POST["usertomodif"])){
	}	
}
// début suppression evenement
if (array_key_exists('suppr',$_POST) && !empty($_POST['idevent'])){
	if ($connection->query("delete from events where id_event='".$_POST['idevent']."'")){
	}	
}
//fin suppression evenement

//debut modification evenement
if (!empty($_POST['nameevent'])){
	$connection->query("update events set name='".$_POST["nameevent"]."' where id_event=".$_POST["idevent"]);
}
if (!empty($_POST['dateevent'])){
	$date = new DateTime($_POST['dateevent']);
	$date= $date->format('Y-m-d');
	$connection->query("update events set date_ev='".$date."' where id_event=".$_POST["idevent"]);
}

if (!empty($_POST['coeffevent'])){
	$connection->query("update events set coeff_event=".$_POST["coeffevent"]." where id_event=".$_POST["idevent"]);
}
if (!empty($_POST['descriptionevent'])){
	$connection->query("update events set description_event='".$_POST["descriptionevent"]."' where id_event=".$_POST["idevent"]);
}
//fin modification evenement

//debut création evenement
if (!empty($_POST['event_name']) && !empty($_POST['event_date']) && !empty($_POST['event_desc']) && !empty($_SESSION['association']) && !empty($_POST['coeff_event'])){
	$date = new DateTime($_POST['event_date']);
	$date= $date->format('Y-m-d');
	$connection->query("insert into events(name,id_asso,coeff_event,date_ev,description_event) values ('".$_POST['event_name']."',".$_SESSION['association'].",".$_POST['coeff_event'].",'".$date."','".$_POST['event_desc']."')");
}
//fin création evenement
//début modification points assos élèves
if (!empty($_POST['points']) && !empty($_POST['usertomodif'])){
	$connection->query('update pointsassos set notation='.$_POST['points'].' where id_user='.$_POST['usertomodif'].' and id_asso='.$_SESSION["association"]);
}
//fin modification points assos élèves

//début rajouter un élève
if (!empty($_POST['usertoadd'])){
	$connection->query("insert into pointsassos(id_user,id_asso,notation,proposition) values (".$_POST['usertoadd'].",".$_SESSION['association'].",10,1)");
}
//fin rajouter un élève
if (!empty($_POST['association'])){
$_SESSION['association']=$_POST['association'];}

if (array_key_exists('detail',$_POST) && !empty($_POST['idevent'])){
	$_SESSION['event']=$_POST['idevent'];
	header('Location: ../event.php');	
	exit();
} else {
	header('Location: ../president.php');
	exit();
}
?>
