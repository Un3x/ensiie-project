<?php
require '../vendor/autoload.php';

include "utils.php";

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$reviewRepository = new \Review\ReviewRepository($connection);



//si l'utilisateur n'a pas été redirigé par le formulaire de bibliothèque, on le redirige vers l'index
if (!isset($_POST['id_livre'])) {
	header("Location: index.php");
}

//si le livre dont on veux voir les review est connu, on récupère la liste des review de ce livre
$reviews = $reviewRepository->fetchByLivre($_POST['id_livre']);

?>

<html>
<head>
	<meta charset="utf-8">
	<title>Review</title>
	<link rel="stylesheet" href=".css">
</head>
<body>
	<div class="container">
		<h2>Liste des review pour le livre :<?php echo IdToTitre($_POST['id_livre']); ?></h2>
		<?php if ($reviews == []): ?>
			<p>Désolé, aucune review n'est disponible pour ce livre</p>
		<?php endif; ?>
		<?php if ($reviews != []): ?>
		<table>
			<thead>
				<td>Livre</td>
				<td>Utilisateur</td>
				<td>Note</td>
				<td>Review</td>
			</thead>
			<?php foreach ($reviews as $review): ?>
				<tr>
					<td><?php echo IdToTitre($_POST['id_livre']); ?></td>
					<td><?php echo IdToPseudo($review->getPersonne()); ?></td>
					<td><?php echo $review->getNote(); ?></td>
					<td><?php echo $review->getTexte(); ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>
	</div>
</body>
