<?php


function sendMail($recipient, $subject, $body, $bodyAlt){
	require('configMail.php');

	try {
		//Recipients
		$mail->setFrom('from@example.com', 'projet web uber licorne');
		$mail->addAddress($recipient);     // Add a recipient
		//$mail->addAddress('ellen@example.com', 'Ellen');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
	
		// Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	
		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$mail->AltBody = $bodyAlt;
	
		$mail->send();
		echo 'Message has been sent';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}


}


class EmailTemplate
{
    var $variables = array();
    var $path_to_file= array();
    function __construct($path_to_file)
    {
         if(!file_exists($path_to_file))
         {
             trigger_error('Template File not found!',E_USER_ERROR);
             return;
         }
         $this->path_to_file = $path_to_file;
    }

    public function __set($key,$val)
    {
        $this->variables[$key] = $val;
    }


    public function compile()
    {
        ob_start();

        extract($this->variables);
        include $this->path_to_file;


        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}