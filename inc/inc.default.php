<?php
	function entete( $titre = "" )
	{
		echo "<!DOCTYPE HTML>\n";
		echo "<html lang=\"fr\"\n";
		echo "<head>\n";
		echo "\t<title>$titre</title>";
		echo "\t<meta charset=\"UTF-8\" />\n";
		echo "\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
		echo "\t<link rel=\"stylesheet\" href=\"../CSS/style.css\" type=\"text/css\" />\n";
		echo "\t<link rel=\"stylesheet\" href=\"../CSS/cadre.css\">\n";
		echo "\t<link rel=\"shortcut icon\" href=\"../img/badassChicken.ico\">\n";
		echo "</head>\n";
		echo "<body>\n";
		menu();
	}

	function pied()
	{
		echo "</article>\n";
		echo "<footer>\n";
		echo "<p class=\"texteBas\">mail de contact : <a href=\"mailto:random@ensiie.fr\">random@ensiie.fr</a> . adresse  : 1 place de la résistance 91025 Evry</p>\n";
		echo "</footer>\n";
		echo "</body>\n";
		echo "</html>";
	}

	function menu()
	{
		echo "<header>\n";
		echo "\t<div id=\"menu\">\n";
		
		
		echo "\t\t<a href=\"index.php\">";
		echo "\t\t\t<img src=\"../img/logo_realitiie.png\" ";
		echo "alt=\"Accueil\" /></a>"; 
		
		
		echo "\t\t<div>\n";
		echo "\t\t\t<a href=\"index.php\">Realitiie</a>\n";
		echo "\t\t</div>\n";
		
		echo "\t\t<div>\n";
		echo "\t\t\t<a href=\"index.php\">Accueil</a>\n";
		echo "\t\t</div>\n";
		
		echo "\t\t<div>\n";
		echo "\t\t\t<a href=\"equipe.php\">Equipe</a>\n";
		echo "\t\t</div>\n";
		
		echo "\t\t<div>\n";
		echo "\t\t\t<a href=\"article.php\">Articles</a>\n";
		echo "\t\t</div>\n";
		
		echo "\t\t<div>\n";
		echo "\t\t\t<a href=\"debrief.php\">Comptes rendu</a>\n";
		echo "\t\t</div>\n";
		
		echo "\t\t<div>\n";
		echo "\t\t\t<a href=\"projet.php\">Projets</a>\n";
		echo "\t\t</div>\n";
		
		echo "\t\t<div>\n";
		echo "\t\t\t<a href=\"laval.php\">Laval</a>\n";
		echo "\t\t</div>\n";
		
		echo "\t\t<div>\n";
		echo "\t\t\t<a href=\"ressources.php\">Ressources</a>\n";
		echo "\t\t</div>\n";
		
		
		
		//echo "\t\t<div>\n";
		//echo "\t\t\t<a href=\"exercices.php\">Exercices</a>\n";
		//echo "\t\t</div>\n";
		
		
		
		echo "\t</div>\n";
		echo "</header>\n";
	}
?>