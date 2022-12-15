<?php
require_once 'dbconexion.php';
$id = $_GET['id'];
$stmt = $conexion->query("update phishing.mygroup set group_deleted = 'yes' where id = '$id'");
header('Location: users_groups.php');

?>