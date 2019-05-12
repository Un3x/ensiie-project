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
if (!empty($_POST['event_name']) && !empty($_POST['event_date']) && !empty($_POST['event_desc']) && !empty($_SESSION['association']) && !empty($_POST['coeff_event'])){
	$date = new DateTime($_POST['event_date']);
	$date= $date->format('Y-m-d');
	$connection->query("insert into events(name,id_asso,coeff_event,date_ev,description_event) values ('".$_POST['event_name']."',".$_SESSION['association'].",".$_POST['coeff_event'].",'".$date."','".$_POST['event_desc']."')");
}
?>

<header class="header de page">
    
    <h1 id = "PagePresident"> <label> Gestion Présidence : </label> </h1></header>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" style="border:solid grey 1px;">
<fieldset>
  <label for="association">Gérer l'association : </label>
	<select id="association" name="association">
	<?php foreach ($assos_pres as $asso):?>
	<option value="<?php echo $asso->id_asso ?>" <?php if (!empty($_POST['association'])): if ($asso->id_asso == $_POST['association']): echo 'selected="selected"'; endif; endif; ?> ><?php echo $asso->name ?></option>
	<?php endforeach; ?>
	</select>
	<input type="submit" name="submit" value="Gérer"/>
</fieldset>
</form>

<?php if (!empty($_POST['association'])):
$_SESSION['association']=$_POST['association'];
$events=$connection->query('select * from events where id_asso='.$_POST['association'])->fetchAll(\PDO::FETCH_OBJ);
?>


<div class="gestion" id="gestion_evenements">

	<table class="table table-bordered table-hover table-striped">
		<caption>Récapitulatif des évènements</caption>
		<tr>
			<th>Evenement</th>
			<th>Date</th>
			<th>Description</th>
			<th>Coeff</th>
		</tr>
		<?php foreach ($events as $event) : ?>
		<tr>
			<td><?php echo $event->name ?></td>
			<td><?php echo $event->date_ev ?></td>
			<td><?php echo $event->description_event ?></td>
			<td><?php echo $event->coeff_event ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
		<fieldset>
		<legend>Créer un évènement</legend>
		<p>
		<label for="event_name">Nom : </label>
		<input type="text" name="event_name" value=""/>
		</p>

		<p>
		<label for="event_date">Date : </label>
		<input type="date" name="event_date" value=""/>
		</p>

		<p>
		<label for="event_desc">Description : </label>
		<textarea class="desc" rows="5" cols="50" name="event_desc">Insérer la description</textarea>
		</p>
		<p>
		<label for="coeff_event">coefficient : </label>
		<input type="number" name="coeff_event" value="0" min="1" max="10"/>
		</p>
		<input type="submit" name="submit" value="Créer l'évènement"/>
		</fieldset>
	</form>
</div>

<div class="gestion" id="gestion_eleve">

</div>

<div class="gestion" id="gestion_transmission">

</div>

<?php endif; ?>

</body>
</html>
