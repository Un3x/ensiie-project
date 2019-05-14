<?php
require '../vendor/autoload.php';
require '../src/User/projetControl.php';
entete("Réservation");
$status = $_SESSION['status'];
$pseudo = $_SESSION['pseudo'];
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

?>
<?php if($_GET['disponibilite']=='oui'){?>
            <?php
        $id=$_GET['reference'];
        $titre=$_GET['titre'];
         $reser= $bdd->query("INSERT INTO Emprunts Values($pseudo,$id,'22/03/2020')");
          echo("Le livre $titre avec comme reference $id a été résérvé avec succés ");
    
    ?>
    <?php }else{ ?>
    <?php
    $id=$_GET['reference'];
    $titre=$_GET['titre'];
     echo("Le livre $titre a été réservé avec succés et un administrateur va vous contacter très prochainement pour la remise.");
       
?>
<?php }
navigation($status);?>