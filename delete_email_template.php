<?php
include_once 'dbconexion.php';
$id = $_GET['id'];
$deleted = 'yes';

$sql = "UPDATE phishing.email_template SET email_deleted = ? WHERE id = ?";
$conexion->prepare($sql)->execute([$deleted, $id]);

header('Location:email_templates.php');

?>