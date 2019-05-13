

<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>


<?php ob_start(); ?>

<section>

<p>
    Pour profitez de nos services  ? : <a href="index.php?action=inscriptionClient"> inscrivez-vous ici </a>
</p>

<br/>

<p>
    Vous voulez vendre votre corps ? : <a href="index.php?action=inscriptionCarrier"> inscrivez-vous ici </a>
</p>

</section>

<?php $content = ob_get_clean(); ?>


<?php require("../src/View/template.php"); ?>