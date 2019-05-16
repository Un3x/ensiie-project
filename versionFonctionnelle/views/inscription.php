<?php 

function formulaire_inscription() {
    echo '<section>
        <form action="../controllers/inscriptionControlleur.php" method="post" id="general">
			<label>Entrez votre pseudo :</label> <input type="text" name="pseudo"/><br/>
            <label>Entrez votre mot de passe :</label> <input type="password" name="mdp"/><br/>
            <label>Confirmation de votre mot de passe :</label> <input type="password" name="confirmationMdp"/><br/>
            <label>Entrez votre prénom :</label> <input type="text" name="prenom"/><br/>
            <label>Entrez votre nom :</label> <input type="text" name="nom"/><br/>
			<label>Entrez votre date d\'anniversaire :</label> <input type="date" name="dateAnniv"/><br/>
			<label>Entrez votre promo :</label> <input type="number" name="promo"/><br/>
            <input type="submit" name="inscription" value="Valider"/>
        </form>
		<br/>
		déjà un compte ? <a href="../models/modelConnexion.php">Se connecter</a>
        </section>';
}

function maj_utilisateur(){
	echo '<section>
        <form action="../controllers/utilisateurMajControlleur.php" method="post" id="general">
			<label>Entrez votre mot de passe pour s\'assurer de votre identité:</label> <input type="text" name="nom"/><br/>
			<label>Entrez votre nouveau pseudo (optionnel):</label> <input type="text" name="pseudo"/><br/>
			<label>Entrez votre nouveau mot de passe (optionnel):</label> <input type="password" name="newMdp"/><br/>
            <label>Entrez votre nouveau prénom (optionnel):</label> <input type="text" name="prenom"/><br/>
            <label>Entrez votre nouveau nom (optionnel):</label> <input type="text" name="nom"/><br/>
			<label>Entrez votre date d\'anniversaire mise à jour (optionnel):</label> <input type="date" name="dateAnniv"/><br/>
			<label>Entrez votre promo mise à jour (optionnel):</label> <input type="number" name="promo"/><br/>
            <input type="submit" name="majUser" value="Valider"/>
        </form>
        </section>';
}
?>
