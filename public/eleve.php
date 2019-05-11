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


$points = $connection->query('SELECT name,moyenne from (pointsassos_prop join associations using (id_asso)) where id_user='.$iduser)->fetchAll(\PDO::FETCH_OBJ);
$events = $connection->query('select e.name name_event,a.name name_asso,notation from ((select name,notation,id_asso,id_user from score join events using (id_event)) e join associations a using (id_asso)) where id_user='.$iduser)->fetchAll(\PDO::FETCH_OBJ);
$moyenne = $connection->query('select moyenne from leaderboard where id_user='.$iduser)->fetch(\PDO::FETCH_OBJ);
$participations = $connection->query('SELECT score.id_event score_id_ev, notation FROM score NATURAL JOIN events WHERE id_user = '.$iduser)->fetchAll(\PDO::FETCH_OBJ);
displayHeader();
?>
<table class="table table-bordered table-hover table-striped">
	<caption>Récapitulatif des points association</caption>
	<tr>
		<th>Association</th>
		<th>Points</th>
	</tr>

<?php
foreach ($points as $point) : ?>
	<tr>
	<td><?php echo $point->name ?></td>
	<td><?php echo $point->moyenne ?></td>
	</tr>
<?php endforeach;

if ($moyenne):?>
	<tr id="moyenne">
		<td> Moyenne </td>
		<td> <?php echo $moyenne->moyenne ?> </td>
	</tr>
<?php endif;?>
</table>

<table class="table table-bordered table-hover table-striped">
	<caption>Récapitulatif des évènements</caption>
	<tr>
		<th>Evenement</th>
		<th>Association</th>
		<th>Points</th>
	</tr>
<?php foreach ($events as $event) : ?>
	<tr>
		<td><?php echo $event->name_event ?></td>
		<td><?php echo $event->name_asso ?></td>
		<td><?php echo $event->notation ?></td>
	</tr>
<?php endforeach; ?>
</table>


</body>
</html>

