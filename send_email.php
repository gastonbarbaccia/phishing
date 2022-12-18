<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once 'dbconexion.php';
require 'vendor/autoload.php';

$mail = new PHPMailer();


$email_template = $_POST['email_template'];
$cid = $_POST['campaign_id']; //campaign id

$cons1 = "SELECT group_id FROM phishing.campaign where id = ? ";
$con1 = $conexion->prepare($cons1);
$con1->execute([$cid]);
$group_id = $con1->fetchColumn();

$sql3 = "SELECT * FROM phishing.user JOIN phishing.group_user ON user.id = group_user.user_id WHERE group_id= ?";
$con2 = $conexion->prepare($sql3);
$con2->execute([$group_id]);
$user_id = $con2->fetchAll();


$sql = "SELECT * FROM phishing.email_settings WHERE campaign_id= ?";
$con3 = $conexion->prepare($sql);
$con3->execute([$cid]);
$settings_emails = $con3->fetchAll();



foreach ($settings_emails as $set_email) {

    $smtp_server = $set_email['smtp_server'];
    $smtp_username = $set_email['smtp_username'];
    $smtp_password = $set_email['smtp_password'];
    $smtp_port = $set_email['smtp_port'];

    $subject = $set_email['subject'];
    $email_from = $set_email['email_from'];
    $display = $set_email['display'];

    /*
    echo "smtp server: ".$smtp_server;
    echo "<br>";
    echo "smtp username: ".$smtp_username;
    echo "<br>";
    echo "smtp password: ".$smtp_password;
    echo "<br>";
    echo "smtp port: ".$smtp_port;
    echo "<br>";
    echo "subject: ".$subject;
    echo "<br>";
    echo "email_from: ".$email_from;
    echo "<br>";
    echo "display: ".$display;
    echo "<br>";*/
}



foreach ($user_id as $uid) {

    //--------------------------------------

    $vid = $uid['uid'];

    $email = $uid['email_address'];

    //-------------------------------------------------------------------
    // Settings SMTP
    //-------------------------------------------------------------------
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    $mail->Host       = $smtp_server;    // SMTP server example
    //$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->Port       = $smtp_port;                    // set the SMTP port for the GMAIL server
    $mail->Username   = $smtp_username;            // SMTP account username example
    $mail->Password   = $smtp_password;            // SMTP account password example

    $mail->setFrom('tobiasguerraseginf@gmail.com', $display);

    // Content
    $mail->isHTML(true);

    $mail->Subject = $subject;

    $mailContent = "<h1>Send HTML Email using SMTP in PHP</h1>
    <p>This is a test email I’m sending using SMTP mail server with PHPMailer.</p>
    <br>
    <a href='https://www.google.com?uid=$vid'>Click en el siguiente link</a>";

    $mail->Body = $mailContent;

    $mail->addBCC($email,'Seguridad');

    
    if(!$mail->send()){
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        echo 'error';
    }else{
        echo '';
    }
  
}

