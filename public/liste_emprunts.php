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

$userRepository = new \User\UserRepository($connection);
$livreRepository = new \Livre\LivreRepository($connection);
$user_connected=isset($_SESSION["id_user"]);
if ($user_connected) {//on récupère les info sur l'utilisateur courrant (si il est identifié)
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
<body><header>
        <img src="../images/sciience.png"/>
    </header>
    <nav>
        <a href="index.php" class="rubrique">Accueil    </a>
        <a href="bibliotheque.php" class="rubrique">|   Bibliothèque    </a>
        <?php if ($user_connected): ?>
            <a href="espace_perso.php" class="rubrique">|   Espace perso    </a>
            <a href="review.php" class="rubrique">|   Review    </a>
            <?php endif; ?>
        <?php if ($user_connected && $admin): ?>
            <a href="liste_emprunts.php" class="rubrique">|   Liste   </a>
            <a href="ajout_livre.php" class="rubrique">|   Ajout livre   </a>
            <a href="rendu.php" class="rubrique">|   Retour   </a>
            <a href="emprunt.php" class="rubrique">|   Emprunt   </a>
        <?php endif; ?>
    </nav>
	<section>
		<div class="grand-titre">Emprunts</div>
       <!--on affiche direct la table on se fait pas chier-->
       <div class="res">Liste des emprunts en court</div>

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
</body>
</html>
