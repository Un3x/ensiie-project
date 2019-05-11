<?php
	/*
	require '../vendor/autoload.php';
	require '../src/model/course/CourseManager.php';

	//postgres
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


	$CourseManager = new \City\CityManager($connection);

	$course = $CourseManager->searchCourses();
	*/

	$course = ['carrierId' => $_POST['carrierId'], 'price' => 20, 'departureId' => 2373465, 'arrivalId' => 686326, 'idCourse' => 63958462529];
	$carrier = ['name' => "aa"];
	$departure = ['cityName' => $_POST['departure'], 'latitude' => 49.420318, 'longitude' => 8.687872];
	$arrival = ['cityName' => $_POST['arrival'], 'latitude' => 49.41461, 'longitude' => 8.681495];
	$user = ['numCard' => "0123XXXXXXXXXX56"];

	if(false && !(isset($_SESSION['id_utilisateur']) && $_SESSION['id_utilisateur'])){
		require("../src/View/connexionView.php");
	}
	else if($course != null){

		$name=$carrier['name'];
		$price=$course['price'];
		$departureName=$departure['cityName'];
		$arrivalName=$arrival['cityName'];
		$idCourse=$course['idCourse'];
		$numCard = $user['numCard'];
		#$numCard = null;

		require('../src/View/course/paymentView.php');
	}
	else{
		$content = "trajet non trouvé";
		require('../src/View/template.php');
	}
