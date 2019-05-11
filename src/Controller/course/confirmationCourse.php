<?php

if ((isset($_POST['usedCard'])
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
    && $_POST['usedCard'] == 'savedCard')){

    //validation paiement trajet

    $message = "paiement validé";



    $courseId = '15728632268232634';
    $clientName = 'azertyuiop';
    $carrierName = 'qsdfgjlm';
	$price = 50;
	$departureName = 'Paris';
	$arrivalName = 'Évry';

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
    $bodyAlt = "Coucou ! Tu veux voir ma bite ?";

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
    $bodyAlt = "Coucou ! Tu veux voir ma bite ?";

    sendMail($recipient, $subject, $body, $bodyAlt);















}
else{
    //annulation trajet

    $message = "paiement annulé, carte invalide";
}


require('../src/View/course/confirmationCourseView.php');