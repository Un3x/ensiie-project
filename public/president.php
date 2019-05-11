<?php
include('./admin/functions.php');
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']) || empty($_SESSION['president'])) 
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

$assos_pres = $connection->query('select * from associations where president='.$user->getId())->fetchAll(\PDO::FETCH_OBJ);
displayHeader();

//un président doit pouvoir:
// - choisir quelle asso modifier
// - transmettre le role de président
// - rajouter,modifier, enlever un évènement
// - consulter, modifier, rajouter, enlever la participation d'un élève a un évènement
// - 
?>

<header class="header de page">
    
    <h1 id = "PagePresident"> <label> Gestion Présidence : </label> </h1></header>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" style="border:solid grey 1px;">
<fieldset>
  <label for="association">Gérer l'association : </label>
	<select id="association" name="association">
	<?php foreach ($assos_pres as $asso):?>
	<option value="<?php echo $asso->id_asso ?>"><?php echo $asso->name ?></option>
	<?php endforeach; ?>
	</select>
	<input type="submit" name="submit" value="Gérer"/>
</fieldset>
</form>

<?php if (!empty($_POST['association'])):?>
c'pas vide !
<?php endif; ?>

</body>
</html>
