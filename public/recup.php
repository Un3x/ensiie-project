<?php
require '../vendor/autoload.php';
include('./admin/functions.php');

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
// On prolonge la session
session_start();
 
if(empty($_SESSION['recup']) || empty($_SESSION['email'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: forgotten.php');
  exit();
}
displayHeader();
$iduser = $connection->query("select id_user from users where mail= '".$_SESSION['email']."'")->fetch(\PDO::FETCH_OBJ);
$errorMessage='';


function print_code_form($errorMessage)
{?>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	  <fieldset>
	<legend>Récupération de mot de passe pour <?= $_SESSION['email']?></legend>
	<?php
	// Rencontre-t-on une erreur ?
	if(!empty($errorMessage)) 
	{
		echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
	}
	?>
	   <p>
		  <label for="code">CODE :</label> 
		  <input type="text" name="code" id="code" value="" />
		</p>
		<p>
		  <input type="submit" name="submit" value="Réinitialiser le mdp" />
		</p>
	  </fieldset>
	</form>

<?php }

function print_chgmdp_form($errorMessage)
{ ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <fieldset>
        <legend>Modifier son mot de passe</legend>
        <?php
          // Rencontre-t-on une erreur ?
          if(!empty($errorMessage)) 
          {
            echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
          }
        ?>
       <p>
          <label for="AncienPW">Mot de passe actuel :</label> 
          <input type="password" name="OldPW" id="password" value="" />
        </p>
        <p>
          <label for="password">Nouveau mot de passe:</label> 
          <input type="password" name="NewPW" id="NewPW" value="" /> 
          <label for="password">Confirmer:</label>
          <input type="password" name="NewPW2" id="NewPW2" value="" /> 
          <input type="submit" name="submit" value="Appliquer" />
        </p>
      </fieldset>
</form>

<?php }

if (empty($_SESSION['essais'])){
	$_SESSION['essais']=0;
} 
if (!empty($_POST['code']))
{
	if ($_POST['code'] != $_SESSION['recup'])
	{
		if ($_SESSION['essais'] >= 3) {
			$errorMessage='Vous avez essayé trop de fois veuillez renvoyer le code';	
			echo $errorMessage;
			$_SESSION = array();
			session_destroy();
			unset($_SESSION);
		} 
		else {
			$errorMessage = 'Mauvais code !';
			$_SESSION['essais']+=1;
			print_code_form($errorMessage);
		}
	}
	else print_chgmdp_form($errorMessage); 
} else print_code_form($errorMessage);


if(!empty($_POST['OldPW'])&&!empty($_POST['NewPW'])&&!empty($_POST['NewPW2']))
{ if(!password_verify($_POST['OldPW'],$users[$_SESSION['login']]->getPassword()))
{
	$errorMessage='Mauvais mot de passe!';
}
elseif($_POST['NewPW'] !== $_POST['NewPW2'])
{
	$errorMessage='Nouveaux mots de passe differents';
}
else
{
	$connection->query("UPDATE users SET password='".password_hash($_POST["NewPW"],PASSWORD_BCRYPT)."' WHERE id_user=".$user->getId());
	$errorMessage='Le mot de passe a été changé !';
}
}

?>

</body>
</html>
