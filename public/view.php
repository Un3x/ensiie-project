<?php

function header_login() {
	echo "

		<div id=\"top-bar\">
			<a href=\"index.php\"><img src=\"logo.png\" height=\"60\"></a>
			<div id=\"logo\">
			Move IT!
			</div>
			<div id=\"menu\" class=\"dropdown\">
			MENU
				<div class=\"dropdown-content\">
					<a href=\"#\">Les menus !</a>
					<a href=\"#\">et un autre</a>
					<a href=\"#\">et un dernier</a>
				</div>
			</div>
			<div id=\"connexion\">
			<a id=\"connexion-link\" href=#>CONNEXION</a>
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
