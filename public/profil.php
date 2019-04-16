<?php


include('./admin/functions.php');
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: http://localhost:8080/authentification.php');
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
// Definition des constantes et variables
$errorMessage = '';
$errorMessageMail = ''; 



  
  // Test de l'envoi du formulaire
  if(!empty($_POST))
      {
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
		  if(!empty($_POST['NewMail'])&&!empty($_POST['NewMail2']))
		  {
			if (!empty($_POST['OldMail'])){
		  	if ($_POST['OldMail'] != $user->getMail())
			{
				$errorMessageMail = 'Mauvais mail !';
			} 
			else if ($_POST['NewMail'] != $_POST['NewMail2']) 
			{
				$errorMessageMail='Nouveaux mails différents !';
			}
			else {
				$connection->query("update users set mail='".$_POST['NewMail']."' where id_user=".$user->getId());
				$errorMessageMail = 'Le mail de récupération a été changé !';
			}
			} else {
				if ($_POST['NewMail'] != $_POST['NewMail2']) 
				{
					$errorMessageMail='Nouveaux mails différents !';
				}
				else {
					$connection->query("update users set mail='".$_POST['NewMail']."' where id_user=".$user->getId());
					$errorMessageMail = 'Le mail de récupération a été changé !';
				}
	
			}
		  }
      }

displayHeader();
?>
<header class="header de page">
    
    <h1 id = "PagePerso"> <label> Infos personnelles: </label> </h1></header>
    <p>
    <table id="Resume" class="table table-bordered table-hover table-striped">
    <caption> Infos personnelles</caption>
    <tr> <td> Nom</td> <td> <?php echo $user->getLastname() ?></td> </tr>
    <tr> <td> Prénom</td> <td> <?php echo $user->getFirstname() ?></td> </tr>
    <tr> <td> Pseudo</td> <td> <?php echo $user->getPseudo() ?></td> </tr>
<?php
/*<tr> <td> Assos</td> <td> <?php echo $user->getAssos() ?></td> </tr>*/
?>
    <tr> <td> Année</td> <td> <?php echo $user->getAnnee() ?>A</td> </tr>
    </table>
    </p>

    <p>
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
	  <fieldset>
	  <legend>Modifier son email de récupération </legend>
		<?php
			if (!empty($errorMessageMail))
			{
				echo '<p>', htmlspecialchars($errorMessageMail), '</p>';
			}
			if ($user->getMail() != "null"):
?>
		<p>
			<label for="OldMail"> Email actuel :</label>
			<input type="text" name="OldMail" id="OldMail" value=""/>   
		</P>
<?php else:?>
	<p class="pasDeMail">Fortement recommandé car vous n'avez actuellement pas de mail de récupération de mot de passe</p>			

<?php endif;?>
		<label for="mail">Nouveau mail :</label>
		<input type="text" name="NewMail" id="NewMail" value=""/>
		<label for="mail">Confirmer :</label>
		<input type="text" name="NewMail2" id="NewMail" value=""/>
		<input type="submit" name="submit" value="Appliquer"/>
      </fieldset>
    </form>

    </p>
</body>
</html>

