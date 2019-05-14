<?php
include("mise_en_page.php");

entete();

menu_nav();


?>

    <div class="titre_div">
        <h1 class="titre_page">Proposer un match</h1>
    </div>


<?php
    if (isset($_SESSION['id']) && isset($_SESSION['password']))
    {
?>
    <div class="content_form">
        <h2 class="titre_proposition">Quoi de mieux que des amis pour regarder un match ?</h2>

        <form class="form_proposition" action="traitement_proposition.php" method="post">
            <div class="match_prop">
                <p class="membre_formulaire">
                    <label for="match">
                        Je propose le match :
                        <span class="required">*</span>
                    </label>
                    <input list="match" type="text" class="choix_match" name="nommatch">
                    <datalist id="match">
                        <?php
                        include("partial/listematchs.php");
                        ?>
                    </datalist>
                </p>
                <p class="membre_formulaire">
                    <label for="place">
                        Nombre de places sur le canapé
                        <span class="required">*</span>
                    </label>
                    <select id="place" name="place">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </p>

            </div>
            <div class="membre_formulaire adresse_formulaire">
                <label for="adresse" class="adresse_prop">
                    Adresse :
                </label>
                <div class="membre_adresse">
                    <div class="flex_adresse">
                        <label for="rue" class="rue_prop">
                            Numéro et nom de rue :
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="rue" name="rue">
                    </div>
                    <div class="flex_adresse">
                        <label for="ville" class="ville_prop">
                            Ville :
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="ville" name="ville">
                    </div>
                </div>
            </div>
            <p class="membre_formulaire adresse_formulaire">
                <label for="commentaires" class="commentaires_prop">
                    Commentaires :
                </label>
                <textarea id="commentaires" rows="10" cols="150" maxlength="1000" name="commentaires">Informations complémentaires, que souhaitez vous qu'ils apportent pour l'apéro, ...</textarea>
            </p>

            <p class="membre_formulaire">
                <button type="submit" class="bouton_formulaire" name="login" value="envoyer">Envoyer</button>
            </p>

        </form>

    </div>
    <?php
}
else {
    ?>

    <div class="for_connect">
        <p class="indication_connect"> Veuillez vous connecter ou vous inscrire afin de pouvoir proposer un match</p>
        <a href="connexion.php" class="bouton_recherche">Inscription/Connexion</a>
    </div>
                            

    <?php
}




pied();

?>