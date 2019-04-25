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

	$date=$_GET['date'];
	$name="aa";
	$price=20;
	$departure=$_GET['departure'];
	$departureTime="15-48";
	$arrival=$_GET['arrival'];
	$arrivalTime="17-23";

	$key = "5b3ce3597851110001cf6248c6e87f2691cf4b8aad0d91e3fa3f3de1";
	$departureLat = 49.41461;
	$departureLong = 8.681495;
	$arrivalLat = 49.420318;
	$arrivalLong = 8.687872;

	require('../src/View/course/infoCourseView.php');