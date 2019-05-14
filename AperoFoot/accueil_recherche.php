<?php
include("mise_en_page.php");
include("partial/annonce_match.php");

entete();

menu_nav();

?>

<div class="titre_div">
    <h1 class="titre_page">Rechercher un match</h1>
</div>


<?php
    if (isset($_SESSION['id']) && isset($_SESSION['password'])){
    ?>
    

    <div class="for_connect recherche_match">
        <form  action="ajout_match.php" method="post">
            <label for="recherche_match"> Quel match voulez-vous voir ? </label>
            <input list="match" type="text" class="choix_match" name="match">
            <datalist id="match">
                <?php
                include("partial/listematchs.php");
                ?>
            </datalist>
            <div class="membre_formulaire">
                <button type="submit" class="bouton_formulaire" name="search" value="Rechercher">Rechercher</button>
            </div>
        </form>
        <h2 class="title_recherche">Suggestions</h2>
        <?php annonce_match(); ?>
        <?php annonce_match(); ?>
    </div>

    <?php
}
else {
    ?>

    <div class="for_connect">
        <p class="indication_connect"> Veuillez vous connecter ou vous inscrire afin de pouvoir rechercher un match</p>
        <a href="connexion.php" class="bouton_recherche">Inscription/Connexion</a>
    </div>
    

    <?php
}
pied();

?>