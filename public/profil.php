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


  
  //Gros machin copié depuis authentification.php
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
          if(!empty($_POST['OldPW'])&&!empty($_POST['NewPW'])&&!empty($_POST['NewPW2']))
              { if($_POST['OldPW'] !== $user->getPassword())
                      {
                          $errorMessage='Mauvais mot de passe!'
                      }
                  elseif($_POST['NewPW'] !== $_POST['NewPW2'])
                      {
                          $errorMessage='Nouveaux mots de passe differents'
                      }
                  else
                      {
                          $connection->query('UPDATE users SET password= $_POST['NewPW'] WHERE id=$user->getId()')
                      }
              }
      }
}
displayHeader();
?>
<header class="header de page">
    
    <h1 id = "PagePerso"> <label> Infos personnelles: </label> </h1></header>
    <p>
    <table id="Resume">
    <caption> Infos personnelles</caption>
    <tr> <td> Nom</td> <td> <?php echo $user->getLastname() ?></td> </tr>
    <tr> <td> Prénom</td> <td> <?php echo $user->getFirstname() ?></td> </tr>
    <tr> <td> Pseudo</td> <td> <?php echo $user->getPseudo() ?></td> </tr>
    <tr> <td> Assos</td> <td> <?php echo $user->getAssos() ?></td> </tr>
    <tr> <td> Année</td> <td> <?php echo $user->getAnnee() ?></td> </tr>
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
          <label for="AncienPW">Mot de passe:</label> 
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
    </p>
</body>
</html>

