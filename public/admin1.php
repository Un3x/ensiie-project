<?php
session_start();
?>

<?php
    require 'controle2_admin.php';
    $signalement=get_signalement();
?>

<!DOCTYPE html>
<html lang="en" style="height:100%; width:100%">
<head>
    <meta charset="UTF-8">
    <title>Signalements</title>
    <link rel="stylesheet" href="prrr.css">
</head>



<body style="height:100%; width:100%">

<header>
    ManAdvisor
</header><br\>
<nav>
    | <a href="deconnexion_admin.php" class='nv'>Deconnexion</a> |
</nav>
<br\>
<h2 style="color: red;text-align: center">Voici les commentaires signalés et les informations qui vont avec!</h2>
<?php
foreach ($signalement as $sg):
    $nombre=$sg['nombre'];
    $auteur=$sg['pseudo'];
    $commentaire=$sg['commentaire'];
    $commentateur=$sg['commentateur'];
    $dat=$sg['dat'];
    $heur=$sg['heur'];
?>
    <p style="color:blue">Auteur: <span class="sp"><?php echo " ".$auteur?></span></p>
<p style="color:blue">Nombre de fois:<span class="sp"><?php echo " ".$nombre?></span></p>
<p style="color:blue">Commentateur:<span class="sp"><?php echo " ".$commentateur?></span></p>
    <p style="color:blue">Commentaire:<span class="sp"><?php echo " ".$commentaire?></span></p>
    <?php
    echo"<a id='signaler' href='controle1_delete.php?auteur=$auteur&commentateur=$commentateur&commentaire=$commentaire&dat=$dat&heur=$heur'>Supprimer le commentaire<a/>";
    echo'<br/><br/>';
    echo"<a id='signaler' href='controle1_ignorer.php?auteur=$auteur&commentateur=$commentateur&commentaire=$commentaire&dat=$dat&heur=$heur'>Ignorer le signalement<a/>";?>

<br />
<hr />
<?php endforeach;?>
</body>
</html>
