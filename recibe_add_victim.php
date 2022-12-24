<?php
require_once 'dbconexion.php' ;
$id = $_GET['id'];//id group

echo $id;

$mail = $_POST['mail'];
$uniqid = uniqid();
$sql = "INSERT INTO phishing.user (uid,email_address) VALUES (?,?)";
$conexion->prepare($sql)->execute([$uniqid,$mail]);

$user_id = $conexion->lastInsertId();

$consulta_group = "SELECT id FROM phishing.mygroup where id='$id'";
$con0 = $conexion->query($consulta_group)->fetchColumn();

$sql1 = "INSERT INTO phishing.group_user (group_id, user_id) VALUES (?,?)";
$conexion->prepare($sql1)->execute([$con0, $user_id]);

header("Location:users_groups.php?id=$id");