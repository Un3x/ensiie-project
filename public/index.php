<?php
require '../vendor/autoload.php';
//require '../src/User/UserRepository.php';
//require '../src/User/User.php';
include ('view.php');

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
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
		<input type="text" name="ville" placeholder="Entrez votre ville">
		</form>
	</div>

	<div class="article-container">
		<div class="article">
			<h3>Titre de l'article n°1</h3>
			<p>
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
			</p>
		</div>
		<div class="article">
			<h3>Titre de l'article n°2</h3>
			<p>
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
			</p>
		</div>
	</div>
    <h3><?php echo 'Hello world from Docker! php' . PHP_VERSION; ?></h3>
    <table class="table table-bordered table-hover table-striped">
        <thead style="font-weight: bold">
            <td>#</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Age</td>
        </thead>
      <?php /** @var \User\User $user */
        foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user->getId() ?></td>
                <td><?php echo $user->getFirstname() ?></td>
                <td><?php echo $user->getLastname() ?></td>
                <td><?php echo $user->getAge() ?> years</td>
            </tr>
      <?php endforeach; ?>

    </table>
</div>
<footer>
<?php include ('footer.php'); footer();?>
</footer>
</body>
</html>
