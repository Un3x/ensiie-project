<?php
	session_start();
?>

<!DOCTYPE html>
<?php require ('print_functions.php');
?>

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
				printMain();
				printSidebar();
			?>
			<a href = "jeu.php"> JEU </a>
		</main>
		
		<?php
			printFooter();
		?>
	</body>

</html>
