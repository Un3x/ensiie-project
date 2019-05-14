<?php
if (isset($_POST['courseId']) && is_numeric($_POST['courseId'])){

    if(!$GLOBALS['user']){
        header('Location: /connexion');
    }

    try{
        require '../vendor/autoload.php';
        require '../src/Model/Course/CourseManager.php';

        $connection = bdd();
        $CourseManager = new CourseManager($connection);

        $course = $CourseManager->getCourse($_POST['courseId']);

        $courseId = $_POST['courseId'];

        if ($course){

            $found = $_SESSION['userId']==$course['carrierId'] && $course['state']==1;
        }
        else{
            $found=false;
        }

        if($found){

            $CourseManager->changeCourse($_POST['courseId'],2);

            $ClientManager = new ClientManager($connection);

            $course = $CourseManager->getCourse($courseId);
            $client = $ClientManager->get($course['clientId']);

            $clientName = $course['clientFirstname'].' '.$course['clientSurname'];
            $carrierName = $course['carrierFirstname'].' '.$course['carrierSurname'];
            $price = $course['price'];
            $departureName = $course['departure'];
            $arrivalName = $course['arrival'];
            $duration=$course['duration'];
            $distance=$course['distance'];

            require('../src/Controller/mail/mailController.php');

            $Template = new EmailTemplate('../src/View/mail/bookingConfirmedMail.php');
            $Template->courseId = $courseId;
            $Template->name = $carrierName;
            $Template->price = $price;
            $Template->departureName = $departureName;
            $Template->arrivalName = $arrivalName;
            $Template->duration = $duration;
            $Template->distance = $distance;

            $recipient = $client->getMailAddress();
            $subject = "réservation acceptée";
            $body = $Template->compile();
            $bodyAlt = "";

            sendMail($recipient, $subject, $body, $bodyAlt);


            $title="trajet accepté";
            $content = "Le trajet a bien été accepté";
            require('../src/View/template.php');
        }
        else{
            $title="trajet non trouvé";
            $content = "Ce trajet n'existe pas";
            
            header("HTTP/1.1 404 Not Found");
            require('../src/View/template.php');
        }
    }
    catch(Exception $e){
        $title="erreur";
        $content = "Une erreur s'est produite, veuillez réessayez ultérieurement";
        header("HTTP/1.1 500 Internal Server Error");
        require('../src/View/template.php');
    }
}
else{
    $title="erreur";
    $content = "Erreur lors de l'envoi du formulaire";

    header("HTTP/1.1 400 Bad Request");
	require('../src/View/template.php');
}