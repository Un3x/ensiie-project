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

	$course = ['carrierId' => $_POST['carrierId'], 'date' => $_POST['date'], 'price' => 20, 'departureId' => 2373465, 'departureTime' => "15-48", 'arrivalId' => 686326, 'arrivalTime' => "17-23", 'idCourse' => 63958462529];
	$carrier = ['name' => "aa"];
	$departure = ['cityName' => $_POST['departure'], 'latitude' => 49.420318, 'longitude' => 8.687872];
	$arrival = ['cityName' => $_POST['arrival'], 'latitude' => 49.41461, 'longitude' => 8.681495];


	if($course != null){

		$date=$course['date'];
		$name=$carrier['name'];
		$price=$course['price'];
		$departureName=$departure['cityName'];
		$departureTime=$course['departureTime'];
		$arrivalName=$arrival['cityName'];
		$arrivalTime=$course['arrivalTime'];
		$idCourse=$course['idCourse'];

		require('../src/View/course/paymentView.php');
	}
	else{
		$content = "trajet non trouvé";
		require('../src/View/template.php');
	}
