<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<section class="information">

    <p>
        Bravo ! L'inscription s'est correctement déroulé. <br/>

    </p>
</section>



<?php $content = ob_get_clean(); ?>

<?php require "../src/View/template.php"; ?>
