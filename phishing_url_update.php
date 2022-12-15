<?php

require_once 'dbconexion.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$url = $_POST['phishing_url'];
$stmt = "UPDATE phishing.phishing_url SET name = '$name', description = '$description', url = '$url' WHERE id= ? ";
$conexion->prepare($stmt)->execute([$id]);

header('Location: phishing_url_templates.php');


?>