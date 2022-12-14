<?php
include_once 'dbconexion.php';
$id = $_POST['id'];
$name = $_POST['campaign_name'];
$description = $_POST['campaign_description'];
$active = $_POST['is_active'];
$group = $_POST['group'];
$template = $_POST['template'];

$server = $_POST['server'];
$uname =$_POST['username'];
$pass = $_POST['passw'];
$port = $_POST['port'];
$subj = $_POST['subject'];
$from = $_POST['from'];
$display = $_POST['display'];
$url = $_POST['phishing_URL'];

$cons1 = "SELECT id FROM phishing.mygroup where name =?";
$con1 = $conexion->prepare($cons1);
$con1->execute([$group]);
$consult1 = $con1->fetchColumn();

$cons2 = "SELECT id FROM phishing.email_template where name =?";
$con2 = $conexion->prepare($cons2);
$con2->execute([$template]);
$consult2 = $con2->fetchColumn();

$sql = "UPDATE phishing.campaign SET name=?, description=?, is_active=?, group_id =?, email_template_id =? WHERE id=?";
$conexion->prepare($sql)->execute([$name, $description, $active, $consult1, $consult2, $id]);

$sql1 = "UPDATE phishing.email_settings SET smtp_server =?, smtp_username =?, smtp_password =?, smtp_port =?, subject =?, email_from = ?, display =?, phishing_url =? WHERE id=?";
$conexion->prepare($sql1)->execute([$server, $uname, $pass, $port, $subj, $from, $display, $url, $id]);

header('Location:index.php');
