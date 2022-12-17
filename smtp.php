<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer();

// Settings
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';

$mail->Host       = "smtp.sendgrid.net";    // SMTP server example
//$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
$mail->Username   = "apikey";            // SMTP account username example
$mail->Password   = "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";            // SMTP account password example

$mail->setFrom('seguridad@seguridad-cencosud-cl.ml', 'Gaston Barbaccia');
$mail->addAddress('gaston.barbaccia@externos-ar.cencosud.com', 'Gaston Barbaccia');


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