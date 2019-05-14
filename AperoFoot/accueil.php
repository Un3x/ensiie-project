<?php
include("mise_en_page.php");

entete("Accueil");

menu_nav();
?>
<div class="banner_accueil">
	<div class="image_accueil"></div>
	<div class="title_accueil">
		<h1> Avec qui allez vous regarder le match ce soir ?</h1>
		<a href="accueil_recherche.php" class="bouton_recherche">Rechercher un match</a>
	</div>
</div>
<div class="article_accueil">
    <h1 class="titre_principal">Vivez vos plus belles 90 minutes entre fans du ballon rond</h1>
    <p> Votre équipe favorite s'apprête à jouer une rencontre décisive en championnat que vous ne voudriez en aucun cas manquer ? Malheureusement l'abonnement aux chaînes de télévision sportives vous semble trop cher pour l'utilité que vous en auriez ? Votre télévision rencontre certains problèmes et vous en avez marre des visionnages de qualité médiocre sur des sites de streaming allemands ? Pour palier cela, rejoignez nous sur AperoFoot afin de partager des moments footballistiques avec d'autres amateurs du sport. Il suffit de s'inscrire, de créer votre profil et de rechercher la rencontre souhaitée. Une proposition de covisionnage vous sera faite en échange d'une mince participation dans le but d'organiser un apéritif tel que vous l'entendez.
    </p>

    <div class="bouton_accueil">

        <a href="accueil_proposition.php" class="bouton_recherche">Proposer un match</a>
        <a href="mon_compte.php" class="bouton_recherche">Mon compte</a>
        <a href="connexion.php" class="bouton_recherche">S'inscrire/Connexion</a>

    </div>

</div>



<?php
pied();

?>