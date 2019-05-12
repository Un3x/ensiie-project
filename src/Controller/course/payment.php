<?php

$departure = ['cityName' => $_POST['departure'], 'latitude' => 49.420318, 'longitude' => 8.687872];
$arrival = ['cityName' => $_POST['arrival'], 'latitude' => 49.41461, 'longitude' => 8.681495];
$user = ['numCard' => "0123XXXXXXXXXX56"];

if(false && !(isset($_SESSION['id_utilisateur']) && $_SESSION['id_utilisateur'])){
	require("../src/View/connexionView.php");
}
else{

	require '../vendor/autoload.php';
	require '../src/Model/Course/CourseManager.php';

	//postgres
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


	$CourseManager = new CourseManager($connection);

	$courseId = $CourseManager->preBookCourse($_POST['departure'], $_POST['arrival'], $_POST['carrierId'], $_POST['carrierId']);

	if ($courseId){
		$course = $CourseManager->getCourse($courseId);

		$name=$course['carrierFirstname'].' '.$course['carrierSurname'];
		$price=$course['price'];
		$departureName=$course['departure'];
		$arrivalName=$course['arrival'];
		$idCourse=$courseId;
		$numCard = $user['numCard'];
		#$numCard = null;

		require('../src/View/course/paymentView.php');
	}
	else{
		$content = "trajet non trouvé";
		require('../src/View/template.php');
	}
}
