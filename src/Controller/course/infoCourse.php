<?php
	
if ((isset($_GET['departure']) && isset($_GET['arrival']) && isset($_GET['carrierId'])) || isset($_GET['courseId'])){

	require '../vendor/autoload.php';
	require '../src/Model/Course/CourseManager.php';

	//GETgres
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

	$CourseManager = new CourseManager($connection);

	if (isset($_GET['courseId'])){


		$userType = "carrier";

		$course = $CourseManager->getCourse($_GET['courseId']);

		if ($course){
			$courseId=$_GET['courseId'];
			$departureName=$course['departure'];
			$arrivalName=$course['arrival'];
			$courseStatus=$course['state'];


			if ($userType == "carrier") $name=$course["carrierFirstname"].' '.$course["carrierSurname"];
			else $name=$course["clientFirstname"].' '.$course["clientSurname"];

			$found = true;
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

		$departureLat = $course['departureLat'];
		$departureLong = $course['departureLong'];
		$arrivalLat = $course['arrivalLat'];
		$arrivalLong = $course['arrivalLong'];

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