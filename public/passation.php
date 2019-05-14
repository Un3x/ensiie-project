<?php
include('./admin/functions.php');
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']) || empty($_SESSION['president'] || empty($_SESSION['userpassation']))) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: authentification.php');
  exit();
}

  //Gros machin copié depuis authentification.php
require '../vendor/autoload.php';
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
$user = $users[$_SESSION['login']];
$userpassation = $connection->query('select pseudo from users where id_user='.$_SESSION['userpassation'])->fetch(\PDO::FETCH_OBJ);
if (!empty($_POST['cancel'])){
	header('Location: president.php');
}
elseif (!empty($_POST['passation'])){
	$connection->query("update associations set president=".$_SESSION['userpassation']." where id_asso=".$_SESSION['association']);
	if ($connection->query("select count(id_asso) as c from associations where president=".$user->getId())->fetch(\PDO::FETCH_OBJ)->c == 0){
		$connection->query("update users set president=0 where id_user=".$user->getId());
	}	
	$connection->query("update users set president=1 where id_user=".$_SESSION['userpassation']);
	header('Location: deauth.php');
}
displayHeader();
?>


<form method="post" action="passation.php">
<fieldset>
	<legend>Confirmer la passation de présidence à <?php echo $userpassation->pseudo; ?> </legend>
	<input type="submit" name="cancel" value="Annuler"/>
	<input type="submit" name="passation" value="Confirmer" />
</fieldset>
</form>
</body>
</html>



