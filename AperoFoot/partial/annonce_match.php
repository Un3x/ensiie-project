<?php
function annonce_match($nommatch = 'Olympique de Marseille - FC Lyon', $nomhote = 'Dédé', $adresse = 'Marseille', $commentaires = 'Moins de Blabla, plus de pastis'){
    ?>

<div class="rectangle_annonce">
    <div class="titre_annonce">

        <h3 class="nom_match"><?php echo $nommatch ?></h3>

    </div>

    <div class="nom_annonce">

        <div class="flex_annonce">

            <span class="intro_nom">L'hôte est : </span>

            <span class="nom_hote"><?php echo $nomhote ?></span>

        </div>

        <div class="flex_annonce">

            <span class="intro_nom">Adresse : </span>

            <span class="nom_ville"> <?php echo $adresse ?></span>

        </div>

    </div>

    <div class="commentaires_annonce">

        <p class="intro_commentaires"> Informations supplémentaires :</p>

        <p class="commentaires_hote"> <?php echo $commentaires ?></p>

    </div>

    <div class="bouton_annonce">

        <a href="validation_annonce.php?match=<?php echo $nommatch ?>&amp;nom=<?php echo $nomhote ?>" class="bouton_recherche bouton_valider">Réserver</a>

    </div>


</div>
<?php
}
?>