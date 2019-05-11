<?php
require '../vendor/autoload.php';

include "utils.php";

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


session_start();

$userRepository = new \User\UserRepository($connection);
$livreRepository = new \Livre\LivreRepository($connection);
$historiqueRepository = new \Historique\HistoriqueRepository($connection);
$reviewRepository = new \Review\ReviewRepository($connection);

$users = $userRepository->fetchAll();



//on teste si l'utilisateur est connecté
$user_connected=isset($_SESSION["id_user"]);

$admin = false;
if ($user_connected) {//on récupère les info sur l'utilisateur courrant (si il est identifié)
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut et la ligne $admin = false;
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}
//si l'utilisateur n'est pas connecté, on le redirige vers connexion.php
else {
    header("Location: connexion.php");
}


//si toutes les variables postées sont ok et postées, on effectue la mise à jour de review
if (isset($_POST['id_livre']) && isset($_POST['id_user']) && isset($_POST['note']) && isset($_POST['review'])) {
    $tmp = $reviewRepository->creeReview($_POST['id_livre'], '1', $_POST['id_user'], htmlspecialchars($_POST['review'], $flags = ENT_QUOTES), $_POST['note']);
/*
    $tmphistorique = $historiqueRepository->fetchByUserAndLivre($_POST['id_user'], $_POST['id_livre']);
*/
    $reviewRepository->insertReview($tmp);
    header("Location: index.php");
}


//on récupère l'ensemble des historiques correspondant à cet utilisateur
$historiques = $historiqueRepository->fetchByUser($_SESSION['id_user']);



?>

<html>
<head>
    <meta charset="utf-8">
    <title>Review</title>
    <link rel="stylesheet" href="./css/style.css">
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
        <a href="index.php"><img src="../images/sciience.png"/></a>
    </header>
     <nav>
        <?php affiche_nav($user_connected, $admin) ?> <!-- dans utils.php -->
    </nav>
    <section>
    <div class="grand-titre">Review</div>
    <div class="container">
        <?php 
        $test = true;
        foreach ($historiques as $historique) {
            if ($reviewRepository->fetchByUserAndLivre($_SESSION['id_user'], $historique->getIdLivre()) == []) {
                $test=($test && false);
            }
        }
        if (!($test)): ?>
        <div class="res">Voici les livres pour lesquels vous pouvez écrire une review</div>
        <table>
            <thead>
                <th>Couverture</th>
                <th>Titre</th>
                <th>Rédiger une review</th>
            </thead>
            <?php foreach ($historiques as $historique): ?>
                <?php $livre = $livreRepository->fetchId($historique->getIdLivre()); 
                $reviewtest = [];
                $reviewtest = $reviewRepository->fetchByUserAndLivre($_SESSION['id_user'], $historique->getIdLivre()); ?>
                <?php if ($reviewtest == []): ?>
                <tr>
                    <td class="couv"><img height="160" width="100" src=<?php echo $livre->getImage() ?>></td>
                    <td><?php echo $livre->getTitre(); ?></td>
                    <td><?php $ID = $livre->getId(); ?>
                        <form action="review.php" method="POST" oninput="x.value=parseInt(note.value)">
                        <div style="display:none" id=<?php echo "$ID"."disp"; ?>>
                        <input style="display:none" type="text" name="id_user" value=<?php echo $_SESSION['id_user']; ?>>
                        <input style="display:none" type="text" name="id_livre" value=<?php echo $livre->getId(); ?>>
                        Note :
                        <input type="range" min=0 max=10 name="note"><output name="x"></output>
                        | Review :
                        <textarea name="review" rows="3" cols="50"></textarea>
                        <input class="butcan" type="submit" value="valider">
                        </div> 
                        <input class="butcan" type="button" onclick="aff_form(<?php echo "'$ID'"; ?>)" value="rédiger une review" id=<?php echo "$ID"."butt"; ?>>
                    </form>
                    </td>
                </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </table>
        <br>
    <?php endif; ?>
    <?php if ($test): ?>
        <div class="res">Vous ne pouvez pas écrire de review pour le moment car vous n'avez pas rendu de livre</div>
    <?php endif; ?>
    </div>
</section>
</body>

<script>
    function aff_form(id) {
        document.getElementById(id.toString()+"disp").style.display="block";
        document.getElementById(id.toString()+"butt").style.display="none";
    }

</script>