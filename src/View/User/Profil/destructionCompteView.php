<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

<section>

    <span class="warning">
        Etes-vous sûr de vouloir détruire votre compte ?
        Cette opération est définitive.
    </span>
    <a href="/destructionCompte"> <input type="button" value="Oui, je le veux !"/> </a>
    <br/>
    <br/>
    <a href="index.php"> <input type="button" value="Non, surtout pas !"/> </a>


</section>



<?php $content = ob_get_clean(); ?>

<?php require "../src/View/template.php"; ?>