<?php

if (isset($_POST['nCard'])
    && preg_match("/^[0-9]{16}$/", $_POST['nCard'])
    && isset($_POST['monthCard'])
    && $_POST['monthCard'] <= 12 && $_POST['monthCard'] >= 1
    && isset($_POST['yearCard'])
    && $_POST['yearCard'] <= date('Y')+20 && $_POST['yearCard'] >= date('Y')
    && date('Ym') <= $_POST['yearCard'].$_POST['monthCard']
    && isset($_POST['codeCard'])
    && preg_match("/^[0-9]{3}$/", $_POST['codeCard'])){

    //validation paiement trajet

    $message = "paiement validé";
}
else{
    //annulation trajet

    $message = "paiement annulé, carte invalide";
}


require('../src/View/course/confirmationCourseView.php');