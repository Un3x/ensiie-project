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



    $courseId = '15728632268232634';
    $date = '12/03/2019';
    $clientName = 'azertyuiop';
    $carrierName = 'qsdfgjlm';
	$price = 50;
	$departureName = 'Paris';
	$departureTime = '12h30';
	$arrivalName = 'Évry';
	$arrivalTime = '15h20';

    require('../src/Controller/mail/mailController.php');

    $Template = new EmailTemplate('../src/View/mail/bookingConfirmationMail.php');
    $Template->courseId = $courseId;
    $Template->date = $date;
	$Template->name = $carrierName;
	$Template->price = $price;
	$Template->departureName = $departureName;
	$Template->departureTime = $departureTime;
	$Template->arrivalName = $arrivalName;
    $Template->arrivalTime = $arrivalTime;
    

    $recipient = "testprojetlicorne+testMail@gmail.com";
    $subject = "confirmation de réservation";
    $body = $Template->compile();
    $bodyAlt = "Coucou ! Tu veux voir ma bite ?";

    sendMail($recipient, $subject, $body, $bodyAlt);




    $Template = new EmailTemplate('../src/View/mail/askCourseMail.php');
    $Template->courseId = $courseId;
    $Template->date = $date;
	$Template->name = $clientName;
	$Template->price = $price;
	$Template->departureName = $departureName;
	$Template->departureTime = $departureTime;
	$Template->arrivalName = $arrivalName;
    $Template->arrivalTime = $arrivalTime;
    

    $recipient = "testprojetlicorne+testMail@gmail.com";
    $subject = "demande de trajet";
    $body = $Template->compile();
    $bodyAlt = "Coucou ! Tu veux voir ma bite ?";

    sendMail($recipient, $subject, $body, $bodyAlt);















}
else{
    //annulation trajet

    $message = "paiement annulé, carte invalide";
}


require('../src/View/course/confirmationCourseView.php');