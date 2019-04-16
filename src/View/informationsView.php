<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

<section>

    <p> Venez, venez, venez, venez, inscrivez vous sur notre magnifique site</p>
</section>
<section>

        <p> Les gens vivent, les gens meurent. Mais entre les deux, qu'est ce qui se passe ? </p>
    </section>


<?php $content = ob_get_clean(); ?>

<?php require "template.php"; ?>
