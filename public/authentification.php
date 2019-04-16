<?php
include('./admin/functions.php');
require '../vendor/autoload.php';
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
// Definition des constantes et variables
define('LOGIN','toto');
define('PASSWORD','tata');
$errorMessage = '';

// Test de l'envoi du formulaire
if(!empty($_POST)) 
{
	// Les identifiants sont transmis ?
	if(!empty($_POST['login']) && !empty($_POST['password'])) 
	{
		// Sont-ils les mêmes que les constantes ?
		if(!array_key_exists($_POST['login'],$users)) 
		{
			$errorMessage = 'Mauvais login !';
		}
		elseif(!password_verify($_POST['password'],$users[$_POST['login']]->getPassword())) 
		{  
			$errorMessage = 'Mauvais password !';
		}
		else
		{
			// On ouvre la session
			session_start();
			// On enregistre le login en session
			$_SESSION['login'] = $_POST['login'];
			if ($users[$_POST['login']]->getBde() == 1){
				//s'il est bde on l'enregistre
				$_SESSION['bde'] = 1;
			}
			if ($users[$_POST['login']]->getPresident() == 1) {
				//s'il est président d'une asso on l'enregistre aussi
				$_SESSION['president'] = 1;
			}
			// On redirige vers le fichier admin.php
			header('Location: eleve.php');
			exit();
		}
	}
	else
	{
		$errorMessage = 'Veuillez inscrire vos identifiants svp !';
	}
}
displayHeader();
?>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	  <fieldset>
		<legend>Identifiez-vous</legend>
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
		  <label for="password">Password :</label> 
		  <input type="password" name="password" id="password" value="" /> 
		  <input type="submit" name="submit" value="Se logguer" />
		</p>
	  </fieldset>
	</form>
	<a href="forgotten.php"> J'ai oublié mon mot de passe </a>
  </body>
</html>
