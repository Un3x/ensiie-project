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

session_start();

$user_connected=isset($_SESSION["id_user"]);

//si l'utilisateur n'a pas été redirigé par le formulaire de bibliothèque, on le redirige vers l'index
if (!isset($_POST['id_livre'])) {
	header("Location: index.php");
}

//si le livre dont on veux voir les review est connu, on récupère la liste des review de ce livre
$reviews = $reviewRepository->fetchByLivre($_POST['id_livre']);
$admin = false;

if ($user_connected) {//on récupère les info sur l'utilisateur courrant (si il est identifié)
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}

?>


<html>
<head>
	<meta charset="utf-8">
	<title>Review</title>
	<link rel="stylesheet" href="style.css">
</head>
<div class="top"> <!--ajout d'un haut de page si l'utilisateur est admin ou si il est connecté-->
        <?php
        if ($user_connected) {
            echo "<TABLE >
      <TR>
        <TD class=\"bande1\" align=\"left\" WIDTH=\"100%\">Vous êtes connecté en tant que $nom \"$pseudo\" $prenom</TD>
        <TD style=\"border:none; height:30px\" align=\"right\"><form action=\"deconnection.php\"><input class=\"bande2\" type=\"submit\" value=\"Deconnexion\"></form></TD>
      </TR>
    </TABLE>";

            //"<p style=\"white-space: no-wrap\">Vous êtes connecté en tant que $nom \"$pseudo\" $prenom<div style=\"white-space: no-wrap\">Deconection</div> </p>";

        }
        else {
            echo "<TABLE >
      <TR>
        <TD class=\"bande1\" align=\"left\" WIDTH=\"100%\"></TD>
        <TD style=\"border:none; height:30px\" align=\"right\"><form action=\"connexion.php\"><input class=\"bande2\" type=\"submit\" value=\"Connexion\"></form></TD>
      </TR>
    </TABLE>";
        }
        
        ?>
    </div>
<body>
	<header>
        <a href="index.php"><img src="./titre.png"/></a>
    </header>
    <nav>
    	<a href="bibliotheque.php" class="rubrique">Retour vers la bibliothèque</a>
    </nav>
	<section>
	<div class="container">
		<div class="grand-titre">Liste des review pour le livre : <?php echo IdToTitre($_POST['id_livre']); ?></div>
		<?php if ($reviews == []): ?>
			<p>Désolé, aucune review n'est disponible pour ce livre</p>
		<?php endif; ?>
		<?php if ($reviews != []): ?>
		<table>
			<thead>
				<th>Livre</th>
				<th>Utilisateur</th>
				<th>Note</th>
				<th>Review</th>
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
        <p></p>
	<?php endif; ?>
	</div>
</section>
</body>
