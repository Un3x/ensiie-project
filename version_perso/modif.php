<?php 
	session_start();
	require ('print_functions.php');
	require ('database_access.php');
	
	$newGender = $_POST['gender'];
	updateUserGender($newGender);
	
	echo "
		<script>
				window.location.replace(\"profil.php\");
			</script>
	";
	
?>
