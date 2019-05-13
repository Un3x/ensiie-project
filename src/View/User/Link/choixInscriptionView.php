<?php $title = "Choix inscription" ?>


<?php ob_start(); ?>

<section class="row">
    <p class="col-md-6 border"><a href="index.php?action=inscriptionClient" class="special">DEVENIR CLIENT</a></p>
    <p class="col-md-6 border"><a href="index.php?action=inscriptionCarrier" class="special">DEVENIR TRANSPORTEUR</a></p>
</section>

<?php $content = ob_get_clean(); ?>


<?php require("../src/View/template.php"); ?>