<?php
    if(isset($_POST['sujet']) && isset($_POST['corp'])&& isset($_POST['mail']))
    {
        require('../src/Controller/mail/mailController.php');
        
        $recipient = "testprojetlicorne+contact@gmail.com";
        $subject = $_POST['sujet'];
        $mail=$_POST['mail'];
        $corp=$_POST['corp'];
        $body ="mail envoyer par:$mail \n\n $corp";

        sendMail($recipient, $subject, $body, $body);

    }