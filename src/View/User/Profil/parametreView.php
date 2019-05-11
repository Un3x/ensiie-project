<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>



<section>
    <!-- mot de passe --!>
<form action="index.php?action=modifPassword" method="POST">
    <label> Modifier votre mot de passe : </label>
    <br/>
    <br/>

    <label for="passwordOld"> Ancien mot de passe : </label>
    <input type="password" id="passwordOld" name="passwordOld"/>
    <br/>
    <label for="password"> Nouveau mot de passe : </label>
    <input type="password" id="password"  name="password"/>
    <br/>
    <label for="password2"> Confirmation : </label>
    <input type="password" id="password2" name="password2"/>
    <br/>
    <br/>
    <input type="submit" value="Modifier votre mot de passe"/>
    <br/>
    <br/>
</form>
</section>

<section>
    <p> Voulez-vous vraiment supprimer votre compte ? : </p>
    <a href="index.php?action=suppressionCompte">
        <input type="button" value="Suppresion de votre compte"/>
    </a>
    <!-- supprimer le compte --!>
</section>

<section>
    <!--  Transporteur / Client --!>
</section>

<section>
    <!-- --!>
</section>

<?php $content = ob_get_clean(); ?>

<?php require "../src/View/template.php"; ?>