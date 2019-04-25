<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<?=$message?>

    

<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>



