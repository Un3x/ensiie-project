<?php

/* head plus début du body avec le header*/
function enTete($titre,$css)
{

    print "<!DOCTYPE html>\n";
    print "<html lang=\"fr\">\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/$css.css\">\n";
    print "  </head>\n";
  
    print "  <body>\n";
    print "    <header><h1> $titre </h1>\n";
	print "      <h1>MapChat</h1>\n";
	print "    	 <h3>Le <i>meilleur</i> site de l'internet francophone.</h3>\n";
	print "   	 <br>\n";
	print "	     <div class=\"topnav\">\n";
	print "		   <div class=\"search-container\">\n";
	print "		     <form>\n";
    print "            <input type=\"text\" style=\"width: 400px; padding: 0;\"\n";
	print "		       placeholder=\" Search...\" required>\n";
	print "		       <button type=\"submit\">\n";
	print "		       </button>\n";
	print "			 </form>\n";
	print "        </div>\n";
	print "		 </div>\n";
	print "	   </header>\n";
}

/* termine le body et le domcument html*/
function pied(){
    print "  </body>\n";
    print "</html>";
}


?>
