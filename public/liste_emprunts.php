<?php

// cette page permet aux admins de voir la liste des livres empruntés ainsi que la date à 
// laquelle ils ont été empruntés

include("utils.php");

require '../vendor/autoload.php';


session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$livreRepository = new \Livre\LivreRepository($connection);
$user_connected=isset($_SESSION["id_user"]);

$prenom = '';
$nom = '';
$pseudo = '';
$admin = false;
if ($user_connected) {
  //on récupère les info sur l'utilisateur courrant (si il est identifié)
  //!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}


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
  <link rel="stylesheet" href="./css/style.css">
	<title>liste emprunts</title>
</head>
<div class="top"> <!--ajout d'un haut de page si l'utilisateur est admin ou si il est connecté-->
  <?php affiche_bandeau_connexion($user_connected, $nom, $prenom, $pseudo, $admin) ?> 
  <!-- dans utils.php -->
</div>
<body><header>
        <img src="../images/sciience.png"/>
    </header>
    <nav>
      <?php affiche_nav($user_connected, $admin) ?> <!-- dans utils.php -->
    </nav>
	<section>
		<div class="grand-titre">Emprunts</div>
       <!--on affiche direct la table on se fait pas chier-->
       <div class="res">Liste des emprunts en cours</div>

      <?php if ($listeEmprunts == []): ?>
        <p>Aucun livre n'est actuellement emprunté</p>
      <?php endif; ?>
      <?php if ($listeEmprunts != []): ?>
       <table>
       	<thead style="font-weight: bold">
       		<th>#</th>
       		<th>Titre</th>
       		<th>Emprunteur</th>
       		<th>Date_emprunt</th>
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
</section>
<?php affiche_footer()?>
</body>
</html>
