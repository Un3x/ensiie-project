<?php
require ('print_functions.php');
session_start();
echo "<!DOCTYPE html>";
echo "<html>";

# le header
echo '<head><title>Accueil - Test php</title><meta-charset = "utf-8"/><link rel = "stylesheet" type = "text/css" href = "stylesheet.css"/><link rel = "stylesheet" type = "text/css" href = "stylesheet2.css"/></head>';

# le body
echo '<body class = "bg">';
printHeader();

echo '<main>';
checkLogin();
printMain();
printSidebar();
echo '</main>';

printFooter();
echo '</body></html>';
