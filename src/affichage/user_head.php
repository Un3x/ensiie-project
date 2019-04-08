<?php   

function enTete($titre)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel=\"stylesheet\" type=\"text/css\" href=\"user_head.css\"/>\n";
    print "    <link rel=\"stylesheet\" type=\"text/css\" href=\"signin.css\"/>\n";
    //print "    <link rel=\"stylesheet\" type=\"text/css\" href=\"carroussel.css\"/>\n";
    print "  </head>\n";
  
    print "  <body>\n";
    print "    <header><h1> $titre </h1></header>\n";
}

function pied(){
        print "</body>";
        print "</html>";
}



function aside(){
    
}

function navigation(){
    echo '
    <nav>
            <a href="index.php"> Home </a>
            <a href="cat1.php"> Cat_1 </a>
            <a href="cat2.php"> Cat_2 </a>
            <a href="cat3.php"> Cat_3 </a>
            <a href="contact.php"> Contact </a>
            <a href="aboutus.php"> About Us </a>
            <button onclick="document.getElementById(\'id01\').style.display=\'block\'" style="width:auto;">Login</button>
    </nav>
    ';
}



?>
