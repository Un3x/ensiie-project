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
    isset($_POST['idCourse']) && is_numeric($_POST['idCourse'])){

   
    $courseId = $_POST['idCourse'];

    try{
        require_once('../vendor/autoload.php');
        require_once('../src/Model/Course/CourseManager.php');

        
        $connection = bdd();
        $CourseManager = new CourseManager($connection);
        $VendorManager = new VendorManager($connection);

        $course = $CourseManager->getCourse($courseId);
        $carrier = $VendorManager->get($course['carrierId']);

        if ($course && $course['state']==0){

            if ($_SESSION['userId'] == $course['clientId']){

                $CourseManager->changeCourse($courseId,1);

                $clientName = $course['clientFirstname'].' '.$course['clientSurname'];
                $carrierName = $course['carrierFirstname'].' '.$course['carrierSurname'];
                $price = $course['price'];
                $departureName = $course['departure'];
                $arrivalName = $course['arrival'];
                $duration=$course['duration'];
                $distance=$course['distance'];

                require('../src/Controller/mail/mailController.php');

                $Template = new EmailTemplate('../src/View/mail/bookingConfirmationMail.php');
                $Template->courseId = $courseId;
                $Template->name = $carrierName;
                $Template->price = $price;
                $Template->departureName = $departureName;
                $Template->arrivalName = $arrivalName;
                $Template->duration = $duration;
                $Template->distance = $distance;
                

                $recipient = $GLOBALS['user']->getMailAddress();
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
                $Template->duration = $duration;
                $Template->distance = $distance;
                

                $recipient = $carrier->getMailAddress();
                $subject = "demande de trajet";
                $body = $Template->compile();
                $bodyAlt = "";

                sendMail($recipient, $subject, $body, $bodyAlt);

                //validation paiement trajet

                $message = "paiement validé";
            }
            else{
                $title="erreur";
                $content = "ce trajet n'existe pas";
                header("HTTP/1.1 404 Not Found");
            }

        }
        else{
            header("HTTP/1.1 404 Not Found");
            $message = "ce trajet n'existe pas";
        }
    }
    catch(Exception $e){
        $title="erreur";
        $content = "Une erreur s'est produite, veuillez réessayez ultérieurement";
        header("HTTP/1.1 500 Internal Server Error");
    }

}
else{
    //annulation trajet
    header("HTTP/1.1 400 Bad Request");
    $message = "paiement annulé, carte invalide";
}


require('../src/View/course/confirmationCourseView.php');