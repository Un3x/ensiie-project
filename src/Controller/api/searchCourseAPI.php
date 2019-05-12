<?php

if(isset($_GET['departure']) && isset($_GET['arrival'])){
    require '../vendor/autoload.php';
    require '../src/Model/Course/CourseManager.php';

    $connection = bdd();

    $CourseManager = new CourseManager($connection);

    $courses = $CourseManager->fetchCourses($_GET['departure'],$_GET['arrival']);

    echo '{"status" : "success", "data" : '.json_encode($courses).'}';

}
else{
    header("HTTP/1.1 400 Bad Request");
    echo '{"status" : "fail"}';


}
