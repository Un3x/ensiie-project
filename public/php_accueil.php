<?php
	session_start();
require ('include.php');
echo '<!DOCTYPE html>
<html>
<head>
<title>Accueil - Test php</title>
<meta-charset = "utf-8"/>
<link rel = "stylesheet" type = "text/css" href = "stylesheet.css"/>
</head>
<body class = "bg">';
printHeader();
echo '<main>';
printMain();
printSidebar();
echo '<a href = "jeu.php"> JEU </a></main>';
printFooter();
echo '</body></html>';
