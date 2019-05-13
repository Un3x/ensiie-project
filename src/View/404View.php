<?php $title = "page inexistante" ?>

<?php ob_start(); ?>


<section>
    <p>Cette page n'existe pas</p>
</section>


<?php $content = ob_get_clean(); ?>

<?php include('template.php'); ?>



