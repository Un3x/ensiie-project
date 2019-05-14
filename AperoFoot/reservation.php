<?php
include("mise_en_page.php");

entete();

menu_nav();
?>

    <div class="titre_div">
        <h1 class="titre_page">Bon Match !</h1>
    </div>

<?php

$nommatch = $_GET['match'];
$nomhote = $_GET['nom'];

?>


<div class="content_form div_validation">
    <div class="validation_com">

            <p class="intro_reservation">
                C'est validé ! Profitez bien de <b><?php echo $nommatch; ?></b> chez <b><?php echo $nomhote; ?></b>.
    </p>

        <p class="intro_reservation">
            Rendez-vous ce soir à adresse de <?php echo $nomhote; ?> et pensez à apporter un petit quelque chose.
        </p>

        <p class="remerciement">
            A bientot sur Apero Foot !
        </p>

    </div>
    <div class="for_connect">
        <a href="accueil.php" class="bouton_recherche">Accueil</a>
    </div>
</div>

<?php
pied();

?>
