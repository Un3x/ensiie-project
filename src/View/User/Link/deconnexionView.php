<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<section class="information">

    <p>
        Deconnexion Bien effectué ! <br/>

    </p>
</section>



<?php $content = ob_get_clean(); ?>

<?php require("../src/View/template.php"); ?>
