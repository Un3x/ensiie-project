<?php include ('view.php'); 
require '../vendor/autoload.php';
//require '../src/User/UserRepository.php';
//require '../src/User/User.php';

//récuperation de la session
session_start();

//postgres connexion
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$userRepository = new \User\UserRepository($connection);
$user = new \User\User();

//si on a un nouvel utilisateur
if (isset($_POST['firstname'])) {
	echo "LE SIGNUP MARCHE ";
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

	//ajout de l'utilisateur User à la base
	echo $user->getMail();
	$userRepository->addUser($user);
	$_SESSION['mail'] = $user->getMail();
	echo $user->getPassword();
}

else if (isset($_POST['login'])) {
	$user = $userRepository->fetchOneByMail($_POST['login']);
	if ($user == null) {
		echo '<script>alert("Utilisateur non trouvé")</script>';
		//header('Location: connexion.php');
		exit();
	}
	if ($_POST['password'] !== $user->getPassword()) {
		//echo '<script>alert("Erreur d\'authentification")</script>';
		header('Location: connexion.php');
		//exit();
	}
	else {
		$_SESSION['mail'] = $user->getMail();
	}
}

else if (isset($_SESSION['mail'])) {
	$user = $userRepository->fetchOneByMail($_SESSION['mail']);
}

if(!isset($_SESSION['mail'])) {
	header('location:connexion.php');
	exit();
}

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
					<?php echo ($user->getYop());?> années d'expérience
				</div>
				<div class="infocomptes">
					<?php echo ($user->getMail());?>
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
		<?php footer();?>
	</footer>
	</body>
</html>
