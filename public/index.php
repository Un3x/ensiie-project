<?php
  require ('print_functions.php');

	// Create connection
	$conn = new PDO("pgsql:host=postgres dbname=ensiie user=ensiie password=ensiie");

	// Check connection
	if (!$conn) {
		die("Connection failed: " . $conn->connect_error);
	}
	echo "Connected successfully";

echo "<!DOCTYPE html>
<html>
<head>
  <title>Accueil - Test php</title>
  <meta-charset = \"utf-8\"/>
  <link rel = \"stylesheet\" type = \"text/css\" href = \"stylesheet.css\"/>
</head>

<body class = \"bg\">";
  printHeader();

  echo "<main>";
    #checkLogin();
    printMain();
    printSidebar();
  echo "</main>";

  printFooter();
echo "</body></html>";
