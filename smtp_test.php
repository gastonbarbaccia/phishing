<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

$mail = new PHPMailer();

// Settings
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';

$mail->Host       = "in-v3.mailjet.com";    // SMTP server example
//$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
$mail->Username   = "3aa698d4cd8be5e66d472936cca34626";            // SMTP account username example
$mail->Password   = "d5ae76ec81d3c6fd52af3ff04c608960";            // SMTP account password example

$mail->setFrom('tobiasguerraseginf@gmail.com', 'Gaston Barbaccia');

$var = 'gastonbarbaccia@hotmail.com';

$mail->addAddress($var, 'Gaston Barbaccia');


// Content
$mail->isHTML(true);                       // Set email format to HTML
$mail->Subject = 'Here is the subject';

$mailContent = "<h1>Send HTML Email using SMTP in PHP</h1>
    <p>This is a test email I’m sending using SMTP mail server with PHPMailer.</p>";
$mail->Body = $mailContent;

//$mail->send();

if(!$mail->send()){
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    echo 'Message has been sent';
}

                    /*
                    if (!$mail->send()) {
                        $stmt = $conexion->prepare('UPDATE phishing.attack_user SET email_sent = 0 WHERE user_uid = ?');
                        $stmt->execute([$user_uid]);
                        
                    } else {
                        $stmt = $conexion->prepare('UPDATE phishing.attack_user SET email_sent = 1 WHERE user_uid = ?');
                        $stmt->execute([$user_uid]);
                    }
*/


?>