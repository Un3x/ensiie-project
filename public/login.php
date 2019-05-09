<?php
session_start();
require ('print_functions.php');
require ('database_access.php');
$isValidUser = checkUser();
if ($isValidUser){
  echo "<script>window.location.replace(\"php_accueil.php\");</script>";
}
else{
  echo "
<html><head><title>Connexion</title>
  <meta-charset = \"utf-8\"/>
  <link rel = \"stylesheet\" type = \"text/css\" href = \"stylesheet.css\"/>
</head>
<body class = \"bg\">";
  printHeader();
  echo "<main><h1>TRUC</h1></main>";
  printFooter();
echo "</body></html>";
}
