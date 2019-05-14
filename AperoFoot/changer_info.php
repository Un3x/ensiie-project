
<?php
include("mise_en_page.php");

entete();

menu_nav();
?>

<div class="col2 col_form">
		<h3 class="titre_formulaire">Inscription</h3>
		<form action="traitement_changer.php" method="post">
			<p class="membre_formulaire">
				<label for="adresse_mail">
					Nouvelle adresse de messagerie
					<span class="required">*</span>
				</label>
				<input type="text" class="input_texte" name="adresse_mail" id="reg_adresse_mail" autocomplete="apero@foot.fr" >
			
			</p>
			<p class="membre_formulaire">
				
				<label for="nom">
					Nom
					<span class="required">*</span>
				</label>
				<input type="text" class="input_texte" name="nom" id="nom" autocomplete="Apero">
			
			</p>
			<p class="membre_formulaire">
				
				<label for="prenom">
					Prénom
					<span class="required">*</span>
				</label>
				<input type="text" class="input_texte" name="prenom" id="prenom" autocomplete="Foot">
			
			</p>
			<p class="membre_formulaire">
			
				<label for="password">
					Nouveau mot de passe
					<span class="required">*</span>
				</label>
				<input type="password" class="input_texte" name="password" id="reg_password" autocomplete="password">
		
			</p>
			<p class="membre_formulaire">
				<button type="submit" class="bouton_formulaire" id="bouton_formulaire" name="login" value="S'enregistrer">S'enregistrer</button>

				<script type="text/javascript">
    document.getElementById("bouton_formulaire").onclick = function () {
        location.href = "traitement_ajout.php";
    };
</script>
			</p>
		</form>

</div>
    
<?php
pied();

?>