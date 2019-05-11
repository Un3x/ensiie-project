
<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

<section>

    <p> Vous voulez aller quelque part ? <br/> 
        Nous avons la solution ! 
    </p>

    <form method="POST"  action="index.php?action=inscriptionClient">
        <?= $messageErreur?>
        <br/>

            <label for="mail"> Votre adresse mail : </label>
            <input type="text" name="mail" id="mail" value="<?=$valeurDefaut["mail"]?>" />
            <br/>
            <span class="contrainte">
                L'adresse mail est invalide.
            </span>

            <br/>
            <br/>
            <label for="password"> Mot de passe : </label>
             <input type="password" name="password" id="password" value="<?=$valeurDefaut["password"]?>"/>
             <br/>
            <label for="password2"> Confirmez votre mot de passe : </label>
            <input type="password" name="password2" id="password2" value="<?=$valeurDefaut["password2"]?>"/>
            <br/>
            <span class="contrainte"> Les deux mots de passe ne corresponde pas. </span>
        <br/>
        <p>
            <label for="prenom"> prénom : </label>
            <input type="text" name="prenom" id="prenom" value="<?=$valeurDefaut["prenom"]?>"/>
            <br/>
            <span class="contrainte">
                Le prenom est invalide ( entre 1 et 15 caractères standard)
                <br/> (Les caractères elfiques ne sont pas supportées)
            </span>

            <br/>

             <label for="nom"> nom : </label>
             <input type="text" name="nom" id="nom" value="<?=$valeurDefaut["nom"]?>"/>
            <br/>
            <span class="contrainte">
                Le nom est invalide ( entre 1 et 15 caractères standard)
                <br/> (Les caractères elfiques ne sont pas supportées)
            </span>
             <br/>
            <label for="age"> age : </label>
            <input type="number" name="age" id="age" value="<?=$valeurDefaut["age"]?>" min="0"/>
            <span class="contrainte">
                Age invalide. L'age ne peut pas être nulle ou négative.
                Nous refusons d'inscrire les gens qui ne sont pas encore née.
                Attendez de naitre et revenez vous inscrire ensuite seulement.
            </span>
            <br/>

        </p>
        <p>
            <label for= "description"> description : </label>
            <input type="text-area" name="description" id="description" value="<?=$valeurDefaut["description"]?>" />
        </p>
        <input type="submit" value="Valider"/>
    </form>



</section>


<?php $content = ob_get_clean(); ?>

<?php require "../src/View/template.php"; ?>

<script src="../public/js/verificationFormulaireClient.js"></script>