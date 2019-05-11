<?php

mesTrajets function()
{
    $courseManager = new CourseManager(bdd());
    $mesCourses = $courseManager->getCourse($_SESSION['id_utilisateur']);
    require("../src/View/User/Profil/mesTrajetsView.php");
}