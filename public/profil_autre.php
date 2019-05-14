<?php
session_start();
require 'controle.php';
$pseudo_autre=$_GET['autre_pseudo'];
$identite=get_identite($pseudo_autre);
$commentaire=get_commentaire($pseudo_autre);
?>

<!DOCTYPE html>
<html lang="en" style="height:100%; width:100%">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pseudo_autre?></title>
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
                <p class="date_heure"><?php echo $com['dat']?> à <?php echo $com['heur']?></p> <br/>
                <hr/>
            <?php endforeach;?>
        </article>
    </div>

    <div id="div102">
        <form action='controle1_com.php?autre_pseudo=<?php echo $pseudo_autre;?>' method="post">
           <br><textarea rows="3" name="commentaire" placeholder="Commentez ici"></textarea>
            <input type="submit" value="Valider"> <br>
            <?php if(isset($_GET['code_err'])){
                echo "<p style='color:red; text-align: center'>Commentaire vide non envoyé!</p>";
            }
            ?>
            <?php if(isset($_GET['arg_com'])){
                require 'controle2_com.php';
                $commentaire=$_GET['arg_com'];
                commenter($commentaire,$pseudo_autre);
                echo "<p style='color:red; text-align: center'>Commentaire envoyé!</p>";
            }
            ?>
        </form >

        <form action='controle1_notation.php?autre_pseudo=<?php echo $pseudo_autre;?>' method="post">
             <br><input type="number" name="note" placeholder="Notez Ici" min="0" max="10"> <input type="submit" value="Valider" >
            <?php
            if(isset($_GET['cod_err'])){
                echo "<p style='color:red; text-align: center'>Vous ne pouvez pas vous auto-noter!</p>";
            }
            ?>
            <?php
                if(isset($_GET['cod_er'])){
                    echo "<p style='color:red; text-align: center'>Note indéfinie non prise en compte!</p>";
            }
            ?>
            <?php if(isset($_GET['arg_note'])){
                require 'controle2_notation.php';
                require 'transactions.php';
                $note=$_GET['arg_note'];
                noter($note,$pseudo_autre);
                echo "<p style='color:red; text-align: center'>Note prise en compte!</p>";
            }
            ?>
        </form>
    </div>

</div>
<!-- Identite du profil -->
<div id = "div2">

    <aside>
        <header id="hder">
            <p>TheMan</p>
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

    </aside>

</div>


</body>
</html>
