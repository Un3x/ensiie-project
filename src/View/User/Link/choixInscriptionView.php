<?php $title = "Choix inscription" ?>


<?php ob_start(); ?>

<section class="row">
    <div class="col-md-6"><a href="/inscriptionClient" class="big_font">DEVENIR CLIENT</a></div>
    <div class="col-md-6"><a href="/inscriptionCarrier" class="big_font">DEVENIR TRANSPORTEUR</a></div>
</section>

<?php $content = ob_get_clean(); ?>


<?php require("../src/View/template.php"); ?>