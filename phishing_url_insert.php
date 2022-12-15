<?php

require_once 'dbconexion.php';

$name=$_POST['name'];
$description=$_POST['description'];
$phishing_url = $_POST['phishing_url'];
$stmt = "INSERT INTO phishing.phishing_url (name,description,url) VALUES (?,?,?)";
$conexion->prepare($stmt)->execute([$name, $description,$phishing_url]);


header('Location: phishing_url_templates.php');


?>