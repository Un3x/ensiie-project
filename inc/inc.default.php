<?php
	function initialisation()
	{
		global $connection;
		session_start();
		$dbName = 'realitiie';
		$dbUser = 'postgres';
		$dbPassword = 'postgres';
		$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");
	}

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
		initialisation();
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
		echo "\t<div class=\"topnav\">\n";
		
		
	/*	echo "\t\t<a href=\"index.php\">";
		echo "\t\t\t<img src=\"../img/logo_realitiie.png\" ";
		echo "alt=\"Accueil\" /></a>"; */
		
		
		echo "\t\t<a class=\"active\" href=\"../public/index.php\">\n";
		echo "\t\t\tRealitiie\n";
		echo "\t\t</a>\n";
		
		echo "\t\t<a href=\"../public/index.php\">\n";
		echo "\t\t\tAccueil\n";
		echo "\t\t</a>\n";
		
		echo "\t\t<a href=\"../public/equipe.php\">\n";
		echo "\t\t\tEquipe\n";
		echo "\t\t</a>\n";
		
		echo "\t\t<a href=\"../public/article.php\">\n";
		echo "\t\t\tArticles\n";
		echo "\t\t</a>\n";
		
		echo "\t\t<a href=\"../public/debrief.php\">\n";
		echo "\t\t\tComptes-rendus\n";
		echo "\t\t</a>\n";
		
		echo "\t\t<a href=\"../public/projet.php\">\n";
		echo "\t\t\tProjets\n";
		echo "\t\t</a>\n";
		
		echo "\t\t<a href=\"../public/laval.php\">\n";
		echo "\t\t\tLaval\n";
		echo "\t\t</a>\n";
		
		echo "\t\t<a href=\"../public/ressources.php\">\n";
		echo "\t\t\tRessources\n";
		echo "\t\t</a>\n";
		
		
		
		if(isset($_SESSION['pseudo'])){ //Si connecté, affiche un lien vers la page d'administration
		    echo "\t\t<a href=\"../private/admin.php\"><div>\n";
		    echo "\t\t\tAdministration\n";
		    echo "\t\t</div></a>\n";
		}
		
		
		
		
		//echo "\t\t<div>\n";
		//echo "\t\t\t<a href=\"exercices.php\">Exercices</a>\n";
		//echo "\t\t</div>\n";
		
		
		
		echo "\t</div>\n";
		echo "</header>\n";
	}
?>