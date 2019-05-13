<?php $title = "Vendez votre âme" ?>

<?php ob_start(); ?>

<section>
    <p> Nous rejoindre c'est avant tout rejoindre une grande famille,
        une famille de sans-âme certes mais une famille tout de même (payée une misère grace à une optimisation financière)
     </p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require "template.php"; ?>
