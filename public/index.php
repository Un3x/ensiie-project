<?php
require '../vendor/autoload.php';
require '../src/User/UserRepository.php';
require '../src/User/User.php';
require_once('../src/Move/MoveRepository.php');
require_once('../src/Move/Move.php');
require_once('../src/Spot/SpotRepository.php');
require_once('../src/Spot/Spot.php');
require_once('../src/SpotXmove/SpotXmoveRepository.php');
require_once('../src/SpotXmove/SpotXmove.php');

include ('view.php');

//démarre une session pour garder l'utilisateur connecté entre les pages
session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
$moveRepository = new \Move\MoveRepository($connection);
$moves = $moveRepository->fetchAll();
$spotRepository = new \Spot\SpotRepository($connection);
$spots = $spotRepository->fetchAll();

?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
    <?php my_head(); ?>

</head>
<body>

    <?php header_login(); ?>

<div class="container">

	<div id="search">
		<form action="map.php">
		<span style="font-size:140%">Trouve le spot le plus près de chez toi :</br></span>
		<input id="searchbar" type="text" name="ville" placeholder="Entrez votre ville">
		</form>
	</div>


	<?php if (!isset($_SESSION['mail'])) articles(); 
			else followed($_SESSION['mail']);?>

    <h3><?php echo 'Hello world from Docker! php' . PHP_VERSION; ?></h3>
    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>#</td>
            <td>Firstname</td>
            <td>Lastname</td>
			<td>Age</td>
			<td>passws</td>
			<td>mail</td>
        </thead>
      <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getId() ?></td>
                <td><?php echo $user->getFirstname() ?></td>
                <td><?php echo $user->getLastname() ?></td>
				<td><?php echo $user->getAge() ?> years</td>
				<td><?php echo $user->getPassword() ?></td>
				<td><?php echo $user->getMail()  ?></td>
            </tr>
      <?php endforeach; ?>

    </table>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>#</td>
            <td>nom</td>
            <td>difficulte</td>
        </thead>
      <?php /** @var \Move\Move $move */
        foreach ($moves as $move) : ?>
            <tr>
                <td><?php echo $move->getId() ?></td>
                <td><?php echo $move->getNom() ?></td>
                <td><?php echo $move->getDifficulte() ?></td>
            </tr>
      <?php endforeach; ?>

    </table>

    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>#</td>
            <td>nom</td>
            <td>latitude</td>
            <td>longitude</td>
            <td>note</td>
            <td>ville</td>
        </thead>
      <?php /** @var \Spot\Spot $spot */
        foreach ($spots as $spot) : ?>
            <tr>
                <td><?php echo $spot->getId() ?></td>
                <td><?php echo $spot->getNom() ?></td>
                <td><?php echo $spot->getlatitude() ?></td>
                <td><?php echo $spot->getLongitude() ?></td>
                <td><?php echo $spot->getNote() ?></td>
                <td><?php echo $spot->getVille() ?></td>
            </tr>
      <?php endforeach; ?>

    </table>

</div>
<footer>
<?php footer();?>
</footer>
</body>
</html>
