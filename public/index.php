<?php
	session_start();
?>

<!DOCTYPE html>
<?php require ('print_functions.php');?>

<html>

	<head>
		<title>Accueil - Test php</title>
		<meta-charset = "utf-8"/>
		<link rel = "stylesheet" type = "text/css" href = "stylesheet.css"/>
		<link rel = "stylesheet" type = "text/css" href = "stylesheet2.css"/>
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