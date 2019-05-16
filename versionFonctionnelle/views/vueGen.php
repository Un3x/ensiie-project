<?php 
function enTete($titre)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" href=\"../stylesheet.css\"/>\n";
    print "  </head>\n";
  
    print "  <body style=\"background-color:#FFEBCD;\">\n";
}

function pied(){
    print "  </body>\n";
    print "</html>\n";
}

function connecter($pseudo){
	print "<h1 align=\"right\"> $pseudo <a href=\"controllers/deconnexionControlleur.php\"><img border=\"0\" alt=\"image Deconnexion\" src=\"../images/disconnect.png\" width=\"20\" height=\"20\"></a> </h1>";	
}

function accueil(){
	print "<p> Bienvenue sur partIIE, le site qui regroupe tout les events en rapport avec l'école </p>";
	print "<p> Vous souhaitez voir un event en particulier ? Nous vous invitions à cliquer sur evenement</p>";
	print "<p> Envie d'organiser votre event ? Cliquez sur organiser</p>";
	print "<p> Vous n'avez pas encore de compte ? La rubrique s'inscrire est là pour vous </p>";
}
?>
