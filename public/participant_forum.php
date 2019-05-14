<?php 
require '../vendor/autoload.php';
require '../src/Forum/Forum.php';
require '../src/Forum/ForumRepository.php';
require '../src/Eleve/Eleve.php';
require '../src/Eleve/EleveRepository.php';
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


        <?php if(verif_admin()) {?>
            <br/>
            <div class="bouton-propose">
                <input type="button" value="Ajouter un forum" onclick="window.location='propose_forum.php'"/>
                <input type="button" value="Supprimer un forum" onclick="window.location='./supprime_forum.php'"/>
                <input type="button" value="Je participe !" onclick="window.location='./participe_forum.php'"/><br/>
                <input type="button" value="Voir les participants pour un autre forum" onclick="window.location='./participant_forum.php'"/>
                </div>
                <?php } ?>



<?php 
if (verif_authen() || verif_admin()) {
    if (!isset($_POST['id_forum'])) {
    echo "<div class=\"form-prop-forum\">
     <form method=\"post\" action=\"./participant_forum.php\">
     <label for=\"id_forum\">Id :</label>
        <input type=\"text\" id=\"id_forum\" name=\"id_forum\" required minlength=\"1\"><br/><br/>
        <button type=\"submit\" autofocus>Voir les inscriptions</button>
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
        $id_forum = $_POST['id_forum'];
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        $forumRepository2 = new \Eleve\EleveRepository($connection);
      $forumsp = $forumRepository2->participation2($_POST['id_forum']);?>
      
<div class="tab_forum">
            <table class="tab_forum">
                <caption>Les participations au forum demandé</caption>
                <thead>
                        <tr><th>Id</th><th>Nom</th><th>Ville</th><th>Date</th></tr>
                </thead>
                <?php       if ($forumsp != null) { ?>
                <tbody>
                <?php foreach($forumsp as $forump) :?>
	               <tr>
                        <td><?php echo $forump->getIdEleve(); ?></td>
                        <td><?php echo $forump->getNom(); ?></td>
                        <td><?php echo $forump->getPrenom(); ?></td>
                        <td><?php echo $forump->getMail();?></td>
                   </tr>
                   <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      </body> <?php
    }
    }
}
}
?>
<?php 
    pied();
    ?>

