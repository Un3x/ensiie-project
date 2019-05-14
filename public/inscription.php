<?php
	session_start();
?>

<!DOCTYPE html>
<?php require ('print_functions.php');
	require('database_access.php');
?>

<html>

	<head>
		<title>Accueil - Test php</title>
		<meta-charset = "utf-8"/>
		<link rel = "stylesheet" type = "text/css" href = "stylesheet.css"/>
		<link rel = "stylesheet" type = "text/css" href = "profile_style.css"/>
		<link rel = "stylesheet" type = "text/css" href = "subscription_style.css"/>
	</head>
	<body class = "bg">
		<?php
			printHeader();
		?>
		<main>
			<div class = "round_rect" id = "subs_body">
				<h1 class = "brown_2">Inscription</h1>
				<form action = "" target = "_self" method = "post">
					<div class = "left_form">
						<p class = "grey">Pseudo</p>
						<p class = "grey">Mot de passe</P>
						<p class = "grey">Confirmation du mot de passe</p>
						<p class = "grey">Genre</p>
						<div class = "submit_button">
						<input type = "submit" name = "submit" value = "Valider" class = "logout_button"/>
					</div>
					</div>
					<div class = "right_form">
						<div class = "champs">
							<input type = "text" name = "pseudo"/><br />
							<input type = "password" name = "password"/><br />
							<input type = "password" name = "password_confirm"/><br />
						</div>
						<div class = "radio_input">
							<input type="radio" name="gender" value="m" checked = "checked"><span class = "grey" >Homme</span>
							<input type="radio" name="gender" value="f"> <span class = "grey">Femme</span>
							<input type="radio" name="gender" value="Non-binaire"> <span class = "grey">Non-binaire</span>
						</div>
					</div>
				</form>
				<div class = "insc_treatment">
					<?php
						if(isset($_POST['submit'])){
							$state = addUser($_POST['pseudo'], $_POST['password'], $_POST['password_confirm'], $_POST['gender']);
							if($state['isValid'] == 1){
								echo "<script>
										window.location.replace(\"php_accueil.php\");
									</script>";
							}
							else{
								$message = $state['message'];
								echo "<p class = \"red\">$message</p>";
							}
						}
					?>
				</div>
			</div>
		</main>
		<?php
			printFooter();
		?>
	</body>

</html>
