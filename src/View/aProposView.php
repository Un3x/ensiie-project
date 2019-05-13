<?php $title = "A propos" ?>

<?php ob_start(); ?>

<section>
    <p> Uber Licorne est une entreprise ancestrale existant depuis des semaines 
        et qui à étendu son activité à toutes les races et transporte des millions de personnes par jour.
     </p>
</section>

<section>
    <p> Notre activité sans égale et non plagié nous à permis de devenir une entreprise que même de "grandes"
        entreprises comme apple nous envient      </p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require "template.php"; ?>
