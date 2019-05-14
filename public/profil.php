<?php
    session_start();
?>
<?php
   require 'controle.php';
   $pseudo = $_SESSION['pseudo'];
   $identite = get_identite($pseudo);
   $commentaire = get_commentaire($pseudo);
?>
<!DOCTYPE html>
<html lang="en" style="height:100%; width:100%">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pseudo?></title>
    <link rel="stylesheet" href="prrr.css">
</head>



<body style="height:100%; width:100%">

<header>
    ManAdvisor
</header>

<nav>
    | <a href="deconnexion_user.php" class='nv'>Deconnexion</a> | <a href="profil.php" class="nv">Mon Profil</a> | <a href="modification.php" class="nv">Modifier mon Profil</a> | <a href="recherche.php" class="nv">Rechercher</a> |
</nav>

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
            echo"<a id='signaler' href='controle1_signaler.php?commentateur=$commentateur&commentaire=$commentaire&dat=$dat&heur=$heur'>Signaler<a/>";?>
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
        <a id="avatar_change" href="image_profil.php">Changer</a>
        <ul>
            <li>Nom: <?php echo $identite['nom'];?></li><br/>
            <li>Prénom: <?php echo $identite['prenom'];?></li><br/>
            <li>Note: <?php echo $identite['note'];?></li><br/>
            <li>Sexe: <?php echo $identite['sexe'];?></li><br/>
            <li>Ville: <?php echo $identite['ville'];?></li><br/>
            <li>Région: <?php echo $identite['region'];?></li><br/>
        </ul>
        <a id="suppr" href="controle1_suppression.php">Supprimer</a>

    </aside>

</div>


</body>
</html>
