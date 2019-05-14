<?php
if(isset($_POST['sujet']) && isset($_POST['corp'])&& isset($_POST['mail']))
{
    require('../src/Controller/mail/mailController.php');
    
    $recipient = "testprojetlicorne+contact@gmail.com";
    $subject = htmlspecialchars($_POST['sujet']);
    $mail=htmlspecialchars($_POST['mail']);
    $corp=htmlspecialchars($_POST['corp']);
    $body ="mail envoyé par $mail <br/><br/> $corp";
    $bodyAlt ="mail envoyé par $mail \n\n $corp";

    if(sendMail($recipient, $subject, $body, $bodyAlt)){
        $title="message envoyé";
        $content = "Votre message a bien été envoyé";
    
    }
    else{
        $title="message non envoyé";
        $content = "Suite à une erreur le message n'a pas pu être envoyé, veuillez réessayer ultérieurement";
    
    }

}
else{
    $title="message non envoyé";
    $content = "Suite à une erreur dans le formulaire, le message n'a pas pu être envoyé";
}

require('../src/View/template.php');