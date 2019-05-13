<?php

function header_login() {

	echo "
		<div id=\"top-bar\" class=\"flex-container\">
			<div><a href=\"index.php\"><img src=\"logo.png\" height=\"60\"></a></div>
			<div id=\"logo\">
			Move IT!
			</div>";
			if (!isset($_SESSION['mail'])) {
				echo "
				<div class=\"dropdown\">
					<button class=\"bouton\">
					<a href=\"connexion.php\">Inscription</a>
					</button>
				</div>
				";
			}
			else {
				echo "
				<div class=\"dropdown\">
				<button class=\"bouton\">Mon compte</button>
					<div class=\"dropdown-content\">
						<a href=\"compte.php\">Mon profil</a>
						<a href=\"follows.php\">Mes follows</a>
					</div>
				</div>";
			}
			echo"
			<div id=\"connexion\">
			<button class=\"bouton\">";
				if (!isset($_SESSION['mail'])) {
					echo "<a href=\"connexion.php\">Connexion</a>";
				}
				else {
					echo "<a href=\"logout.php\">Déconnexion</a>";
				}
			echo "</button>
			</div>
		</div>
		<div id=\"banniere\">

		</div>
	";
}

function my_head() {
	echo "
		<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
		<link href=\"https://fonts.googleapis.com/css?family=Roboto:300\" rel=\"stylesheet\">
		<title>Move it !</title>
	";
}

/**
 * @param string $login
 */
function followed($login) {
	echo "
		<div class=\"article\">
			<p>
			Bonjour, ici se trouvera les différents spots suivis ainsi que l'activité des amis suivis.
			</p>
		</div>
	";
}

function formSpot() {
	echo "
		<div class=\"article-container\">";
			followed($_SESSION['mail']);		
	echo "
			<div class=\"article\">
				<form action=\"index.php\" method=\"post\">
				<span style=\"font-size:140%\">Ajoute un Spot que tu as découvert :</br></span>
				<input type=\"text\" name=\"spotname\" required=\"true\" placeholder=\"Nom du spot\">
				<input type=\"text\" name=\"spotcity\" required=\"true\" placeholder=\"Ville du spot\">
				<input type=\"number\" min=\"0\" max=\"5\" name=\"spotnote\" placeholder=\"Note entre 0 et 5\">
				<input type=\"number\" step=\"any\" name=\"spotlatitude\" required=\"true\" placeholder=\"Latitude\">
				<input type=\"number\" step=\"any\" name=\"spotlongitude\" required=\"true\" placeholder=\"Longitude\">
				<button class=\"bouton\" type=\"submit\" style=\"margin-top: 8px\">envoyer</button>
				</form>
			</div>
		</div>
	";
}

function footer()
{
    echo "
	<p>
	Move IT Corp. Tous droits réservés.
	<a href = 'https://tripadvisor.mediaroom.com/FR-privacy-policy/tripadvisor.mediaroom.com/FR-terms-of-use'>Conditions d\'utilisation</a>.
	<a href = 'https://tripadvisor.mediaroom.com/FR-privacy-policy'>Politique de confidentialité</a>.
	Promis on vend pas vos données.
	</p> ";
}

function articles() {
	echo "
	<div class=\"article-container\">
		<div class=\"article\">
			<h3>Titre de l'article n°1</h3>
			<p>
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
			</p>
		</div>
		<div class=\"article\">
			<h3>Titre de l'article n°2</h3>
			<p>
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
				Ceci est du texte pour remplir. Ceci est du texte pour remplir.
			</p>
		</div>
	</div> ";
}

?>
