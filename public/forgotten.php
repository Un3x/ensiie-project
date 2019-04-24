<?php
require '../vendor/autoload.php';
include('./admin/functions.php');
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
$errorMessage = '';


if (!empty($_POST['login'])&&!empty($_POST['mail']))
{
	if (!array_key_exists($_POST['login'],$users))
	{
		$errorMessage = 'Mauvais login !';
	}
	else if ($users[$_POST['login']]->getMail() != $_POST['mail']){
		$errorMessage = 'Mauvais mail !';
	}
	else 
	{
		$code = "";
		for ($i=0 ; $i<10 ; $i++){
			$code .= mt_rand(0,9);
		}
		//fonction qui envoie le code par email
		session_start();
		$_SESSION['recup']=$code;
		$_SESSION['email']=$_POST['mail'];
		header('Location: recup.php');
		exit();
	}
}
displayHeader();
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
  <fieldset>
	<legend>Récupération de mot de passe</legend>
<?php
// Rencontre-t-on une erreur ?
if(!empty($errorMessage)) 
{
	echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
}
?>
	   <p>
		  <label for="login">Login :</label> 
		  <input type="text" name="login" id="login" value="" />
		</p>
		<p>
		  <label for="mail">email :</label> 
		  <input type="text" name="mail" id="mail" value="" /> 
		  <input type="submit" name="submit" value="Réinitialiser le mdp"/>
		</p>
	  </fieldset>
	</form>


</body>
</html>
