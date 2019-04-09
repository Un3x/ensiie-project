<?php include ('view.php'); 
require '../vendor/autoload.php';
//require '../src/User/UserRepository.php';
//require '../src/User/User.php';

//postgres connexion
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$user = new \User\User();

// génération des attributs de l'objet User
$user->setFirstname($_POST['firstname']);
$user->setLastname($_POST['lastname']);
$user->setPassword($_POST['password']);
$user->setMail($_POST['mail']);
if (isset($_POST['birthday'])) {
	$date = date_create($_POST['birthday']);
	$user->setBirthday($date);
}
if (isset($_POST['city']))
	$user->setCity($_POST['city']);
if (isset($_POST['yop']))
	$user->setYop($_POST['yop']);
if (isset($_POST['phone']))
	$user->setPhone($_POST['phone']);
if (isset($_POST['current_training']))
	$user->setCurrent_training($_POST['current_training']);

//ajout del'utilisateur User à la base
$userRepository->addUser($user);
$users = $userRepository->fetchAll();

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
					<?php echo ($user->getFirstname()); ?>
				</div>
				<div class="infocomptes">
					<?php echo ($user->getLastname()); ?>
				</div>
				<div class="infocomptes">
					<?php echo ($user->getYop());?>ANNEES D'EXPERIENCE
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

		<?php /** @var \User\User $userr */
        foreach ($users as $userr) : ?>
            <tr>
                <td><?php echo $userr->getId() ?></td>
                <td><?php echo $userr->getFirstname() ?></td>
                <td><?php echo $userr->getLastname() ?></td>
                <td><?php echo $userr->getAge() ?> years</td>
            </tr>
      <?php endforeach; ?>

	<footer>
		<?php include ('footer.php'); footer();?>
	</footer>
	</body>
</html>
