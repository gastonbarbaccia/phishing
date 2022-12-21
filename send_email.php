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

$cons22 = "SELECT status FROM phishing.attack JOIN phishing.campaign ON attack.campa_id = campaign.id WHERE attack.campa_id= ? ORDER BY date_time DESC LIMIT 1";
$con22 = $conexion->prepare($cons22);
$con22->execute([$cid]);
$status = $con22->fetchColumn();

$status = 1;
$sql1 = "INSERT INTO phishing.attack (mygroup_id, campa_id,status) VALUES (?,?,?)";
$conexion->prepare($sql1)->execute([$group_id, $cid, $status]);

$attack_id = $conexion->lastInsertId();

$ugu = "SELECT uid FROM phishing.user JOIN phishing.group_user ON user.id = group_user.user_id WHERE group_id= ?";
$geu = $conexion->prepare($ugu);
$geu->execute([$group_id]);
$user_id = $geu->fetchAll();

foreach ($user_id as $uid) {
    $au = "INSERT INTO phishing.attack_user (attack_id, user_uid) VALUES (?,?)";
    $conexion->prepare($au)->execute([$attack_id, $uid[0]]);
}


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
    $phishing_url = $set_email['phishing_url'];

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

$mensajes_enviados=0;
$mensajes_noenviados=0;


foreach ($user_id as $uid) {

    //--------------------------------------

    $vid = $uid['uid'];

    $email = $uid['email_address'];

    $victim_url = 'https://'.$phishing_url.'?uid='.$vid;

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

    $mailContent = netflix($victim_url);

    $mail->Body = $mailContent;

    $mail->addBCC($email, 'Seguridad');


    if (!$mail->send()) {
       /* echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        echo 'error';*/
        $mensajes_noenviados++;

    } else {
        $mensajes_enviados++;
        $sent = "UPDATE phishing.attack_user SET email_sent=? , captured_on = ? WHERE attack_id = ?";
        $conexion->prepare($sent)->execute([$esent,null,$attack_id]);
    }
}


if($count_emails[0]  ==  $mensajes_enviados ){

   // echo "Count emails:".$count_emails[0]."- Mensajes enviados:".$mensajes_enviados;
    echo "ok";

}else{

   // echo "Count emails:".$count_emails[0]."- Mensajes no enviados:".$mensajes_enviados;
   echo "error";
}