<?php
	header( 'content-type: text/html; charset=utf-8' );
	/*Print functions for the header and footer*/
	function printHeader(){
		echo "<header>
			<a href = \"php_accueil.php\">
			<img class = \"logo\" src = \"logo_site.png\" alt = \"le logo du site (My New LIIfE)\" /></a>
		</header>";
	}
	
	function printFooter(){
		echo "<footer> 
				<p>temp</p>
			</footer>";
	}
	
	/*Print functions for the sidebar. Different outcomes depending on if the user logged in or not*/
	function printSidebar(){
		if(isset($_SESSION["name"])){
			printSidebarLogIn();
		}
		else{
			printSidebarLogOut();
		}
	}
	
	function printSidebarLogIn(){
		echo "
			<aside id = \"side_bar\" class = \"round_rect\"> <!-- Bloc de droite. Contient le panthéon.-->
				<div class = \"profile_summary\">
					<span style = \"font-size: 3em; margin: auto;\" class = \"orange\">".$_SESSION['name']."</span>
					<a class = \"grey\" style = \"align-self: center;\" href = \"profil.php\">Mon profil</a>
					<button type=\"button\" class = \"logout_button\" onclick=\"window.location.href = 'logout.php';\">Deconnexion</button>
				</div>
		";
		printPantheon();
		echo "</aside>";
	}
	
	function printSidebarLogOut(){
		echo "<aside id = \"side_bar\" class = \"round_rect\"> <!-- Bloc de droite. Contient le panthéon.-->
				
				<div id = \"login_form\">
					<form action = \"login.php\" target = \"_self\" method = \"post\">
						<div class = \"champs\">
							<input type = \"text\" name = \"pseudo\" value = \"Pseudo\">
							<input type = \"password\" name = \"password\" value = \"superbigpassword\">
						</div>
						<div class = \"submit\">
							<input type = \"submit\" value = \"Connexion\">
						</div>
					</form>
				</div>";
		printPantheon();
		echo "</aside>";
	}
	
	function printPantheon(){
		echo "
				<div id = \"pantheon\">
					
					<h1 class = \"grey\">Ils ont fini leur 1A...</h1>
					<img src=\"stroke.png\" />
					
					<div class = \"end_show\" id = \"bg1\">
						<h2>Pseudo 1</h2>
						<p class = \"grey\">Bla bla, c'est vraiment incroyable ce qu'il s'est passé !</p>
					</div>
					<div class = \"end_show\" id = \"bg2\">
						<h2>Pseudo 2</h2>
						<p class = \"grey\">Bla bla, c'est vraiment incroyable ce qu'il s'est passé !</p>
					</div>
					<div class = \"end_show\" id = \"bg3\">
						<h2>Pseudo 3</h2>
						<p class = \"grey\">Bla bla, c'est vraiment incroyable ce qu'il s'est passé !</p>
					</div>
					<div class = \"end_show\" id = \"bg4\">
						<h2>Pseudo 4</h2>
						<p class = \"grey\">Bla bla, c'est vraiment incroyable ce qu'il s'est passé !</p>
					</div>
				</div>
		";
		
	}
	
	/*Print functions for the main content div. Different outcomes depending on if the user logged in or not*/
	
	function printMain(){
		if(isset ($_SESSION["name"])){
			printMainLogIn();
		}
		else{
			printMainLogOut();
		}
	}
	
	function printMainLogOut(){
		echo "
			<div id = \"content\" class = \"round_rect\"> 
				
				<div id = \"main_header\">
					<p>
						<span class = \"brown\"><span style = \"font-family: iLoveGlitter;\">Vis ou revis</span></span> <br /> 
						<span class = \"orange\"><span style = \"font-family:amavos\">ta 1A a l<span style = \"font-family:sans-serif\">'</span>ENSIIE </span> <span style = \"font-family:amavos\"><span style = \"font-family:sans-serif\">!</span></span>
					</p>
				</div>
				
				<div id = \"teaser\">
				
					<aside class = \"tease_rect\">
						<p>Visuel trop cool pour donner envie aux gens</p>
					</aside>
					<aside class = \"tease_rect\">
						<p>Texte trop cool pour donner envie aux gens</p>
					</aside>
					
				</div>
				
				<div id = \"character_choice\">
					<div class = \"placeholder\">
						<p>Female protagonist</p>
					</div>
					<div class = \"placeholder\">
						<p>NB protagonist</p>
					</div>
					<div class = \"placeholder\">
						<p>Male protagonist</p>
					</div>
				</div>
				<div id = \"suscribe_button\" onclick = \"window.location.replace('inscription.php');\">
					<img src = \"stroke.png\" />
					<p> <span class = \"orange\" style = \"font-size: 3em;\">En avant</span><br /> 
					<span class = \"grey\" style = \"font-size: 1.8em;\">Commencer l'aventure</span></p>
					<img src=\"stroke.png\" />
				</div>
			</div>
		";
	}
	
	function printMainLogIn(){
		echo "<div id = \"content\" class = \"round_rect\">
		
				<div id = \"main\">
					<aside id = \"protag_preview\">
						<p>Protagonist placeholder</p>
					</aside>
					<div id = \"sumup\">
						<h1 class = \"grey\">Ma dernière fin</h1>
						<img src = \"stroke.png\" />
							
						<h1 class = \"grey\">Mon dernier achievement</h1>
						<img src = \"stroke.png\" />					
					</div>
				</div>
				
				<div id = \"suscribe_button\">
					<img src=\"stroke.png\" />
					<p> <span class = \"orange\" style = \"font-size: 3em;\">Y retourner</span><br /> 
					<span class = \"grey\" style = \"font-size: 1.8em;\">Continue l'aventure !</span></p>
					<img src=\"stroke.png\" />
				</div>
			</div>
		";
	}
	

	
	function logOut(){
		session_destroy();
		/*echo " <div class = \"round_rect\" style = \"padding: 20px;\">
			<p class = \"grey\"> Déconnexion réussie ! Cliquez <a href = \"php_accueil.php\">ici</a> pour revenir à la page d'accueil </p>
			<script>
				window.location.replace(\"php_accueil.php\");
			</script>
		</div>";*/
		echo "<script>
				window.location.replace(\"php_accueil.php\");
			</script>";
	}
	
	function printGame(){
		echo "
			<div id = \"visuel\">
						
			</div>
					
			<div id = \"choices\">
						<!-- Choices button will be displayed here -->
			</div>
		";
	}
	
	function printStoryChoice(){
		echo "	<h1 class = \"brown\">Nouvelle histoire</h1>
				
				</p>
				<div id = \"new_stories\">
					<div class = \"story\">
						<div class = \"content\">
							<h1 class = \"brown\">Tutoriel</h1>
							<div class = \"desc\"><p class = \"grey\">Bonjour ceci est un paragraphe relativement 
							long afin de tester la feature en question.</p>
							<button class = \"logout_button\" onclick=\"initNewStory(1)\">Jouer</button>
							</div>
							
						</div>						
					</div>
					<div class = \"story\">
						<div class = \"content\">
							<h1 class = \"brown\">Integration</h1>
							<div class = \"desc\"><p class = \"grey\">Bonjour ceci est un paragraphe relativement 
							long afin de tester la feature en question.</p>
							<button class = \"logout_button\">Jouer</button>
							</div>
							
						</div>						
					</div>
				</div>
		
		";
		
		
	}
	
