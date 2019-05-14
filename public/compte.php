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
$currentuser = new \User\User();

//si on a un nouvel utilisateur ou une modification
if (isset($_POST['signup']) || isset($_POST['modif'])) {
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
	if (isset($_POST['signup'])) {
		$userRepository->addUser($user);
		$_SESSION['mail'] = $user->getMail();
		$currentuser = $user;
	}
	//modification de l'utilisateur
	else {
		$userRepository->modifUser($_SESSION['mail'],$user);
		$_SESSION['mail'] = $user->getMail();
		$currentuser = $user;
	}
	
}

//si un utilisateur se connecte
else if (isset($_POST['login'])) {
	$currentuser = $userRepository->fetchOneByMail($_POST['login']);
	if ($currentuser == null) {
		echo '<script>alert("Utilisateur non trouvé")</script>';
		//header('Location: connexion.php');
		exit();
	}
	if ($_POST['password'] !== $currentuser->getPassword()) {
		//echo '<script>alert("Erreur d\'authentification")</script>';
		header('Location: connexion.php');
		//exit();
	}
	else {
		$_SESSION['mail'] = $currentuser->getMail();
	}
}

else if (isset($_SESSION['mail'])) {
	$currentuser = $userRepository->fetchOneByMail($_SESSION['mail']);
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
				<div>
					<em>Prénom :</em>
					<div class="infocomptes">
						<?php echo ($currentuser->getFirstname()); ?>
					</div>
				</div>
				<div>
					<em>Nom :</em>
					<div class="infocomptes">
						<?php echo ($currentuser->getLastname()); ?>
					</div>
				</div>
				<div>
					<em>Ville :</em>
					<div class="infocomptes">
						<?php echo ($currentuser->getCity());?>
					</div>
				</div>
				<div>
					<em>Expérience :</em>
					<div class="infocomptes">
						<?php echo ($currentuser->getYop());?> année(s) d'expérience
					</div>
				</div>
				<div>
					<em>Mail :</em>
					<div class="infocomptes">
						<?php echo ($currentuser->getMail());?>
					</div>
				</div>
				<div>
					<em>Téléphone :</em>
					<div class="infocomptes">
						<?php echo ($currentuser->getPhone());?>
					</div>
				</div>
				<button class="bouton"> 
					<a href="modifCompte.php">Gestion de compte</a>
				</button>
			</div>
		</div>

	<footer>
		<?php footer();?>
	</footer>
	</body>
</html>
