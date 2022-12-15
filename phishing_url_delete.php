<?php

require_once 'dbconexion.php';

$id = $_GET['id'];
$stmt = "UPDATE phishing.phishing_url SET phishing_deleted = 'yes' WHERE id= ? ";
$conexion->prepare($stmt)->execute([$id]);

header('Location: phishing_url_templates.php');


?>