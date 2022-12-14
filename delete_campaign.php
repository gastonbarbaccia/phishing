<?php
include_once 'dbconexion.php';
$id = $_GET['id'];
$deleted = 'yes';

$sql = "UPDATE phishing.campaign SET campaign.deleted = ? WHERE id = ?";
$conexion->prepare($sql)->execute([$deleted, $id]);

header('Location:index.php');

?>