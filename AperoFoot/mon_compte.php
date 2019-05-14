<?php
include("mise_en_page.php");

entete("Accueil");

menu_nav();

?>

<div class="titre_div">
	<h1 class="titre_page">Mon compte</h1>
</div>

<?php
if (isset($_SESSION['id']) && isset($_SESSION['password'])) {
    ?>
    
       <h2 class="title_recherche">Bonjour, bienvenue sur votre compte</h2>

        <div class="tableau_formulaire">
            <div class="col1 col_form">

                <div class="liste_compte">

                    <p> Vous pouvez proposer un match </p>
                    <button id="ButtonProposition" class="submit-button">Proposer un match</button>

                    <script type="text/javascript">
                        document.getElementById("ButtonProposition").onclick = function () {
                            location.href = "accueil_proposition.php";
                        };
                    </script>

                </div>

                <div class="liste_compte">

                    <p>Ou aller en regarder un en toute tranquilité</p>
                    <button id="ButtonRecherche" class="submit-button">Rechercher un match</button>

                    <script type="text/javascript">
                        document.getElementById("ButtonRecherche").onclick = function () {
                            location.href = "accueil_recherche.php";
                        };
                    </script>

                </div>


                <div class="liste_compte">

                    <p>Pas de foot pour ce soir ? N'oubliez pas de vous déconnecter</p>
                    <button id="ButtonDeconnexion" class="submit-button">Déconnexion</button>

                    <script type="text/javascript">
                        document.getElementById("ButtonDeconnexion").onclick = function () {
                            location.href = "deconnexion.php";
                        };
                    </script>

                </div>
            </div>
            <div class="col2 col_form">
                <h3 class="titre_formulaire">Mes informations</h3>
                <?php

                    include("partial/menu_moncompte.php");

                    informations(isset($_SESSION['id']));
                ?>
                <div class="liste_compte">
                    <button id="Boutonmodifier" class="submit-button">Modifier</button>

                    <script type="text/javascript">
                        document.getElementById("Boutonmodifier").onclick = function () {
                            location.href = "changer_info.php";
                        };
                    </script>

                </div>

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
