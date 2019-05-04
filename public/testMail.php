<?php

require('../src/Controller/mail/mailController.php');

$recipient = "testprojetlicorne+testMail@gmail.com";
$subject = "test qui marche !!!";
$body = "Coucou ! Tu veux voir ma <b>bite</b> ?";
$bodyAlt = "Coucou ! Tu veux voir ma bite ?";

sendMail($recipient, $subject, $body, $bodyAlt);