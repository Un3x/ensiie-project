<?php $title = "Accès Admin ! " ?>


<?php ob_start(); ?>



<section>
    <p>
        <?=$message?>
    </p>


    <form action="/modifUserAdmin&id=<?=$_GET['id']?>&type=<?=$_GET['type']?>"  method="POST" >

        <label for="prenom"> Son prenom : </label>
        <input type="text" id="prenom" name="prenom" value="<?=$valeurDefaut['prenom']?>"/>

        <br/>

        <label for="nom"> Son nom </label>
        <input type="text" id="nom"  name="nom" value="<?=$valeurDefaut['nom']?>" />

        <br/>
        <label for="mail"> Son addresse mail </label>
        <input type="text" id="mail"  name="mail" value="<?=$valeurDefaut['mail']?>" />

        <br/>
        <label for="phoneNumber"> Son numéro de téléphone : </label>
        <input type="tel" id="phoneNumber" name="phoneNumber" value="<?=$valeurDefaut['phoneNumber']?>" />
        <br/>


        <br/>
        <br/>
        <br/>
        <label for="birthDate"> Sa date de naissance : </label>
        <input type="date" id="birthDate" name="birthDate" value="<?=$valeurDefaut['birthDate']->format("Y-m-d")?>" />
        <br/>

        <label for="description"> Sa description : </label>
        <br/>
        <textarea id="description"  name="description"> <?=$valeurDefaut['description']?> </textarea>
        <br/>

        <br/>
        <br/>
        <br/>

        <?php if( $vendeur)  { ?>
            <label for="race"> sa race : </label> <?=$valeurDefaut['race']?>
            <br/>

            <br/>
            <br/>
            <label for="price"> Son prix : </label>
            <?=$valeurDefaut['price']?>
            <br/>
            <label for="occupied"> Etat : </label>
             <?=$valeurDefaut['occupied']?>
            <br/>
            <br/>
            <label for="position"> Position : </label>
            <?= $valeurDefaut['position']?>
            <br/>
            <br/>
        <?php } ?>

        <br/>
        <br/>
        <br/>

            <input type="submit" value="Modifier ce compte" name="modifier" />
            <input type="reset" value="Reinitialiser aux valeurs initiale"/>
        <br/>
        (Attention, opération dangereuse !!!)
        <br/>
            <input type="submit" value="Detruire ce compte" name="destruction" />

            <br/>



    </form>




</section>

<?php $content = ob_get_clean(); ?>

<?php require("../src/View/template.php"); ?>


