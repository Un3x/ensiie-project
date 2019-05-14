<?php
session_start();
?>
<?php
require 'controle.php';
$pseudo = $_GET['autre_pseudo'];
$identite = get_identite($pseudo);
$commentaire = get_commentaire($pseudo);
?>
<!DOCTYPE html>
<html lang="en" style="height:100%; width:100%">
<head>
    <meta charset="UTF-8">
    <title><?php echo "Administrateur"." sur"." profil de".$pseudo?></title>
    <link rel="stylesheet" href="prrr.css">
</head>



<body style="height:100%; width:100%">

<header>
    ManAdvisor
</header>

<nav>
    | <a href="deconnexion_admin.php" class='nv'>Deconnexion</a> |
</nav>
<br/>
<div id="div1" >
    <!-- Biographie et commentaires -->
    <div id="div101">
        <!--BIOGRAHIPE  -->
        <article>
            <h3 class="titre3">PHRASE CULTE</h3>
            <?php
            $phrase=$identite['phrase'];
            echo $phrase;
            ?>
        </article>
        <!--COMMENTAIRES -->
        <article>
            <h3 class="titre3">COMMENTAIRES</h3>
            <?php
            foreach ($commentaire as $com) : ?>
                <?php $commentateur=$com['commentateur'];echo'<p id="c">';echo'<a href="profil_autre.php?autre_pseudo='; echo $commentateur;echo' "class="c">';echo $commentateur;?> </a> a commenté:</p>
                <p><?php echo $com['commentaire']?></p>
                <p class="date_heure"><?php echo $com['dat']?> à <?php echo $com['heur']?>
                    <?php
                    $commentaire=$com['commentaire'];
                    $dat=$com['dat'];
                    $heur=$com['heur'];
                   ?>
                </p> <br/>
                <hr/>
            <?php endforeach;?>
        </article>
    </div>

    <div id="div102">
        <img src="yo.jpg" style="height:100%; width: 50% ">
    </div>

</div>
<!-- Identite du profil -->
<div id = "div2">

    <aside>
        <header id="hder">
            <a>TheMan</a>
        </header>
        <?php
        $image=$identite['avatar'];
        echo"<img src=$image \>";
        ?>
        <ul>
            <li>Nom: <?php echo $identite['nom'];?></li><br/>
            <li>Prénom: <?php echo $identite['prenom'];?></li><br/>
            <li>Note: <?php echo $identite['note'];?></li><br/>
            <li>Sexe: <?php echo $identite['sexe'];?></li><br/>
            <li>Ville: <?php echo $identite['ville'];?></li><br/>
            <li>Région: <?php echo $identite['region'];?></li><br/>
        </ul>
       <?php echo"<a id='suppr' href='controle1_suppression_by_admin.php?autre_pseudo=$pseudo'>Supprimer</a>"; ?>

    </aside>

</div>


</body>
</html>
