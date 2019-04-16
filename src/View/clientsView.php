
<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>



<section>

    <p> Ceci est la section des informations sur les clients</p>
</section>
<section>

        <p> Ceci est un témoignage :"" Ce site est trop bien. ""
            <br/>
        C'était un témoignage. </p>
    </section>


    <?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

