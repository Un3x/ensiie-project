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
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
        <img src="./titre.png"/>
    </header>
    <nav>
        <a href="test.html" class="rubrique">Accueil    </a>
        <a href="bibliotheque.php" class="rubrique">|   Bilbiothèque    </a>
        <?php if ($user_connected): ?>
            <a href="espace_perso.php" class="rubrique">|   Espace perso    </a>
            <a href="review.php" class="rubrique">|   Review    </a>
            <a href="editer.php" class="rubrique">|   Editer   </a>
            <?php endif; ?>
        <?php if ($user_connected && $admin): ?>
            <a href="ajout_livre.php" class="rubrique">|   Ajout livre   </a>
            <a href="rendu.php" class="rubrique">|   Retour   </a>
            <a href="emprunt.php" class="rubrique">|   Emprunt   </a>
        <?php endif; ?>
    </nav>
	<?php if (!($user_connected)) {
		echo "<p>Vous devez êtres connecté pour effectuer une réservation</p>";
	}
	?>
  <section>
	<div class="grand-titre">Bibliothèque</div>
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
    <p>Vous pouvez parcourir notre bilbiothèque</p>
    <div class="contenu">
    	<table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
      <td>Couverture</td>
    <td>titre</td>
    <td>publication</td>
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
    <td><img src=<?php echo $livre->getImage() ?>/></td>
    <td><?php echo $livre->getTitre() ?></td>
    <td><?php echo date_format ($livre->getPublication(), 'Y-m-d') ?></td>
    <td><?php echo $livre->getEdition() ?></td>
    <td>
    	<table>
    	<?php
    	$auteurs = $auteurRepository->fetchByLivre($livre->getId());
    	foreach ($auteurs as $auteur) : ?>
    		<tr><td><?php echo $auteur->getAuteur(); ?></td></tr>
    	<?php endforeach; ?>
    </table></td>
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
  </section>
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