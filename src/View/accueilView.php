<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<section>

    <p> Ceci est une information. Et ceci est une autre information.</p>
</section>
<section>

        <p> Mais quelle est vraiment le sens de ma vie, dans tout ça ? </p>
    </section>

    

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>



