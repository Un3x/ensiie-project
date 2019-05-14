<?php
	session_start();
?>

<!DOCTYPE html>
<?php require ('print_functions.php');
	require('database_access.php');
?>

<html>

	<head>
		<title>My New LIIfE</title>
		<meta-charset = "utf-8"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="game_functions.js"></script>
		<link rel = "stylesheet" type = "text/css" href = "stylesheet.css"/>
		<link rel = "stylesheet" type = "text/css" href = "game_style.css"/>
		<link href="https://fonts.googleapis.com/css?family=Just+Another+Hand" rel="stylesheet">
	
		<script>
			
				$(document).ready(function(){
					
					$.post("php_script/checkHasStory.php", function(hasStory){
						$.post("php_script/printGame.php", 
							{story: hasStory},
							function(content){
								$("#game").append(content);
								if(hasStory == 1){
									actualizeFront();
								}
							});
					});
					$(document).on('click', '.choice', function (e){
						e.preventDefault(); //stop default behaviour
						actualizeBack(this);
					});
					$(document).on('click', '#end_button', function (e){
						e.preventDefault();
						printEnd();
					});
					
				}); 
		
		</script>
		
	</head>
	
	
				
	<body class = "bg">
	
	
		
		<?php 
			printHeader();
		?>
		
		<main>
			
			<div id = "side_info" class = "round_rect">
					<button class = "logout_button" onclick="window.location.href = 'logout.php';">Deconnexion</button>
					<img src = "stroke.png" />
					<img src = "Visuels/protag_chan.png" />
					
					<div id = "stats">
						<h1 class  = "orange">Mes Stats</h1>
						<div class = "progress_bar">
							<div id = "diese" class = "progress_bar_content"></div>
						</div>
						<div class = "progress_bar">
							<div id = "baka" class = "progress_bar_content"></div>
						</div>
						<div class = "progress_bar">
							<div id = "bar" class = "progress_bar_content"></div>
						</div>
					</div>
					
					<div id = "joined_assos">
						<div class = "is_asso">
							<img id = "is_bar" src = "Visuels/is_bar.png" />
						</div>
						<div class = "is_asso">
							<img id = "is_baka" src = "Visuels/is_baka.png" />
						</div>
						<div class = "is_asso">
							<img id = "is_diese" src = "Visuels/is_diese.png" />
						</div>
					</div>
			</div>
			
			<div id = "game" class = "round_rect">
				<div id = "game_profile">
					<p> <span class = "orange"><?php echo $_SESSION['name'] ?></span> <br /> 
					<a class = "grey" href = "profil.php" >Mon profil</span></a>
					<img src = "stroke.png" />
				</div>				
				
			</div>
			
			
			
		</main>
		
		<?php
			printFooter();
		?>
		
		<div id = "popup">
			<div class = "round_rect" id = "popup_body">
				<h1 class = "grey">Nouveau haut-fait !</h1>
				<div class = "ach_info">
					<div class = "visuel_ach">
						<img id = "ach_icon" src = ""/>
					</div>
					<div class = "info_ach">
						<p> <span class = "brown" id = "ach_title"></span> <span class = "grey" id = "ach_desc"></span></p>
					</div>
				</div>				
				<button class = "logout_button" onclick = "hidePopup()">Ok !</button>
			</div>			
		</div>
		
	</body>

</html>