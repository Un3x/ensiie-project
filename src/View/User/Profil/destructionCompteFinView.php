<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

    <section>

    <span class="warning">
      Votre compte a été détruit, exterminé, réduit en poussière. <br/>
        Il ne reste plus rien de vous ici.  <br/>
        Alors, maintenant, allez-vous en. <br/>
        Adieu !

    </span>


    </section>



<?php $content = ob_get_clean(); ?>

<?php require "../src/View/template.php"; ?>