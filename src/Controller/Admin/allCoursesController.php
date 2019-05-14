<?php

require_once("../src/Model/Course/CourseManager.php");
require_once("../src/Model/City/CityManager.class.php");
require_once("../src/Model/User/VendorManager.class.php");
require_once("../src/Model/User/ClientManager.class.php");

$bdd = bdd();
$courseManager = new CourseManager($bdd);



$mesCourses = $courseManager->fetchAllCoursesAll();

//print_r($mesCourses);

$cityManager = new CityManager($bdd);
$vendorManager = new VendorManager($bdd);
$clientManager = new ClientManager($bdd);

require("../src/View/Admin/coursesView.php");