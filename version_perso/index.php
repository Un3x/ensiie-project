<?php
	session_start();
	$servername = "perso.iiens.net";
	$username = "e_hovi2018";
	$password = "8ZgW1XnSSppPxKaHLNqBIxXpdxzOPg";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";
?>

<!DOCTYPE html>
<?php require ('print_functions.php');?>

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
