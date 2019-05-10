<?php
	/*
	require '../vendor/autoload.php';
	require '../src/model/course/CourseManager.php';

	//GETgres
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


	$CourseManager = new \City\CityManager($connection);

	$courses = $CourseManager->searchCourses();
	*/

	if ((isset($_GET['departure']) && isset($_GET['arrival']) && isset($_GET['date']) && isset($_GET['time']) && isset($_GET['carrierId'])) || isset($_GET['courseId'])){
	
		if (isset($_GET['courseId'])){

			$course = ['carrierId' => 867464836422684, 'date' => "25-06-2019", 'price' => 20, 'departureId' => 2373465, 'departureTime' => "15-48", 'arrivalId' => 686326, 'arrivalTime' => "17-23", 'courseId' => $_GET['courseId']];
			$carrier = ['name' => "aa"];
			$departure = ['cityName' => "Paris", 'latitude' => 49.420318, 'longitude' => 8.687872];
			$arrival = ['cityName' => "Évry", 'latitude' => 49.41461, 'longitude' => 8.681495];
			$courseId = $course['courseId'];
			$courseStatus = "booked";

			$found = true;
			$userType = "carrier";
		}
		else{
			$course = ['carrierId' => $_GET['carrierId'], 'date' => $_GET['date'], 'price' => 20, 'departureId' => 2373465, 'departureTime' => "15-48", 'arrivalId' => 686326, 'arrivalTime' => "17-23", 'idCourse' => 63958462529];
			$carrier = ['name' => "aa"];
			$departure = ['cityName' => $_GET['departure'], 'latitude' => 49.420318, 'longitude' => 8.687872];
			$arrival = ['cityName' => $_GET['arrival'], 'latitude' => 49.41461, 'longitude' => 8.681495];

			$found = true;
			$userType = null;
		}

		if($found){

			$date=$course['date'];
			$name=$carrier['name'];
			$carrierId=$course['carrierId'];
			$price=$course['price'];
			$departureName=$departure['cityName'];
			$departureTime=$course['departureTime'];
			$arrivalName=$arrival['cityName'];
			$arrivalTime=$course['arrivalTime'];

			$key = "5b3ce3597851110001cf6248c6e87f2691cf4b8aad0d91e3fa3f3de1";
			$departureLat = $departure['latitude'];
			$departureLong = $departure['longitude'];
			$arrivalLat = $arrival['latitude'];
			$arrivalLong = $arrival['longitude'];

			require('../src/View/course/infoCourseView.php');
		}
		else{
			$content = "Ce trajet n'existe pas";
			require('../src/View/template.php');
		}
	}
	else{
		$content = "Ce trajet n'existe pas";
		require('../src/View/template.php');
	}