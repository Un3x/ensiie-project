<?php 
function formulaire_connexion() {
    echo '<section>
        <form class="topcorner" action="../controllers/connexionControlleur.php" method="post">
			<input class="formulaire" align="right" type="text" name="pseudo" placeholder="Pseudo" required/><br/>
            <input class="formulaire" align="right" type="password" name="mdp" placeholder="Mot de passe" required/><br/>
            <input class="formulaire" align="right" type="submit" name="connexion" value="Se connecter"/>
        </form>
        </section>';
}
?>