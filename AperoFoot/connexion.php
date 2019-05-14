<?php
include("mise_en_page.php");

entete();

menu_nav();

?>
<div class="titre_div">
	<h1 class="titre_page">Mon compte</h1>
</div>
<div class="tableau_formulaire">
	<div class="col1 col_form">
		<h3 class="titre_formulaire">Connexion</h3>

	   	<form action="traitement_connexion.php" method="post">
			<div class="membre_formulaire">
				<label for="adresse_mail">
					Adresse de messagerie
					<span class="required">*</span>
				</label>
				<input type="text" class="input_texte" name="adresse_mail" id="adresse_mail" autocomplete="apero@foot.fr" >
			</div>
			<div class="membre_formulaire">
				<label for="password">
					Mot de passe
					<span class="required">*</span>
				</label>
				<input type="password" class="input_texte" name="password" id="password">
			</div>
			<div class="membre_formulaire">
				<button type="submit" class="bouton_formulaire" name="login" value="identification">Identification</button>
			</div>
    </form>
	</div>
	<div class="col2 col_form">
		<h3 class="titre_formulaire">Inscription</h3>

       	<form action="traitement_ajout.php" method="post">
			<div class="membre_formulaire">
				<label for="adresse_mail">
					Adresse de messagerie
					<span class="required">*</span>
				</label>
				<input type="text" class="input_texte" name="adresse_mail" id="reg_adresse_mail" autocomplete="apero@foot.fr" >
			</div>
			<div class="membre_formulaire">
				<label for="nom">
					Nom
					<span class="required">*</span>
				</label>
				<input type="text" class="input_texte" name="nom" id="nom" autocomplete="Apero">
			</div>
			<div class="membre_formulaire">
				<label for="prenom">
					Prénom
					<span class="required">*</span>
				</label>
				<input type="text" class="input_texte" name="prenom" id="prenom" autocomplete="Foot">
			</div>
			<div class="membre_formulaire">
				<label for="password">
					Mot de passe
					<span class="required">*</span>
				</label>
				<input type="password" class="input_texte" name="password" id="reg_password" autocomplete="password">
			</div>
			<div class="membre_formulaire">
				<button type="submit" class="bouton_formulaire" name="login" value="S'enregistrer">S'enregistrer</button>
			</div>
		</form>
	</div>
</div>

<?php

pied();

?>