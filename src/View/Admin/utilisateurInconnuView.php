<?php $title = "Accès Admin ! " ?>


<?php ob_start(); ?>

<section>
     Nous n'arrivons pas à trouver l'utilisateur que vous cherchez.
    <br/>
    <br/>
</section>


<?php $content = ob_get_clean(); ?>

<?php require("../src/View/template.php"); ?>

