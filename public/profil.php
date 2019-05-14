<?php
require '../src/User/projetControl.php';
$status = $_SESSION['status'];
$pseudo = $_SESSION['pseudo'];
entete("Profil");

afficherProfil();



?>




</ul>
</nav>
<?php navigation($status);?>
<h3>vous etes un : <?php echo $status?></h3>

<?php pied(); ?>