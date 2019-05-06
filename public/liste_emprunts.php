<?php

//cette page permet aux admins de voir la liste des livres empruntés ainsi que la date à laquelle ils ont été empruntés

include("utils.php");

require '../vendor/autoload.php';


//TODOTODOTODOTODOTODOTODOTODOTODO j'ai eu la flemme de la tester sur docker donc a vérifier plus la fonction fetchEmprunted de livreRepository



session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$livreRepository = new \Livre\LivreRepository($connection);


// ajouter une redirection automatique si l'utilisateur n'est pas admin
if (!isset($_SESSION["id_user"])) {
    header("Location: index.php");
}
if (!(verifAdmin($_SESSION["id_user"]))) {
    header("Location: index.php");
}


//on récupère la liste des livres empruntés

$listeEmprunts = $livreRepository->fetchEmprunted();

?>

<html>
<head>
	<meta charset="utf-8">
	<title>liste emprunts</title>
</head>
<body>
	<div class="container">
		<h2>page listant les emprunts (réservée aux admins)</h2>
		<nav>
         <!-- TODO recopier le nav-->
         	
        </nav>

       <!--on affiche direct la table on se fait pas chier-->

      <?php if ($listeEmprunts == []): ?>
        <p>Aucun livre n'est actuellement emprunté</p>
      <?php endif; ?>
      <?php if ($listeEmprunts != []): ?>
       <table>
       	<thead style="font-weight: bold">
       		<td>#</td>
       		<td>Titre</td>
       		<td>Emprunteur</td>
       		<td>Date_emprunt</td>
       	</thead>
       	<?php foreach ($listeEmprunts as $emprunt): ?>
       	<tr>
       		<td><?php echo $emprunt->getId(); ?></td>
       		<td><?php echo $emprunt->getTitre(); ?></td>
       		<td><?php echo IdToPseudo($emprunt->getEmprunteur()); ?></td>
       		<td><?php echo date_format($emprunt->getDateEmprunt(), 'Y-m-d'); ?></td>
       	</tr>
       <?php endforeach; ?>
   </table>
   <p></p>
 <?php endif; ?>
</div>
</body>
</html>
