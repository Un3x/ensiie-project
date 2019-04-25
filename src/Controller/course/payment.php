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

	$courses = $CourseManager->searchCourses();
	*/

	$date=$_POST['date'];
	$name="aa";
	$price=20;
	$departure=$_POST['departure'];
	$departureTime="15-48";
	$arrival=$_POST['arrival'];
	$arrivalTime="17-23";
	$idCourse = 63958462529;

	require('../src/View/course/paymentView.php');








