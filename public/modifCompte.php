<?php include ('view.php');
require '../vendor/autoload.php';

//postgres connexion
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$userRepository = new \User\UserRepository($connection);
$user = new \User\User();

 session_start();
 if (!isset($_SESSION['mail'])) {
	 header('location:connexion.php');
	 exit();
 }

 $user = $userRepository->fetchOneByMail($_SESSION['mail']);
?>

<html>
	<head>
		<meta charset="utf-8">
		<?php my_head(); ?>
	</head>

	<body>
		<?php header_login(); ?>
		<div class="flex-container" id="compte-content">
 			<div>
 			<em>Modifiez votre compte :</em>
 			<form action="compte.php" method="post">
				<input type="hidden" name="modif" value="true">
				</br>Prénom</br> 
				<input type="text" required="true" name="firstname" value=<?php echo $user->getFirstname(); ?>></br>
				Nom</br>
				<input type="text" required="true" name="lastname" value=<?php echo $user->getLastname(); ?>></br>
				Mail</br>
				<input type="email" required="true" name="mail" value=<?php echo $user->getMail(); ?>></br>
				Mot de passe</br>
				<input type="password" required="true" name="password" value=<?php echo $user->getPassword(); ?>></br>
				Date de naissance</br>
				<input type="date" name="birthday"></br>
				Ville</br>
				<input type="text" name="city" value=<?php echo $user->getCity(); ?>></br>
				Années d'expérience</br>
				<input type="number" min="0" name="yop" value=<?php echo $user->getYop(); ?>></br>
				Téléphone</br>
				<input type="tel" name="phone" pattern="[0-9]{10}" value=<?php echo $user->getPhone(); ?>></br>
				<button class="bouton" type="submit" style="margin-top:8px">envoyer</button>
			 </form>
			 <button class="bouton">
			 	<a href="supprCompte.php">supprimer mon compte</a>
			 </button>
			 </div>
		</div>
	<footer>
		<?php footer();?>
	</footer>
	</body>
</html>
