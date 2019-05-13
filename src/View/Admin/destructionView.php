<?php $title = "Accès Admin ! " ?>


<?php ob_start(); ?>


<section>
    L'utilisateur a été correctement éliminé.
</section>

<?php $content = ob_get_clean(); ?>

<?php require("../src/View/template.php"); ?>

