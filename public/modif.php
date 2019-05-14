<?php
	session_start();
	require ('include.php');
	$newGender = $_POST['gender'];
	updateUserGender($newGender);
	echo "
		<script>
				window.location.replace(\"profil.php\");
			</script>
	";
