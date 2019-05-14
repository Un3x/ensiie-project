<?php
include("mise_en_page.php");

entete();

menu_nav();
?>

<div class="titre_div">
    <h1 class="titre_page">Réservation</h1>
</div>

<?php

$nommatch = $_GET['match'];
$nomhote = $_GET['nom'];

?>

<div class="content_form div_validation">
    <div class="valider_reservation">

            <span class="intro_reservation">
                Vous êtes sur le point de réserver une place pour le match <b><?php echo $nommatch; ?></b> chez <b><?php echo $nomhote; ?></b>.
    </span>

    </div>
    <div class="valider_reservation div_reservation">

        <a href="reservation.php?match=<?php echo $nommatch ?>&amp;nom=<?php echo $nomhote ?>" class="bouton_recherche">Valider</a>

    </div>

</div>

<?php
pied();

?>