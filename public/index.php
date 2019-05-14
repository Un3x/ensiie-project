<?php
  require ('include.php');
	session_start();

	// Create connection
  $conn = new PDO("pgsql:host=postgres dbname=ensiie user=ensiie password=ensiie");

echo '<!DOCTYPE html>

<html>

<head>
<title>Accueil - Test php</title>
<meta-charset = "utf-8"/>
<link rel = "stylesheet" type = "text/css" href = "stylesheet.css"/>
</head>
<body class = "bg">';
printHeader();
echo '		<main>';
printMain();
printSidebar();
echo '		</main>';
printFooter();
echo '</body>

</html>';
