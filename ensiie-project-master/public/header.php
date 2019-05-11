<header>
	<div id="entete">
		<a href="index.html" alt="logoCCE"><img src="images/header.png" class="logo" /></a>
		
		<?php
			if (!isset($_SESSION['login']) && !isset($_SESSION['pwd'])) {
				echo '<h4 class="connexion"> <a href="login.php" >Connexion</a>
				<br/>
				<a href="register.php" > Inscription </a></h4>';;
			}
			else {
				echo '<h4 class="connexion"> <a href="logout.php" > Se deconnecter </a>
				<br/>
				<a href="your_account.php" > Votre compte </a>';
				if (isset($_SESSION['type']) && $_SESSION['type'] == "Organisateur") {
					echo '<br/><a href="modify_other.php" > Modifier un autre compte </a>';
				}
				echo '</h4>';
			}
		?>

		<h1 class="title"><br/>Challenge Centrale Evry</h1>

	</div>
</header>