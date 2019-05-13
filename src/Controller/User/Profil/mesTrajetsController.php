<?php

require_once("../src/Model/Course/CourseManager.php");
require_once("../src/Model/City/CityManager.class.php");
$bdd = bdd();
$courseManager = new CourseManager($bdd);

if($_SESSION['userType']=="Client") $mesCourses = $courseManager->getCourseClient($_SESSION['userId']);
if($_SESSION['userType']=="Vendor") $mesCourses = $courseManager->getCourseCarrier($_SESSION['userId']);

print_r($mesCourses);
$cityManager = new CityManager($bdd);
$vendorManager = new VendorManager($bdd);
require("../src/View/User/Profil/mesTrajetsView.php");