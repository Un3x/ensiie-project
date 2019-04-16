<?php

function header_login() {

	echo "
		<div id=\"top-bar\" class=\"flex-container\">
			<div><a href=\"index.php\"><img src=\"logo.png\" height=\"60\"></a></div>
			<div id=\"logo\">
			Move IT!
			</div>
			<div class=\"dropdown\">
			<button class=\"bouton\">Mon compte</button>
				<div class=\"dropdown-content\">
					<a href=\"compte.php\">Mon profil</a>
					<a href=\"#\">Mes spots</a>
					<a href=\"#\">Mes follows</a>
				</div>
			</div>
			<div id=\"connexion\">
			<button class=\"bouton\">";
				if (!isset($_SESSION['mail'])) {
					echo "<a href=\"connexion.php\">Connexion</a>";
				}
				else {
					//TODO unset de $_SESSION on click plus joli que js/php
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
	<div class=\"article-container\">
		<div class=\"article\">
			<p>
			Bonjour, ici se trouvera les différents spots suivis ainsi que l'activité
			des amis suivis. La map pourrait aussi être affichée en option pour visualiser
			les spots suivis et les spots près de ma localisation.
			</p>
		</div>
	</div>
	";
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
