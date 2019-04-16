<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<section>

    <p> Nos créatures sont trés biens traités</p>
</section>
<section>

    <p> Faites vous de l'argent, plein d'argent.</p>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

