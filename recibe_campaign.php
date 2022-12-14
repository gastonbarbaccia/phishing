<?php 
require_once 'dbconexion.php' ;

$name = $_POST['campaign_name'];
$description = $_POST['campaign_description'];
$is_active = $_POST['is_active'];
$group = $_POST['group'];
$template = $_POST['template'];
$server = $_POST['server'];
$username = $_POST['username'];
$passw = $_POST['passw'];
$port = $_POST['port'];
$subject = $_POST['subject'];
$from = $_POST['from'];
$display = $_POST['display'];
$phishingURL= $_POST['phishing_URL'];

print_r($_POST);
$cons = "SELECT id FROM phishing.mygroup where name = ? ";
$con = $conexion->prepare($cons);
$con->execute([$group]);
$consult = $con->fetchColumn();

$cons1 = "SELECT id FROM phishing.email_template where name = ? ";
$con1 = $conexion->prepare($cons1);
$con1->execute([$template]);
$consult1 = $con1->fetchColumn();

$sql = "INSERT INTO phishing.campaign (name, description, is_active, group_id, email_template_id) VALUES (?,?,?,?,?)";
$conexion->prepare($sql)->execute([$name, $description, $is_active, $consult, $consult1]);
"<br>";echo "The last insert id was " . $conexion->lastInsertId();
$camp_id = $conexion->lastInsertId();

$sql2 = "INSERT INTO phishing.email_settings (smtp_server, smtp_username, smtp_password, smtp_port, subject, email_from, display, phishing_url, campaign_id) VALUES (?,?,?,?,?,?,?,?,?)";
$conexion->prepare($sql2)->execute([ $server, $username, $passw, $port, $subject, $from, $display, $phishingURL, intval($camp_id)]);
header('Location:index.php');

?>
