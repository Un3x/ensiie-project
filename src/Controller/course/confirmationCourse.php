<?php

if (((isset($_POST['usedCard'])
    && $_POST['usedCard'] == 'newCard'
    && isset($_POST['nCard'])
    && preg_match("/^[0-9]{16}$/", $_POST['nCard'])
    && isset($_POST['monthCard'])
    && $_POST['monthCard'] <= 12 && $_POST['monthCard'] >= 1
    && isset($_POST['yearCard'])
    && $_POST['yearCard'] <= date('Y')+20 && $_POST['yearCard'] >= date('Y')
    && date('Ym') <= $_POST['yearCard'].$_POST['monthCard']
    && isset($_POST['codeCard'])
    && preg_match("/^[0-9]{3}$/", $_POST['codeCard']))
    ||
    (isset($_POST['usedCard'])
    && $_POST['usedCard'] == 'savedCard'))
    &&
    isset($_POST['idCourse'])){

   
    $courseId = $_POST['idCourse'];


    require '../vendor/autoload.php';
	require '../src/Model/Course/CourseManager.php';

	
	$connection = bdd();
    $CourseManager = new CourseManager($connection);

    $course = $CourseManager->getCourse($courseId);

    if ($course){

        $clientName = $course['clientFirstname'].' '.$course['clientSurname'];
        $carrierName = $course['carrierFirstname'].' '.$course['carrierSurname'];
        $price = $course['price'];
        $departureName = $course['departure'];
        $arrivalName = $course['arrival'];

        require('../src/Controller/mail/mailController.php');

        $Template = new EmailTemplate('../src/View/mail/bookingConfirmationMail.php');
        $Template->courseId = $courseId;
        $Template->name = $carrierName;
        $Template->price = $price;
        $Template->departureName = $departureName;
        $Template->arrivalName = $arrivalName;
        

        $recipient = "testprojetlicorne+testMail@gmail.com";
        $subject = "confirmation de réservation";
        $body = $Template->compile();
        $bodyAlt = "";

        sendMail($recipient, $subject, $body, $bodyAlt);




        $Template = new EmailTemplate('../src/View/mail/askCourseMail.php');
        $Template->courseId = $courseId;
        $Template->name = $clientName;
        $Template->price = $price;
        $Template->departureName = $departureName;
        $Template->arrivalName = $arrivalName;
        

        $recipient = "testprojetlicorne+testMail@gmail.com";
        $subject = "demande de trajet";
        $body = $Template->compile();
        $bodyAlt = "";

        sendMail($recipient, $subject, $body, $bodyAlt);

        //validation paiement trajet

        $message = "paiement validé";


    }
    else{
        $message = "ce trajet n'existe pas";
    }

}
else{
    //annulation trajet

    $message = "paiement annulé, carte invalide";
}


require('../src/View/course/confirmationCourseView.php');