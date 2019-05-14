<?php

$departure = isset($_GET['departure']) ? htmlspecialchars($_GET['departure']) : "";
$arrival = isset($_GET['arrival']) ? htmlspecialchars($_GET['arrival']) : "";
$showResult = isset($_GET['departure'])&&isset($_GET['arrival']) ? "<script>searchCourse('departure', 'arrival', 'resDiv');</script>" : "";

require('../src/View/course/searchCourseView.php');