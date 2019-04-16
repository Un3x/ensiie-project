
<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

<section>

    <p> Vous voulez aller quelque part ? <br/> 
        Nous avons la solution ! 
    </p>

    <form method="POST"  action="index.php?action=inscriptionClient">
        <?= messageErreur?>

            <label> Votre adresse mail : </label> 
            <input type="text" name="mail"/>
            <!--Message javascript à faire ici -->
            <script>
             
            </script>
            <br/>
            <br/>
            <label> Mot de passe : </label>
             <input type="password" name="password" />
             <br/>
            <label> Confirmez votre mot de passe : </label> 
            <input type="password" name="password2"/>
            <br/>
        </p>
        <p>
            <label> prénom : </label> 
            <input type="text" name="prenom"/>
            <br/>
             <label> nom : </label>  
             <input type="text" name="nom"/>
             <br/>
            <label> age : </label> 
            <input type="number" name="age" value="18" min="0"/>
            <br/>
        </p>
    </form>

    <p>
    <label> description : </label>
    <input type="text-area" name="description"/>
    </p>

</section>


<?php $content = ob_get_clean(); ?>

<?php require "template.php"; ?>
