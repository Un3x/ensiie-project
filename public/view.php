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
					<a href=\"#\">Les menus !</a>
					<a href=\"#\">et un autre</a>
					<a href=\"#\">et un dernier</a>
				</div>
			</div>
			<div id=\"connexion\">
			<button class=\"bouton\"><a href=\"#\">Connexion</a></button>
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

?>
