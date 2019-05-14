<?php
	session_start();
	require ('../database_access.php');
	header( 'content-type: text/html; charset=utf-8' );
	
	$pseudo = $_SESSION['name'];
	
	if($pseudo == "DonaldTrump"){
		
		$users = getAllUsers();
	
		
		
		echo "
			<script>
				$(document).on('click', '#bigredbutton', function (){
						$.post(\"php_script/pressTheBigRedButton.php\");
					});
			</script>
			<h2 class = \"brown_2\">Mes super droits admin</h2>
			<h2 class = \"grey\">Liste des utilisateurs</h2>";
			
			foreach ($users as $value){
			$user = $value['pseudo'];
			echo "<p class = \"grey\">$user</p>";
		}
			echo"
				
				<button id = \"bigredbutton\" class = \"logout_button\">Tout effacer</button>
			
		";
		
		
	}
	
?>