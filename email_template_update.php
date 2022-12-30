<?php
require_once 'dbconexion.php' ;

$id = $_POST['id'];
$name = $_POST['name0'];
$description = $_POST['description0'];
$content = $_POST['content0'];

$stmt = $conexion->prepare("update phishing.email_template set name= ?, description= ?,content= ? where id = ?");

$stmt->execute([$name, $description, $content, $id]);

header('Location: email_templates.php');

?>