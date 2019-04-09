<?php
require '../vendor/autoload.php';
include('./admin/functions.php');
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if (empty($_SESSION['login'])) {
	// Si inexistante ou nulle, on redirige vers le formulaire de login
	header('Location: http://localhost:8080/authentification.php');
	exit();
}

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$iduser = $users[$_SESSION['login']]->getId();

$events = $connection->query('SELECT id_event, events.name ev_name, association.name assoc_name FROM events NATURAL JOIN association')->fetchAll(\PDO::FETCH_OBJ);

$points = $connection->query('SELECT name, notation FROM pointsassos NATURAL JOIN associations WHERE id_user = '.$iduser)->fetchAll(\PDO::FETCH_OBJ);

$participations = $connection->query('SELECT score.id_event score_id_ev, notation FROM score NATURAL JOIN events WHERE id_user = '.$iduser)->fetchAll(\PDO::FETCH_OBJ);
displayHeader();
?>

<table>
	<caption>Récapitulatif des points association</caption>
	<tr>
		<th>Association</th>
		<th>Points</th>
	</tr>

<?php
foreach ($points as $point) : ?>
	<tr>
	<td><?php echo $point->assoc_name ?></td>
	<td><?php echo $point->ev_name ?></td>
	</tr>
<?php endforeach;?>
</table>

<table>
	<caption>Récapitulatif des évènements</caption>
	<tr>
		<th>Association</th>
		<th>Points</th>
		<th>A participé</th>
	</tr>
<?php foreach ($events as $event) : ?>
	<tr>
		<td><?php echo $event->name ?></td>
		<td><?php if ($event->id_event == $participations->score_id_ev){ echo $event->notation; } else { echo "";} ?></td>
		<td><?php if ($event->id_event == $participations->score_id_ev){ echo "Oui"; } else { echo "Non";} ?></td>
	</tr>
<?php endforeach; ?>
</table>


</body>
</html>

