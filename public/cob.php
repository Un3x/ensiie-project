<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$user = $userRepository->id_All();
$userRepository = new \User\UserRepository($connection);
$coms = $userRepository->com_all();
?>



<!DOCTYPE html>
<html lang="en" style="height:100%; width:100%">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="prrr.css">
</head>



<body style="height:100%; width:100%">

<header>
    ManAdvisor
</header>

<nav>
    | <a href="index.php" class='nv'>Deconnexion</a> | <a href="profil.php" class="nv">Mon Profil</a> | <a href="modification.php" class="nv">Modifier mon Profil</a> | <a href="recherche.php" class="nv">Rechercher</a> |
</nav>

<div id="div1" >
    <!-- Biographie et commentaires -->
    <div id="div101">
        <!--BIOGRAHIPE  -->
        <article>
            <h3 class="titre3">PHRASE CULTE</h3>
            <?php /** @var \User\Identite $use */
            foreach ($user as $use) : ?>
                <p><?php echo $use ->getPhrase()?></p><br/>
            <?php  endforeach; ?>

        </article>
        <!--COMMENTAIRES -->
        <article>
            <h3 class="titre3">COMMENTAIRES</h3>
            <?php /** @var \User\Commentaire $com */
            foreach ($coms as $com) : ?>
                <?php $name = $com->getCommentateur(); echo"<a href='profil_autre.php?pseudo_autre=$name' class='c' >" ?><?php echo $com ->getCommentateur()?> </a> a commenté: </a><br/>
                <p><?php echo $com -> getCommentaire()?></p><br/>
                <p class="date_heure"><?php echo $com -> getDat()?> à <?php echo $com -> getHeur()?></p>
                <hr>
            <?php  endforeach; ?>
        </article>
    </div>
    <!-- Commentaires et notation -->
    <!--<div id="div102">
         <form>
             COMMENTER <br><textarea rows="6"> Entrez votre commentaire </textarea>
             <input type="submit" value="Valider"> <br>
             NOTER <br><input type="number" > <input type="submit" value="Valider" >
         </form>
     </div> -->
    <div id="div102">
        <img src="yo.jpg" style="height:100%; width: 50% ">
    </div>

</div>
<!--Partie gauche du profile
       @l'identité du détenteur du profil
        @La note du profil
         @La liste des amis du profil-->
<div id = "div2">

    <aside>
        <header id="hder">
            <p>TheMan</p>
        </header>
        <ul>
            <?php /** @var \User\Identite $use */
            foreach ($user as $use) : ?>
                <li> <img src="tresor.jpg"></li><br/>
                <li>Nom: <?php echo $use->getNom()?></li> <br/>
                <li>Prénom: <?php echo $use->getPreNom()?></li><br/>
                <li>Note: <?php echo $use->getNote()?></li><br/>
                <li>Ville: <?php echo $use->getVille()?></li><br/>
                <li>Region: <?php echo $use->getRegion()?></li><br/>
            <?php  endforeach; ?>
        </ul>
    </aside>

</div>


</body>
</html>

