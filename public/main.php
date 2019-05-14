<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8" />
		<title>Bakanim' - Accueil</title>
		<link rel="stylesheet" href="main.css" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
	<div class="header">
		<div class="cover"></div>
		<div class="navbar">
			<a href="main.php">Accueil</a>
				<a href="404.html">News</a>
				<div class="dropdown">
					<button class="dropbtn">Programme
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="404.html">Exposants</a>
						<a href="404.html">Scènes</a>
                        <a href="404.html">Nocturne</a>
                        <a href="404.html">Concours cosplay</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Info Pratiques
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="404.html">Plan de la convention</a>
						<a href="404.html">Accès</a>
						<a href="404.html">Consignes</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Photos
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="404.html">Bakanim' 2019</a>
						<a href="404.html">Éditions précédentes</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Nos partenaires
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
                        <a href="http://www.ensiie.fr">ENSIIE</a>
                        <a href="http://www.evry.fr">Ville d'Evry</a>
                        <a href="http://bde.iiens.net">BDE ENSIIE</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn"><?php
											if (isset($_SESSION['pseudo'])){
												echo 'Connecté';
											}
											else {
												echo 'Connexion';
											}?>
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<?php 
						if (isset($_SESSION['pseudo'])){
							print $_SESSION['pseudo'];
							print "<a href=\"deconnexion.php\">Se déconnecter</a>";
							if (isset($_SESSION['admin'])){
								print "<a href=\"profil2.php\">Mon Profil</a>";
							}
							else{
								print "<a href=\"profil.php\">Mon Profil</a>";
							}
						}
						else {
							print "<a href=\"bc2.php\">Se Connecter</a>";
							print "<a href=\"f_inscription.php\">S'inscrire</a>";
						}
						?>
                        <!--<a href="bc2.php">Se Connecter</a>
                        <a href="f_inscription.php">S'inscrire</a>-->
					</div>
				</div>
		</div> 
	</div>

	<div class="row" style="background-color:#bbb;">
		<div class="column side" id="left_col"><img src="pictures/right_banner.jpg" alt="bannière droite">
		</div> <!--- 521x1406 ---->
	
		<div class="column middle">
			<h1></h1>
			<div class="intro">
				<div class="chibi"><img src="pictures/baka_chibi.png" alt="baka-chan chibi"></div>
				<div class="presentation">Salutations !<br/><br/>
					Bienvenue sur le site de la Bakanim, la convention autour de la culture japonaise organisée par les étudiants de l'ENSIIE ! 
				</div>
			</div>
			<br/>
			<br/>
			<div class="news">
				<div class="article">
				
				<div class="article_header">Quelques liens utiles...</div>
					<br/>
						<div class="links">
							  <a href="https://www.facebook.com/bakanim.convention">
								<div class="thumbnail">
								<img src="pictures/facebook.png">
								</div>
								<div class="desc">
								Facebook
								</div>
							  </a>
						</div>
						
						<div class="links">
							  <a href="https://twitter.com/bakanim_conv/">
								<div class="thumbnail">
								<img src="pictures/twitter.png">
								</div>
								<div class="desc">
								Twitter
								</div>
							  </a>
						</div>
						
						<div class="links">
							  <a href="https://www.youtube.com/channel/UCVFVOGldN1w5rlIXy7n9vhA">
								<div class="thumbnail">
								<img src="pictures/youtube.png">
								</div>
								<div class="desc">
								YouTube
								</div>
							  </a>
						</div>
					
				</div>
				
				
			</div>
		</div>
			
		<div class="column side" id="right_col"><img src="pictures/left_banner.png" alt="bannière gauche">
		</div>
	</div>

	
    </body>
</html>

