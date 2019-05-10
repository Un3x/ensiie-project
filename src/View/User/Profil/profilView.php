<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>


<?php ob_start(); ?>








<section>

    <!-- Insérer ici la moyenne des avis--!>
    <p>
        <?=($valeurDefaut['prenom']." ".$valeurDefaut['nom']) ?> : <?= $valeurDefaut['note']?> (en moyenne) <br/>
        <!-- insérer image  --!>

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
        <input type="text" id="prenom" value="<?=$valeurDefaut['prenom']?>"  <?php if(!$modif) echo "readonly"; ?> />

        <br/>

        <label for="nom"> Votre nom </label>
        <input type="text" id="nom"  value="<?=$valeurDefaut['nom']?>"  <?php if(!$modif) echo "readonly"; ?> />

        <br/>

        <label for="age"> Votre age :  </label>
        <input type="number" id="age"  value="<?=$valeurDefaut['age']?>"  <?php if(!$modif) echo "readonly"; ?> />

        <br/>


        <label for="description"> Votre description : </label>
        <br/>
        <textarea id="description"  <?php if(!$modif) echo "readonly"; ?>  >
            <?=$valeurDefaut['description']?>
        </textarea>

        <br/>


        <?php
        if($transporteur)
        { ?>
        <label for="vitesse"/> Vitesse : </label>
            <br/>
            <label for="nb_max"/> Capacité de charge : </label>


        <?php } ?>


        <?php
                if($modif)
        {
        ?>

        <input type="submit" value="Appliquez les changements"/>
        <input type="reset" value="Reinitialiser aux valeurs initiale"/>
            <input type="submit" value="annuler"/>
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
