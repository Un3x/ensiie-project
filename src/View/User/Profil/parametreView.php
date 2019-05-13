<?php $title = "Changement de mot de passe" ?>

<?php ob_start(); ?>

    <section>
        <!-- mot de passe -->
        <?=$message?>
        <form action="index.php?action=modifPassword" method="POST">
            <h1> Modifier votre mot de passe : </h1>
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
            <p> Voulez-vous vraiment supprimer votre compte ? : </p>
            <a href="index.php?action=destructionCompteDemande">
                <input type="button" value="Suppresion de votre compte"/>
            </a>
    </section>
    <!-- supprimer le compte -->

    <!--  Transporteur / Client -->

    <!-- -->

<?php $content = ob_get_clean(); ?>

<?php require "../src/View/template.php"; ?>