<?php
if (isset($_POST['courseId'])){

    if(!$GLOBALS['user']){
        header('Location: /connexion');
    }

    require '../vendor/autoload.php';
    require '../src/Model/Course/CourseManager.php';

	$connection = bdd();
	$CourseManager = new CourseManager($connection);

    $course = $CourseManager->getCourse($_POST['courseId']);
    $courseId = $_POST['courseId'];

    if ($course){

        $found = ($_SESSION['userId']==$course['carrierId'] || $_SESSION['userId']==$course['carrierId']) && $course['state']=2;
    }
    else{
        $found=false;
    }

	if($found){

        $CourseManager->changeCourse($_POST['courseId'],4);

        $ClientManager = new ClientManager($connection);
        $VendorManager = new VendorManager($connection);

        $course = $CourseManager->getCourse($courseId);
        $client = $ClientManager->get($course['clientId']);
        $carrier = $VendorManager->get($course['carrierId']);

        $clientName = $course['clientFirstname'].' '.$course['clientSurname'];
        $carrierName = $course['carrierFirstname'].' '.$course['carrierSurname'];
        $price = $course['price'];
        $departureName = $course['departure'];
        $arrivalName = $course['arrival'];
		$duration=$course['duration'];
		$distance=$course['distance'];

        require('../src/Controller/mail/mailController.php');

        $Template = new EmailTemplate('../src/View/mail/bookingCancelMail.php');
        $Template->courseId = $courseId;
        $Template->name = $carrierName;
        $Template->price = $price;
        $Template->departureName = $departureName;
        $Template->arrivalName = $arrivalName;
        $template->duration = $duration;
        $template->distance = $distance;
        

        $recipient = $client->getMailAddress();
        $subject = "trajet annulé";
        $body = $Template->compile();
        $bodyAlt = "";

        sendMail($recipient, $subject, $body, $bodyAlt);

        $Template = new EmailTemplate('../src/View/mail/bookingCancelMail.php');
        $Template->courseId = $courseId;
        $Template->name = $carrierName;
        $Template->price = $price;
        $Template->departureName = $departureName;
        $Template->arrivalName = $arrivalName;
        $template->duration = $duration;
        $template->distance = $distance;
        

        $recipient = $carrier->getMailAddress();
        $subject = "trajet annulé";
        $body = $Template->compile();
        $bodyAlt = "";

        sendMail($recipient, $subject, $body, $bodyAlt);



        $content = "Le trajet a bien été accepté";
		require('../src/View/template.php');
	}
	else{
		$content = "Ce trajet n'existe pas";
		require('../src/View/template.php');
	}
}
else{
	$content = "Ce trajet n'existe pas";
	require('../src/View/template.php');
}