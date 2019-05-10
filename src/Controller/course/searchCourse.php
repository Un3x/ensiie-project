<?php

$departure = isset($_GET['departure']) ? $_GET['departure'] : "";
$arrival = isset($_GET['arrival']) ? $_GET['arrival'] : "";
$date = isset($_GET['date']) ? $_GET['date'] : "";
$time = isset($_GET['time']) ? $_GET['time'] : "";
$showResult = isset($_GET['departure'])&&isset($_GET['arrival'])&&isset($_GET['date'])&&isset($_GET['time']) ? "<script>searchCourse('departure', 'arrival', 'date', 'time', 'resDiv');</script>" : "";

require('../src/View/course/searchCourseView.php');