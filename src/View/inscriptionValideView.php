<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<section class="information">

    <p>
        Bravo ! Votre inscription s'est bien déroulé. <br/>
            Se connecter.
    </p>
</section>



<?php $content = ob_get_clean(); ?>

<?php require "template.php"; ?>
