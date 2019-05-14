<?php 
require '../vendor/autoload.php';
require '../src/Forum/Forum.php';
require '../src/Forum/ForumRepository.php';
require '../src/Participant/Participant.php';
require '../src/Participant/ParticipantRepository.php';
include './Verification.php';
session_start();

include './Vue.php';
?>

<?php
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword"); ?>

<?php $forumRepository = new \Forum\ForumRepository($connection);
      $forums = $forumRepository->fetchAll();?>

<html>
    <header>
        <meta charset="UTF-8" content="width=device-width, initial-scale= 1.0">
        <link href="./pageForum_pres.css" rel="stylesheet">
        <title>IImagE</title>
    </header>

  <?php en_tete(isset($_SESSION['connecte'])); ?>
<body>
        <div class="tab_forum">
            <table class="tab_forum">
                <caption>Forum</caption>
                <thead>
                        <tr><th>Id</th><th>Nom</th><th>Ville</th><th>Date</th></tr>
                </thead>
                <tbody>
                <?php foreach($forums as $forum) :?>
	               <tr>
                        <td><?php echo $forum->getIdForum(); ?></td>
                        <td><?php echo $forum->getNom(); ?></td>
                        <td><?php echo $forum->getVille(); ?></td>
                        <td><?php echo $forum->getDate();?></td>
                   </tr>
                   <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php $forumRepository2 = new \Forum\ForumRepository($connection);
      $forumsp = $forumRepository2->participation($_SESSION['id_eleve']);?>

<div class="tab_forum">
            <table class="tab_forum">
                <caption>Mes participations</caption>
                <thead>
                        <tr><th>Id</th><th>Nom</th><th>Ville</th><th>Date</th></tr>
                </thead>
                <?php       if ($forumsp != null) { ?>
                <tbody>
                <?php foreach($forumsp as $forump) :?>
	               <tr>
                        <td><?php echo $forump->getIdForum(); ?></td>
                        <td><?php echo $forump->getNom(); ?></td>
                        <td><?php echo $forump->getVille(); ?></td>
                        <td><?php echo $forump->getDate();?></td>
                   </tr>
                   <?php endforeach; ?>
                </tbody>
            </table>
        </div>
 <?php } ?>

        <?php if(verif_admin()) {?>
            <br/>
            <div class="bouton-propose">
                <input type="button" value="Ajouter un forum" onclick="window.location='propose_forum.php'"/>
                <input type="button" value="Supprimer un forum" onclick="window.location='./supprime_forum.php'"/>
                <input type="button" value="Voir les participants à un forum" onclick="window.location='./participant_forum.php'"/>
                </div>
                <?php } ?>



<?php 
if (verif_authen() || verif_admin()) {
    if (!isset($_POST['id_forum'])) {
    echo "<div class=\"form-prop-forum\">
     <form method=\"post\" action=\"./participe_forum.php\">
     <label for=\"id_forum\">Id :</label>
        <input type=\"text\" id=\"id_forum\" name=\"id_forum\" required minlength=\"1\"><br/><br/>
        <button type=\"submit\" autofocus>S'inscrire</button>
    </form></div>";
    }
    else {
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    if (empty ($_POST['id_forum'])) {
        echo "<p>Une erreur s\'est produite pendant votre identification. 
        Vous devez remplir tous les champs.<p>";
    }
    else {
        $participant = new \Participant\Participant();
        $participantRepository = new \Participant\ParticipantRepository($connection);
        $id_forum = $_POST['id_forum'];
        $id_eleve = $_SESSION['id_eleve'];
        $participant->setIdForum($id_forum);
        $participant->setIdEleve($id_eleve);
        $test_forum = $forumRepository->fetchForumById($id_forum);
        if ($test_forum == null) {
            echo "Le numéro du forum n'est pas valide.</br>";
            echo "<input type=\"button\" value=\"Participer à un autre forum\" onclick=\"window.location='participe_forum.php'\"/>";
        }
        else {
        if ($participantRepository->fetchId($id_eleve, $id_forum) != null) {
                echo "Vous participez déjà à ce forum. </br>";
                echo "<input type=\"button\" value=\"Participer à un autre forum\" onclick=\"window.location='participe_forum.php'\"/>";
            }
            else {
                if ($participantRepository->queryParticipant($participant)) {
                    echo "Vous vous êtes bien inscrit pour le forum n°$id_forum.";
                    echo "<input type=\"button\" value=\"Participer à un autre forum\" onclick=\"window.location='participe_forum.php'\"/>";
                    ?>
                    <script> window.location = './participe_forum.php'; </script> <?php
        }
        else {
            echo "You failed";
        }
    }
    }
}
    }
}
?>
</body>
<?php 
    pied();
    ?>

