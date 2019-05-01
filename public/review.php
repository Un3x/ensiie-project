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
    <link rel="stylesheet" href=".css">
</head>
<body>
    <h2>Review</h2>
    <nav>
         <!-- TODO recopier le nav-->
    </nav>
    <div class="container">
        <h3>Voici les livres pour lesquels vous pouvez écrire une review</h3>
        <table>
            <thead>
                <td>Titre</td>
                <td>Couverture</td>
                <td>Rédiger une review</td>
            </thead>
            <?php foreach ($historiques as $historique): ?>
                <?php $livre = $livreRepository->fetchId($historique->getIdLivre()); 
                $reviewtest = [];
                $reviewtest = $reviewRepository->fetchByUserAndLivre($_SESSION['id_user'], $historique->getIdLivre()); ?>
                <?php if ($reviewtest == []): ?>
                <tr>
                    <td><?php echo $livre->getTitre(); ?></td>
                    <td><?php echo $livre->getImage(); ?></td>
                    <td><?php $ID = $livre->getId(); ?>
                        <form action="review.php" method="POST" oninput="x.value=parseInt(note.value)">
                        <div style="display:none" id=<?php echo "$ID"."disp"; ?>>
                        <input style="display:none" type="text" name="id_user" value=<?php echo $_SESSION['id_user']; ?>>
                        <input style="display:none" type="text" name="id_livre" value=<?php echo $livre->getId(); ?>>
                        Note :
                        <input type="range" min=0 max=10 name="note"><output name="x"></output>
                        | Review :
                        <input type="text" name="review">
                        <input type="submit" value="valider">
                        </div> 
                        <input type="button" onclick="aff_form(<?php echo "'$ID'"; ?>)" value="rédiger une review" id=<?php echo "$ID"."butt"; ?>>
                    </form>
                    </td>
                </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </table>

    </div>
</body>

<script>
    function aff_form(id) {
        document.getElementById(id.toString()+"disp").style.display="block";
        document.getElementById(id.toString()+"butt").style.display="none";
    }

</script>