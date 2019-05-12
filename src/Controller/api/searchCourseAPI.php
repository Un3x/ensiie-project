<?php

if(isset($_GET['departure']) && isset($_GET['arrival'])){
    require '../vendor/autoload.php';
    require '../src/Model/Course/CourseManager.php';

    //postgres
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


    $CourseManager = new CourseManager($connection);

    $courses = $CourseManager->fetchCourses($_GET['departure'],$_GET['arrival']);

    echo '{"status" : "success", "data" : '.json_encode($courses).'}';

}
else{
    header("HTTP/1.1 400 Bad Request");
    echo '{"status" : "fail"}';


}
