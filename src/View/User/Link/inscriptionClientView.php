
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
            <span class="contrainte"> Les deux mots de passe ne correspondent pas. </span>
        <br/>
        <p>
            <label for="prenom"> prénom : </label>
            <input type="text" name="prenom" id="prenom" value="<?=$valeurDefaut["prenom"]?>"/>
            <br/>
            <span class="contrainte">
                Le prenom est invalide ( entre 1 et 15 caractères standards)
                <br/> (Les caractères elfiques ne sont pas supportés)
            </span>

            <br/>

             <label for="nom"> nom : </label>
             <input type="text" name="nom" id="nom" value="<?=$valeurDefaut["nom"]?>"/>
            <br/>
            <span class="contrainte">
                Le nom est invalide ( entre 1 et 15 caractères standards)
                <br/> (Les caractères elfiques ne sont pas supportés)
            </span>
             <br/>
            <label for="phoneNumber"> Votre numéro de téléphone : </label>
            <input type="tel" name="phoneNumber" id="phoneNumber" value="<?=$valeurDefaut['phoneNumber']?>"/>
            <span class="contrainte">
                Ceci n'est pas un numéro de téléphone. <br/>
            </span>
            <br/>

            <label for="birthDate"> Date de naissance (aaaa-mm--jj) : </label>
            <input type="date" name="birthDate" id="birthDate" value="<?=$valeurDefaut["birthDate"]?>" />
            <span class="contrainte">
                Date invalide.
            </span>
            <br/>
            <label for="genre"> Votre genre : </label>
            <select id="genre" name="genre">
                <option value="hélicopter apache"> hélicopter apache </option>
                <option value="hélicopter apache"> hélicopter apache </option>
                <option value="Others"> Autre </option>
            </select>
            <br/>

        </p>
        <p>
            <label for= "description"> description : </label>
            <textarea name="description" id="description">
                <?=$valeurDefaut['description']?>
            </textarea>
        </p>
        <input type="submit" value="Valider"/>
    </form>



</section>


<?php $content = ob_get_clean(); ?>

<?php require "../src/View/template.php"; ?>

<script src="/js/verificationFormulaireClient.js"></script>