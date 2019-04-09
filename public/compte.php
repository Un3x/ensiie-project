<?php include ('view.php'); 
require '../vendor/autoload.php';
//require '../src/User/UserRepository.php';
//require '../src/User/User.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
?>

<html>
	<head>
		<meta charset="utf-8">
		<?php my_head(); ?>
	</head>

	<body>
		<?php header_login(); ?>

		<div class="flex-container" id="compte-content">
			<div id="photo">
				<!-- Photo de profil -->
				photo
			</div>
			<div class="flex-container" id="info-content">
				<!-- informations sur le compte -->
				<div class="infocomptes">
					PRENOM
				</div>
				<div class="infocomptes">
					NOM
				</div>
				<div class="infocomptes">
					ANNEES D'EXPERIENCE
				</div>
				<div class="infocomptes">
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
		</div>

	<footer>
		<?php include ('footer.php'); footer();?>
	</footer>
	</body>
</html>
