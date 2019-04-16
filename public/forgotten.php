
<?php
require '../vendor/autoload.php';
include('./admin/functions.php');
// On prolonge la session
session_start();

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
$errorMessage = '';
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
		  <input type="submit" name="submit" value="Réinitialiser le mdp" />
		</p>
	  </fieldset>
	</form>


</body>
</html>
