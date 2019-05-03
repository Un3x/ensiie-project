<?php include ('view.php');
require '../vendor/autoload.php';

//postgres connexion
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 session_start();
 if (!isset($_SESSION['mail'])) {
	 header('location:connexion.php');
	 exit();
 }
?>

<html>
	<head>
		<meta charset="utf-8">
		<?php my_head(); ?>
	</head>

	<body>
		<?php header_login(); ?>
		<div class="article-container">
			<div class="article">
				<h2>Vos Spots suivis</h2>
				<p>liste des spots suivis</p>
				<!--TODO une autocomplétion stylée-->
				<h3>Suivez un nouveau spot :</h3>
				<form action="follows.php" method="post">
 					<input type="text" required="true" name="spot" placeholder="spot">
					 <button class="bouton" type="submit" style="margin-top:8px">envoyer</button>
				</form>				
			</div>
			<div class="article">
				<h2>Vos Amis suivis</h2>
				<p>blablablablablab</p>
				<h3>Suivez un nouvel utilisateur :</h3>
				<form action="follows.php" method="post">
 					<input type="text" required="true" name="ami" placeholder="utilisateur">
					 <button class="bouton" type="submit" style="margin-top:8px">envoyer</button>
				</form>
			</div>
		</div>
	<footer>
		<?php footer();?>
	</footer>
	</body>
</html>
