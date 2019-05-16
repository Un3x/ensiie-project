<?php 
function formulaire_creationEvent() {
    echo '<section>
        <form action="../controllers/eventControlleur.php"id="general" method="post">
			<label>Entrez le nom de l\'event :</label> <input type="text" name="nom"/><br/>
            <label>Entrez le lieu :</label> <input type="text" name="lieu"/><br/>
            <label>Entrer la date de l\'event :</label> <input type="date" name="dateEvent"/><br/>
            <label>Entrez le prix de l\'event :</label> <input type="number" name="prix"/><br/>
            <input type="submit" name="creatEvent" value="Valider"/>
        </form>
        </section>';
}

function maj_event() {
	echo '<section>
        <form action="../controllers/eventMajControlleur.php" id="general" method="post">
			<label>Entrez le nom de l\'event que vous souhaitez modifier:</label> <input type="text" name="nom"/><br/>
			<label>Entrez le nouveau nom (pas obligatoire):</label> <input type="text" name="newNom"/><br/>
            <label>Entrez le nouveau lieu (pas obligatoire):</label> <input type="text" name="lieu"/><br/>
            <label>Entrer la nouvelle date de l\'event (pas obligatoire):</label> <input type="date" name="dateEvent"/><br/>
            <label>Entrez le nouveau prix de l\'event (pas obligatoire):</label> <input type="number" name="prix"/><br/>
            <input type="submit" name="majEvent" value="Valider"/>
        </form>
        </section>';
}
?>