<!DOCTYPE html>

<html>
    <head>
		<meta charset="UTF-8" />
		<title>Bakanim' - Profil</title>
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
					<button class="dropbtn">Connecté
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<?php 
						if (isset($_SESSION['pseudo'])){
							print $_SESSION['pseudo'];
						}
						?>
                        <a href="deconnexion.php">Se déconnecter</a>
                        <a href="profil2.php">Mon profil</a>
					</div>
				</div>
		</div> 
	</div>

	<div class="row" style="background-color:#bbb;">
		<div class="column side" id="left_col"><img src="pictures/right_banner.jpg" alt="bannière droite">
		</div> <!--- 521x1406 ---->
	
		<div class="column middle">
			<h1 class="titre">Page de profil </h1>
			<br/><br/>
            <img src="pictures/profil.png" alt="Photo de profil" class="photoProfil">
			<div class="acceuilProfil"> Bonjour weeb,<br/>
			    Bienvenue sur le site de ton profil !
			</div>
            <br/>
            
			<div class="actionProfil">
				<div class="changement">
					<div class="linksProfil">
					    <a href="changerMotDePasse.php">
							Changer le mot de passe 
						</a>
                    </div>
                       
					<div class="linksProfil">
						<a href="404.html">
                            Changer l'adresse mail (courriel) 
						</a>
                    </div>
                    
					<div class="linksProfil">
						<a href="404.html">
                            Information sur l'utilisation des données 
						</a>
                    </div>
                </div>
                
				
				
                <div class="inscription_bis">
					
					<div class="linksProfil">
						<a href="BDD.php">
                            Base de données des membres
						</a>
                    </div>
                    
					
                    <div class="linksProfil">
                        <a href="inscription_stand.php">
                           S'inscrire en tant que stand 
                        </a>
                    </div>
                    
                    <div class="linksProfil">
                        <a href="404.html">
                        Se désinscrire 
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