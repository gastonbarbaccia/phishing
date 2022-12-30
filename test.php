<?php
require_once 'dbconexion.php';

$cons5 = "SELECT content FROM phishing.email_template ";
$con5 = $conexion->prepare($cons5);
$con5->execute();
$content_email = $con5->fetchColumn();

$search = '$url_victim';
$replace = "https://www.google.com";
$string = $content_email;
$resultado = str_ireplace($search, $replace, $string);

echo $resultado;


?>