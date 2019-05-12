<?php

$departure = ['cityName' => $_POST['departure'], 'latitude' => 49.420318, 'longitude' => 8.687872];
$arrival = ['cityName' => $_POST['arrival'], 'latitude' => 49.41461, 'longitude' => 8.681495];
$user = ['numCard' => "0123XXXXXXXXXX56"];

if(!$GLOBALS['user']){
	header('Location: /connexion');
}
else{

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
		$numCard = $user['numCard'];
		$duration=$course['duration'];
		$distance=$course['distance'];
		#$numCard = null;

		require('../src/View/course/paymentView.php');
	}
	else{
		$content = "trajet non trouvé";
		require('../src/View/template.php');
	}
}
