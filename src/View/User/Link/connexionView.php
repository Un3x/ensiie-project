
<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<section>
    <p>
        <h3> Connexion  : </h3>
        <form method="POST" action="/connexion">
            <?=$messageErreur?>
            <label> login: </label>

                 <input type="text" name="login"/>
                <br/>
            <label> Mot de passe : </label>
            <input type="password" name="password"/>
            <br/>
            <input type="submit" value="Connectez-vous"/>
        </form>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>

