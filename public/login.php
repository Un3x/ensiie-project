<?php
	session_start();
require ('include.php');
	$isValidUser = checkUser();
	if ($isValidUser){
		echo "<script>
				window.location.replace(\"php_accueil.php\");
			</script>";
	}
	else{
		echo "
			<html>

			<head>
				<title>Connexion</title>
				<meta-charset = \"utf-8\"/>
			<link rel = \"stylesheet\" type = \"text/css\" href = \"stylesheet.css\"/>
			</head>
		<body class = \"bg\">
			<?php
				printHeader();
			?>
			<main>
				<h1>TRUC</h1>
				<?php
				?>
			</main>
			<?php
				printFooter();
			?>
		</body>
		</html>";
	}
