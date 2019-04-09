<?php include ('view.php'); ?>

<html>
	<head>
		<meta charset="utf-8">
		<?php my_head(); ?>
	</head>

	<body>
		<?php header_login(); ?>
		<div class="flex-container" id="login-content">
			<div style="margin-right:20px">
			Sign In
			<form action="compte.php" method="post">
				<input type="text" name="login" placeholder="mail"></br>
				<input type="password" name="password" placeholder="mot de passe"></br>
				<button class="bouton" type="submit" style="margin-top:8px">envoyer</button>
			</form>
			</div>
			<div>
			Sign Up
			<form action="compte.php" method="post">
				<input type="text" required="true" name="firstname" placeholder="Prénom (*)"></br>
				<input type="text" required="true" name="lastname" placeholder="Nom (*)"></br>
				<input type="email" required="true" name="mail" placeholder="email (*)"></br>
				<input type="password" required="true" name="password" placeholder="mot de passe (*)"></br>
				<input type="date" name="birthday"></br>
				<input type="text" name="city" placeholder="Ville"></br>
				<input type="number" min="0" name="yop" placeholder="années d'expériences"></br>
				<input type="tel" name="phone" pattern="[0-9]{10}" placeholder="tel : 0123456789"></br>
				<button class="bouton" type="submit" style="margin-top:8px">envoyer</button>
			</form>
			</div>
		</div>

	<footer>
		<?php include ('footer.php'); footer();?>
	</footer>
	</body>
</html>
