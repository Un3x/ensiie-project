<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>


<?php ob_start(); ?>


<section>

    <!-- Insérer ici la moyenne des avis-->
    <p>
        <?=($valeurDefaut['prenom']." ".$valeurDefaut['nom']) ?> : <?= $valeurDefaut['note']?> (en moyenne) <br/>
        <!-- insérer image  -->

    </p>

    <br/>
    <br/>
    <p>
        <?=$message?>
    </p>


    <form action=
          <?php if($modif) echo "'index.php?action=validationProfil'"; else  echo"'index.php?action=changementProfil'"; ?>
          method="POST" >
        <label for="prenom"> Votre prenom : </label>
        <input type="text" id="prenom" name="prenom" value="<?=$valeurDefaut['prenom']?>"  <?php if(!$modif) echo "readonly"; ?> />

        <br/>

        <label for="nom"> Votre nom </label>
        <input type="text" id="nom"  name="nom" value="<?=$valeurDefaut['nom']?>"  <?php if(!$modif) echo "readonly"; ?> />

        <br/>



        <br/>
        <label for="phoneNumber"> Votre numéro de téléphone : </label>
        <input type="tel" id="phoneNumber" name="phoneNumber" value="<?=$valeurDefaut['phoneNumber']?>" <?php if((!$modif)) echo "readonly"; ?> />
        <br/>


        <br/>
        <br/>

        <label for="description"> Votre description : </label>
        <br/>
        <textarea id="description"  name="description" <?php if(!$modif) echo "readonly"; ?>  >
            <?=$valeurDefaut['description']?>
        </textarea>

        <br/>
        <br/>
        <br/>

        <?php if($_SESSION['userType']=='Vendor')  { ?>
<label for="race"> Votre race : </label>
            <br/>

            <?=$race?>

            <br/>
            <br/>
            <label for="price"> Votre prix ( en lingot d'or par ) : </label>
            <input type="number" id="price" name="price" value="<?=$valeurDefaut['price']?>" <?php if(!$modif) echo "readonly"; ?> />


        <?php } ?>

        <br/>
        <br/>
        <br/>


        <?php if($modif)  { ?>

            <input type="submit" value="Appliquez les changements" name="valider" />
            <input type="reset" value="Reinitialiser aux valeurs initiale"/>
            <input type="submit" value="Annulation" name="annuler" />

            <br/>


        <?php
        }
                else
        {
            ?>
        <input type="submit" value="Modifier votre profil"/>
            <br/>

        <?php
        }
                ?>


    </form>




</section>



<section> 

Savez-vous que ... ? 
Ah, bah moi non plus, je ne le savais pas.

</section>





<?php $content = ob_get_clean(); ?>

<?php require("../src/View/template.php"); ?>

<?php if($_SESSION["userType"] == 'Vendor' && $modif)  {?>

<script src="../public/js/changementCaracRace.js">

</script>

<?php } ?>

