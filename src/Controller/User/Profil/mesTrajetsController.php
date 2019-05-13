<?php

require_once("../src/Model/Course/CourseManager.php");
$courseManager = new CourseManager(bdd());

if($_SESSION['userType']=="Client") $mesCourses = $courseManager->getCourseClient($_SESSION['userId']);
if($_SESSION['userType']=="Vendor") $mesCourses = $courseManager->getCourseCarrier($_SESSION['userId']);



require("../src/View/User/Profil/mesTrajetsView.php");