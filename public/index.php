<?php
  require ('print_functions.php');
	session_start();

	// Create connection
  $conn = new PDO("pgsql:host=postgres dbname=ensiie user=ensiie password=ensiie");

?>

<!DOCTYPE html>

<html>

	<head>
		<title>Accueil - Test php</title>
		<meta-charset = "utf-8"/>
		<link rel = "stylesheet" type = "text/css" href = "stylesheet.css"/>
	</head>
	<body class = "bg">
		<?php
			printHeader();
		?>
		<main>
			<?php
				checkLogin();
				printMain();
				printSidebar();
			?>
		</main>
		<?php
			printFooter();
		?>
	</body>

</html>
