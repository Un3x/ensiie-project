<header>
	<div id="entete">
		<a href="index.html" alt="logoCCE"><img src="images/header.png" class="logo" /></a>
		
		<?php
			if (!isset($_SESSION['login']) && !isset($_SESSION['pwd'])) echo '<h3 class="connexion"> <a href="login.php" >Connexion</a></h3>';
			else echo '<h3 class="connexion"> <a href="logout.php" > Se deconnecter </a></h3>';
		?>

		<h1 class="title"><br/>Challenge Centrale Evry</h1>

	</div>
</header>