<?php

$numUserCard = null;

if(!$GLOBALS['user']){
	header('Location: /connexion');
}
else if($_SESSION['userType']!='Client'){
	$title="erreur";
	$content = "Désolé mais ce type de compte ne peut pas faire de réservations";
	require('../src/View/template.php');
}
else if(isset($_POST['departure']) && isset($_POST['arrival']) && isset($_POST['carrierId']) && is_string($_POST['departure']) && is_string($_POST['arrival']) && is_numeric($_POST['carrierId'])){

	try{
		require '../vendor/autoload.php';
		require '../src/Model/Course/CourseManager.php';

		$connection = bdd();

		$CourseManager = new CourseManager($connection);

		$courseId = $CourseManager->preBookCourse($_POST['departure'], $_POST['arrival'], $_POST['carrierId'], $_SESSION['userId']);

		if ($courseId){
			$course = $CourseManager->getCourse($courseId);

			$name=$course['carrierFirstname'].' '.$course['carrierSurname'];
			$price=$course['price'];
			$departureName=$course['departure'];
			$arrivalName=$course['arrival'];
			$idCourse=$courseId;
			$numCard = $numUserCard;
			$duration=$course['duration'];
			$distance=$course['distance'];
			#$numCard = null;

			require('../src/View/course/paymentView.php');
		}
		else{
			$title="trajet non trouvé";
			$content = "trajet non trouvé";
			header("HTTP/1.1 404 Not Found");
			require('../src/View/template.php');
		}
	}
    catch(Exception $e){
        $title="erreur";
        $content = "Une erreur s'est produite, veuillez réessayez ultérieurement";
        header("HTTP/1.1 500 Internal Server Error");
        require('../src/View/template.php');
    }
}
else{
	$title="trajet non trouvé";
	$content = "trajet non trouvé";
	header("HTTP/1.1 400 Bad Request");
	require('../src/View/template.php');
}