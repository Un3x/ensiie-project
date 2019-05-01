<?php
require '../vendor/autoload.php';

include "utils.php";

session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$livreRepository = new \Livre\LivreRepository($connection);
$auteurRepository = new \Auteur\AuteurRepository($connection);


$user_connected=isset($_SESSION["id_user"]);

if ($user_connected) {//on récupère les info sur l'utilisateur courrant (si il est identifié)
    $id_user=$_SESSION["id_user"];
}

//si une recherche a été lancée précédemment, on génère la liste des livres à afficher en conséquence
if (isset($_POST['titre'])) {
	$livres=$livreRepository->fetchRechercheTitre($_POST['titre']);//TODOfonction qui cherche un fonction du titre
}
else {
	$livres=$livreRepository->fetchAll();
}

?>
<html>
<head>
	<meta charset="utf-8">
    <title>Bilbiothèque</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
	<?php if (!($user_connected)) {
		echo "<p>Vous devez êtres connecté pour effectuer une réservation</p>";
	}
	?>
	<h2>Bilbiothèque</h2>
	<div class="champ recherche">
		<h4>Rechercher un livre par titre</h4>
		<form action="bibliotheque.php" method="POST">
			Titre :<br>
			<input id="ftitre" type="text" name="titre"><br>
			<input type="button" class="input" onclick="valide_ftitre()" value="Valider">
			<input id="validerftitre" style="display:none" type="submit" name="Valider">
		</form>
		<p id="ftitreerror" style="display:none">Veuillez remplir le champ</p>
	</div>
	<nav>
       <!-- ALED TODO recopier le nav-->
    </nav>
    <p>Vous pouvez parcourir notre bilbiothèque</p>
    <div class="contenu">
    	<table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <td>titre</td>
    <td>publication</td>
    <td>couverture</td>
    <td>editeur</td>
    <td>auteurs</td>
    <td>emprunteur</td>
    <td>date emprunt</td>
    <td>review</td>
    <?php if ($user_connected) {
    	echo "<td>reserver";
    }
    ?>
    </thead>
<?php
    foreach ($livres as $livre) : ?>
    <tr><?php $ID=$livre->getId(); ?>
    <td><?php echo $livre->getTitre() ?></td>
    <td><?php echo date_format ($livre->getPublication(), 'Y-m-d') ?></td>
    <td><?php echo $livre->getImage() ?></td>
    <td><?php echo $livre->getEdition() ?></td>
    <td><div  style="display:none" id=<?php echo "$ID"; ?>>
    	<table>
    	<?php
    	$auteurs = $auteurRepository->fetchByLivre($livre->getId());
    	foreach ($auteurs as $auteur) : ?>
    		<tr><?php echo $auteur->getAuteur(); ?></tr>
    	<?php endforeach; ?>
    </table></div><input type="button" onclick="aff_auteurs(<?php echo "$ID";?>)" value="Afficher les auteurs" id=<?php echo "$ID"."butt";?>></td>
    <td><?php echo $livre->getEmprunteur() ?></td>
    <td><?php echo date_format($livre->getDateEmprunt(), 'Y-m-d') ?></td>
    <td><form action="voir_review.php" method="POST"><input style="display:none" type="text" name="id_livre" value=<?php echo $livre->getId(); ?>><input type="submit" name="Voir les reviews" value="Voir les reviews"></form></td>
    <?php if ($user_connected) : ?>
    	<td><form action="reservation.php" method="POST"><input style="display:none" type="text" name="id_livre" value=<?php echo $livre->getId(); ?>><input style="display:none" type="text" name="id_user" value=<?php echo $id_user; ?>><input type="submit" name="Réserver" value="Réserver"></form></td>
    <?php endif; ?>
    </tr>
<?php endforeach; ?>
    </table>
    </div>
   </body>

   <script>
   	function valide_ftitre() {
   		tmptitre=document.getElementById("ftitre").value;
   		if (tmptitre=='') {
   			document.getElementById("ftitreerror").style.display="block";
   		}
   		else {
   			document.getElementById("validerftitre").click();
   		}
   	}

   	function aff_auteurs(id) {
   		document.getElementById(id.toString()).style.display="block";
   		document.getElementById(id.toString()+"butt").style.display="none";
   	}

   </script>
</html>