<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche</title>
    <link rel="stylesheet" type="text/css" href="prrr.css" />
</head>
<body>
<header>
    ManAdvisor
</header>
<nav>
    | <a href="deconnexion_user.php" class="nv">Déconnexion</a> | <a href="profil.php" class="nv">Mon Profil</a> | <a href="modification.php" class="nv">Modifier mon Profil</a> | <a href="recherche.php" class="nv">Rechercher|</a>
</nav>
<br/>
<h2 style="text-align: center; color:blue">Une note, une différence!</h2>
<br/>
<form action="controle1_recherche.php" method="get" class="form-style" class="form-style">
    <h2 style="text-align: center">Qui veux-tu Voir ?</h2>
    <br/>
    <p>
        <input type="search" size="20" name="terme" placeholder="Entrez un nom, un prenom ou un pseudo" />
    </p>
    <br/>
    <input type="submit" name="s" value="Rechercher" />
    <input type="reset" value="Annuler" />

    <?php if(isset($_GET['arg2'])){
        $message = $_GET['arg2'];
        echo "<p style='color:red; text-align: center'>$message</p>";
    }
    ?>

    <?php if(isset($_GET['arg1'])){
        require 'controle2_recherche.php';
        $terme=$_GET['arg1'];;
        $reponse=recherche($terme);
        $count = 0;
        foreach($reponse as $rep) {
            $count=++$count;
        }
        if($count >0) {
            echo"<p style=\"text-align: center; color:red\">Résultats de votre recherche :</p>";
            echo "<ul id='rec'>";
            foreach($reponse as $rep) {
                $ps=$rep['pseudo'];
                $nm=$rep['nom'];
                $pr=$rep['prenom'];
                echo"<li><a href='profil_autre.php?autre_pseudo=$ps' id='rech'> $ps <a/> ( $nm $pr )</li>";
            }
            echo"</ul>";
        }
        else {
            echo"<p style=\"text-align: center; color:red\">Désolé, nous n'avons trouvé aucune correspondance!</p>";
        }
    }
    ?>

</form>
</body>
</html>