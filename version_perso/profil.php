<?php
	session_start();
	
?>

<!DOCTYPE html>
<?php require ('print_functions.php');
	  require ('database_access.php');
	  
?>

<html>

	<head>
		<title>Mon profil</title>
		<meta-charset = "utf-8"/>
		<link rel = "stylesheet" type = "text/css" href = "stylesheet.css"/>
		<link rel = "stylesheet" type = "text/css" href = "game_style.css"/>
		<link rel = "stylesheet" type = "text/css" href = "profile_style.css"/>
		<link href="https://fonts.googleapis.com/css?family=Just+Another+Hand" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="game_functions.js"></script>
		
		<script>
		$(document).ready(function(){
				$.post("php_script/getAdminRights.php", function(result){
					if(result != ""){
						$("#zone_51").html(result, function(){
							// $("#zone_51").append(
							
						});
					}
				});
			}); 
		
		
		
		</script>
	</head>
	
	<body class = "bg">
		<?php 
			printHeader();
			
		?>
		
		<main>
			<div class = "round_rect" id = "profile_main">
				<h1 class = "brown">Mon profil</h1>
				<div class = "pouet">
					<div class = "protag">
						<img src = "Visuels/protag_chan.png"/>
					</div>
					<div class = "profile_content">
						<div class = "top_row">
							<div class = "profile_info">
								
								<div class = "info">
									<?php
										$info = getUserInfo();
										if($info['gender'] == "f"){
											$gender = "♀";
										}
										else if($info['gender'] == "m"){
											$gender = "♂";
										}
										else $gender = $info['gender'];
										echo "<p>
											<span class = \"grey\">Pseudo : " . $_SESSION['name'] . "
											</span>
										</p>
											
										<p><span class = \"grey\">Genre : $gender </span></p>
										<p><span class = \"grey\">Date d'inscription : </span> </p>
										<p><span class = \"grey\">Histoires completées : " . $info['nb'] . " </span></p>";
									?>
									<button class = "logout_button" onclick = "showPopup()">Modifier</button>
								</div>
							</div>
							<div class = "contains_achievements">
								<h2 class = "grey">Mes haut-faits</h2>
								<div class = "achievements">
									<div class = "achievements_placeholder">
									</div>
									<div class = "achievements_placeholder">
									</div>
									<div class = "achievements_placeholder">
									</div>
									<div class = "achievements_placeholder">
									</div>
									<div class = "achievements_placeholder">
									</div>
									<div class = "achievements_placeholder">
									</div>
									<div class = "achievements_placeholder">
									</div>
								</div>
							</div>					
						</div>
						<div class = "stories_info">
							<h2 class = "grey">Mes histoires finies</h2>
							<div class = "finished_story">
								<div class = "story_info">
								</div>
								<div class = "story_stats">
								</div>
							</div>
						</div>
						
						<div id = "zone_51">
							
						</div>					
						<?php
							if(isset($_POST['submit'])){
								echo "COUCOU";
							}
						?>
					</div>
				</div>
				
			</div>
			
			
		</main>
		
		
		<?php
			printFooter();
		?>
		
		<div id = "popup">
			<div class = "round_rect" id = "popup_body">
				<h1 class = "brown">Modifier mes informations</h1>
					<div id = "modif_form">
						<div class = "left_form">
							<p class = "grey">Genre : </p>
						</div>
						<div class = "right_form">
							<form action = "modif.php" target = "_self" method = "post">
								<div>
									<input type="radio" name="gender" value="m" checked><span class = "grey">Homme</span><br />
									<input type="radio" name="gender" value="f"> <span class = "grey">Femme</span><br />
									<input type="radio" name="gender" value="Non-binaire"> <span class = "grey">Non-binaire</span> <br />
									
								</div>
									<input type = "submit" value = "Valider" class = "logout_button"/>
								<div>
								</div>
							</form>
						</div>
					</div>
				<div class = "choice_buttons">
				<button class = "logout_button" onclick = "hidePopup()">Annuler</button>
				</div>	
			</div>
		</div>
	
	</body>

</html>