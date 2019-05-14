<?php 
require '../vendor/autoload.php';
require '../src/Forum/Forum.php';
require '../src/Forum/ForumRepository.php';
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

<body>
  <?php en_tete(isset($_SESSION['connecte'])); ?>
        <div class="tab_forum">
            <table class="tab_forum">
                <caption><strong>Liste des forums</strong></caption>
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
        <?php if(verif_admin()) {?>
            <br/>
            <div class="bouton-propose">
                <input type="button" value="Ajouter un forum" onclick="window.location='propose_forum.php'"/>
                <input type="button" value="Supprimer un forum" onclick="window.location='supprime_forum.php'"/>
                <input type="button" value="Voir qui participe" onclick="window.location='participant_forum.php'"/>
                </div>
                <?php }
            if (verif_authen() || verif_admin()) { ?> 
            <div class ="bouton-propose">
                <input type="button" value="Je participe !" onclick="window.location='participe_forum.php'"/>
            <?php } ?> </div>
            </body>
    </html>
    <?php pied(); ?>
