<?php

mesTrajets function()
{
    $bdd = 0;
    $courseManager = new CourseManager($bdd);
    $mesCourses = $courseManager->getCourse();
    require("../src/View/User/Profil/mesTrajetsView.php");
}