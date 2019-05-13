<?php
	
if ((isset($_GET['departure']) && isset($_GET['arrival']) && isset($_GET['carrierId'])) || isset($_GET['courseId'])){

	require '../vendor/autoload.php';
	require '../src/Model/Course/CourseManager.php';

	$connection = bdd();
	$CourseManager = new CourseManager($connection);

	if (isset($_GET['courseId'])){

		if(!$GLOBALS['user']){
			header('Location: /connexion');
		}

		$userType = $_SESSION['userType'];

		$course = $CourseManager->getCourse($_GET['courseId']);

		if ($course){
			$courseId=$_GET['courseId'];
			$departureName=$course['departure'];
			$arrivalName=$course['arrival'];
			$courseStatus=$course['state'];


			if ($userType == "Vendor") $name=$course["carrierFirstname"].' '.$course["carrierSurname"];
			else $name=$course["clientFirstname"].' '.$course["clientSurname"];

			$found = $_SESSION['userId']==$course['carrierId'] || $_SESSION['userId']==$course['clientId'];
		}
		else{
			$found=false;
		}
	}
	else{

		$course = $CourseManager->fetchThisCourse($_GET['departure'],$_GET['arrival'],$_GET['carrierId']);

		if ($course){
			$departureName=$_GET['departure'];
			$arrivalName=$_GET['arrival'];
			$name=$course["firstname"].' '.$course["surname"];

			$found = true;
			$userType = null;
		}
		else{
			$found=false;
		}
	}

	if($found){

		$carrierId=$course['carrierId'];
		$price=$course['price'];
		$duration=$course['duration'];
		$distance=$course['distance'];

		$departureLat = $course['departureLat'];
		$departureLong = $course['departureLong'];
		$arrivalLat = $course['arrivalLat'];
		$arrivalLong = $course['arrivalLong'];

		require('../src/View/course/infoCourseView.php');
	}
	else{
		$title="trajet non trouvé";
		$content = "Ce trajet n'existe pas";
		require('../src/View/template.php');
	}
}
else{
	$title="trajet non trouvé";
	$content = "Ce trajet n'existe pas";
	require('../src/View/template.php');
}